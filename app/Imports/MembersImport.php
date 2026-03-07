<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MembersImport implements ToCollection
{
    protected $filename;

    public function __construct($filename = '')
    {
        $this->filename = $filename;
    }

    public function collection(Collection $rows)
    {
        $headerIndex = -1;
        $headers = [];
        $currentAngkatan = null;

        if (preg_match('/(\d{4})\.csv$/i', $this->filename, $m)) {
            $currentAngkatan = $m[1];
        }

        foreach ($rows as $index => $row) {
            $rowStr = strtolower(implode(' ', $row->toArray()));
            
            if (preg_match('/angkatan\s*(\d{4})/i', $rowStr, $m)) {
                $currentAngkatan = $m[1];
            }

            if ($headerIndex === -1 && str_contains($rowStr, 'nama') && (str_contains($rowStr, 'ttl') || str_contains($rowStr, 'jurusan') || str_contains($rowStr, 'tlp') || str_contains($rowStr, 'hp'))) {
                $headerIndex = $index;
                $headers = $row->map(function($item) {
                    return strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '_', $item), '_'));
                })->toArray();
                break;
            }
        }

        if ($headerIndex === -1) return;

        for ($i = $headerIndex + 1; $i < $rows->count(); $i++) {
            $row = $rows[$i];
            if ($row->filter()->isEmpty()) continue; 

            $rowStr = strtolower(implode(' ', $row->toArray()));
            if (preg_match('/angkatan\s*(\d{4})/i', $rowStr, $m)) {
                $currentAngkatan = $m[1];
                continue; 
            }

            $rowData = [];
            foreach ($headers as $colIndex => $header) {
                if (!empty($header)) {
                    $rowData[$header] = $row[$colIndex] ?? null;
                }
            }

            $nameKey = collect(array_keys($rowData))->first(fn($k) => str_contains($k, 'nama'));
            $rawName = trim($rowData[$nameKey] ?? '');
            if (empty($rawName)) continue; 
            
            $name = $rawName;
            $title = null;
            $status = 'Mahasiswa'; 

            if (str_contains($rawName, ',')) {
                $parts = explode(',', $rawName);
                $title = trim(array_pop($parts)); 
                $name = trim(implode(',', $parts)); 
                $status = 'Alumni'; 
            }

            $phoneKey = collect(array_keys($rowData))->first(fn($k) => str_contains($k, 'tlp') || str_contains($k, 'hp') || str_contains($k, 'telepon'));
            $phone = preg_replace('/[^0-9]/', '', $rowData[$phoneKey] ?? '');
            if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
            elseif (str_starts_with($phone, '8')) $phone = '62' . $phone;

            $majorKey = collect(array_keys($rowData))->first(fn($k) => str_contains($k, 'jurus') || str_contains($k, 'prodi') || str_contains($k, 'jusr'));
            $major = ucwords(strtolower(trim($rowData[$majorKey] ?? '')));
            
            $addressKey = collect(array_keys($rowData))->first(fn($k) => str_contains($k, 'alamat'));
            $address = trim($rowData[$addressKey] ?? '');

            // ==========================================
            // AI PENYEDOT TANGGAL LAHIR (ANTI-CRASH MySQL)
            // ==========================================
            $ttlKey = collect(array_keys($rowData))->first(fn($k) => str_contains($k, 'ttl') || str_contains($k, 'lahir'));
            $ttlRaw = strtolower(trim($rowData[$ttlKey] ?? ''));
            $birthDate = null;

            if (!empty($ttlRaw)) {
                if (is_numeric($ttlRaw)) {
                    try { 
                        $parsed = Date::excelToDateTimeObject($ttlRaw)->format('Y-m-d'); 
                        $parts = explode('-', $parsed);
                        // Cek keabsahan tanggal sebelum dimasukkan!
                        if (count($parts) == 3 && checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
                            $birthDate = $parsed;
                        }
                    } catch (\Exception $e) {}
                } else {
                    $bulanIndo = [
                        'januari'=>'01', 'februari'=>'02', 'maret'=>'03', 'april'=>'04', 
                        'mei'=>'05', 'juni'=>'06', 'juli'=>'07', 'agustus'=>'08', 
                        'september'=>'09', 'oktober'=>'10', 'november'=>'11', 'desember'=>'12',
                        'jan'=>'01', 'feb'=>'02', 'mar'=>'03', 'apr'=>'04', 
                        'jun'=>'06', 'jul'=>'07', 'agu'=>'08', 'sep'=>'09', 
                        'okt'=>'10', 'nov'=>'11', 'des'=>'12'
                    ];
                    $ttlRaw = str_ireplace(array_keys($bulanIndo), array_values($bulanIndo), $ttlRaw);

                    if (preg_match('/(\d{1,2})[\s\-\/\.]+(\d{1,2})[\s\-\/\.]+(\d{4})/', $ttlRaw, $m)) {
                        $day = (int)$m[1];
                        $month = (int)$m[2];
                        $year = (int)$m[3];
                        
                        // Cek normal: DD-MM-YYYY
                        if (checkdate($month, $day, $year)) {
                            $birthDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
                        } 
                        // Cek format bule terbalik (seperti kasus si Axel): MM-DD-YYYY
                        elseif (checkdate($day, $month, $year)) {
                            $birthDate = sprintf('%04d-%02d-%02d', $year, $day, $month);
                        }
                    } 
                    elseif (preg_match('/(\d{4})[\s\-\/\.]+(\d{1,2})[\s\-\/\.]+(\d{1,2})/', $ttlRaw, $m)) {
                        $year = (int)$m[1];
                        $month = (int)$m[2];
                        $day = (int)$m[3];
                        
                        if (checkdate($month, $day, $year)) {
                            $birthDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
                        } elseif (checkdate($day, $month, $year)) {
                            $birthDate = sprintf('%04d-%02d-%02d', $year, $day, $month);
                        }
                    }
                }
            }

            $keteranganStr = strtolower(implode(' ', $rowData));
            $formattedName = ucwords(strtolower($name));

            if (str_contains($keteranganStr, 'pindah') || str_contains($keteranganStr, 'berhenti') || str_contains($keteranganStr, 'ragu') || str_contains($keteranganStr, 'do')) {
                Member::where('name', $formattedName)->delete();
                continue; 
            }

            $dataToUpdate = [
                'title'      => strtoupper($title),
                'phone'      => $phone,
                'major'      => $major,
                'address'    => $address,
                'status'     => $status,
                'birth_date' => $birthDate,
            ];
            
            if ($currentAngkatan) {
                $dataToUpdate['angkatan'] = $currentAngkatan;
            }

            Member::updateOrCreate(
                ['name' => $formattedName], 
                $dataToUpdate
            );
        }
    }
}
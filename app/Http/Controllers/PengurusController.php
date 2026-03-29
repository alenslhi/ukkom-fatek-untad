<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MembersImport;

class PengurusController extends Controller
{
    public function dashboard(Request $request)
    {
        if (auth()->user()->role !== 'pengurus' && auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        
        $search = $request->input('search');
        $isSearching = !empty($search);

        $ultahHariIni = Member::whereMonth('birth_date', $today->month)->whereDay('birth_date', $today->day)->get();
        $ultahBesok = Member::whereMonth('birth_date', $tomorrow->month)->whereDay('birth_date', $tomorrow->day)->get();
        
        // Logika pemisahan data tabel berdasarkan pencarian
        if ($isSearching) {
            // Jika mencari, ambil dari seluruh database tanpa mempedulikan bulan
            $tableData = Member::where('name', 'like', "%{$search}%")
                ->orWhere('major', 'like', "%{$search}%")
                ->orWhere('angkatan', 'like', "%{$search}%")
                ->orderBy('name', 'asc')
                ->paginate(10)
                ->appends(['search' => $search]);
        } else {
            // Jika tidak mencari, tampilkan daftar ulang tahun bulan ini secara default
            $tableData = Member::whereMonth('birth_date', $today->month)
                ->orderByRaw('DAY(birth_date) ASC')
                ->paginate(10);
        }

        return view('pengurus.dashboard', compact('ultahHariIni', 'ultahBesok', 'tableData', 'today', 'search', 'isSearching'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|array',
            'file_excel.*' => 'mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $count = 0;
            foreach ($request->file('file_excel') as $file) {
                $filename = $file->getClientOriginalName();
                Excel::import(new MembersImport($filename), $file);
                $count++;
            }
            return back()->with('success', $count . ' File Data berhasil di-import dan Angkatan otomatis terisi!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function anggota(Request $request)
    {
        $search = $request->input('search');
        $members = Member::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('major', 'like', "%{$search}%")
                         ->orWhere('angkatan', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
        })->orderBy('name', 'asc')->paginate(50); 

        return view('pengurus.anggota', compact('members', 'search'));
    }

    public function updateAnggota(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:Mahasiswa,Alumni',
        ]);
        $member->update($request->all());
        return back()->with('success', 'Data ' . $member->name . ' diperbarui!');
    }

    public function deleteAnggota($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
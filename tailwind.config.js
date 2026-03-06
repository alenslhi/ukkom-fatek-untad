/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Kita siapkan warna khas Teknik (bisa diubah nanti)
        'ukkom-navy': '#1e3a8a', 
        'ukkom-orange': '#f97316',
      }
    },
  },
  plugins: [],
}
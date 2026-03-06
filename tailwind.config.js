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
        // Palet Baru ala SaaS Modern
        'ukkom-darknavy': '#09090b', // Sangat gelap hampir hitam (Background Hero)
        'ukkom-carddark': '#18181b', // Warna card di area gelap
        'ukkom-navy': '#1e3a8a', // Biru Universitas
        'ukkom-tosca': '#2dd4bf', // Aksen utama (Neon)
        'ukkom-purple': '#a855f7', // Gradasi ungu SaaS
      }
    },
  },
  plugins: [],
}
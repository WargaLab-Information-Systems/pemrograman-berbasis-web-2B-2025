/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html, js}"],
  theme: {
    extend: { fontFamily: {
      poppins: ['Poppins', 'sans-serif'],
    }, 
    colors: {
      primary: '#F5EEDD',
      accent: '#7AE2CF',
      teal: '#077A7D',
      dark: '#06202B'},
  },
  plugins: [],
}
}
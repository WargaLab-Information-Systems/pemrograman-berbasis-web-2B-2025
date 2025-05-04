/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['index.html'],
  theme: {
    container: {
      center: true,
      padding: '16px',
    },
    extend: {
      colors: {
        primary: '#91E5F6',
        secondary: '#59A5D8', 
        third: '#f7dc6f',
        fourth: '#85c1ae',
        dark: '#133C55',
        electron: '#0984e3',
        breeze: '#b2bec3',
      },
      fontFamily:{
        poppins: ['Poppins', 'sans-serif'],
        inter: ["Inter"]
      },
      screens: {
        'xl': '1200px',
      }
    },
  },
  plugins: [],
}

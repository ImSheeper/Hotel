/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      width: {
        '84': '22rem',
      }
    },
  },
  plugins: [
    require('tailwindcss-animated')
  ],
}

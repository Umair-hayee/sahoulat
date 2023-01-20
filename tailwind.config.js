/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  content: [],
  theme: {
    extend: {
      colors: {
        "primary-color" : "#C50000",
        "font-color" : "#292929",
        "text-hover": "#C5000040",
        "secondary-color": "#F5F5F5"
      }
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}

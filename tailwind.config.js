/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens: {
        print: {raw: 'print'},
        screen: {raw: 'screen'},
      },
    },
  },
  plugins: [],
}


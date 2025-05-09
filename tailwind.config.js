/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors : {
        villageois : '#6cc3a4',
        sorciere : '#9c59b6',
        independant : '#b3d4e3'
      },
    },
  },
  plugins: [],
}

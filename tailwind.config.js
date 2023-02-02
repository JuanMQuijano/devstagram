/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    //Ingresamos lo que va a contener código tailwind
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

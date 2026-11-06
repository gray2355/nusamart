
const mix = require('laravel-mix');

// JavaScript lama untuk Laravel dan Alpine.js
mix.js('resources/js/app.js', 'public/js');

// Entry point React
mix.js('resources/js/src/main.jsx', 'public/js').react();

// Tailwind CSS
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

const mix = require('laravel-mix');

// mix.js('resources/js/app.js', 'public/js')
//    .css('resources/css/app.css', 'public/css')
//    .setPublicPath('public');

mix.js('resources/js/app.js', 'public/js')
   .css('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       //require('tailwindcss'),
       require('autoprefixer'),
   ])
   .setPublicPath('public');

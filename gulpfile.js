const elixir = require('laravel-elixir');

require('laravel-elixir-webpack-official');
require('laravel-elixir-vue-2');

elixir(mix => {
    mix//.sass('app.scss','public/assets/css/app.css')
    .webpack('calculate.js')
    //.version(['assets/css/style.css', 'assets/js/app.js'])
});
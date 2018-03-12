/**
 * Created by CTAC on 10.03.2018.
 */

const elixir = require('laravel-elixir');

require('laravel-elixir-webpack-official');

elixir(mix => {
    mix.webpack('script.js', 'public/js/script.js')
       //.sass(['style.scss'],'public/css/style.css')
});

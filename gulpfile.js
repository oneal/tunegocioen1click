var elixir = require('laravel-elixir');

require('laravel-elixir-vue-2')

elixir(function(mix) {
    mix.styles([
        'app.css',
    ], 'public/assets/css');
});

elixir(function(mix) {
    mix.browserify('app.js', 'public/assets/js/app.js');
});

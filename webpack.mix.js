const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

// Enable versioning in production
if (mix.inProduction()) {
    mix.version();
}

// Configure Mix options
mix.options({
    processCssUrls: false,
    postCss: [
        require('tailwindcss'),
        require('autoprefixer'),
    ]
});

// Hot Module Replacement
mix.disableNotifications();

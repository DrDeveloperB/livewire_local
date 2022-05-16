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
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .sass('node_modules/admin-lte/node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css')
    // styles 로 믹스하면 폰트 복사가 안됨
    .postCss('node_modules/admin-lte/plugins/summernote/summernote-bs4.css', 'public/css/summernote.css')
    .scripts('node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    // .sourceMaps()
    .scripts('node_modules/admin-lte/plugins/summernote/summernote-bs4.js', 'public/js/summernote.js')
    // .sourceMaps()
;

// mix.sass('node_modules/admin-lte/node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css');
//
// mix.postCss('node_modules/admin-lte/plugins/summernote/summernote-bs4.css', 'public/css/summernote.css');
// // styles 로 믹스하면 폰트 복사가 안됨
// // mix.styles('node_modules/admin-lte/plugins/summernote/summernote-bs4.css', 'public/css/summernote.css');
//
// mix.scripts('node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
// // .sourceMaps()
// ;
// mix.scripts('node_modules/admin-lte/plugins/summernote/summernote-bs4.js', 'public/js/summernote.js')
// // .sourceMaps()
// ;

// mix.styles([
//     'public/vendor/summernote-0.8.18-dist/summernote.css',
//     // 'public/vendor/summernote-0.8.18-dist/summernote-bs4.css',
//     // 'public/vendor/summernote-0.8.18-dist/summernote-lite.css',
// ], 'public/css/summernote.css');

// mix.scripts([
//     'public/vendor/summernote-0.8.18-dist/summernote.js',
//     // 'public/vendor/summernote-0.8.18-dist/summernote-bs4.js',
//     // 'public/vendor/summernote-0.8.18-dist/summernote-lite.js',
// ], 'public/js/summernote.js')
//     // .sourceMaps()
// ;

if (mix.inProduction()) {
    mix.version();
}

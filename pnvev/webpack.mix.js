const mix = require('laravel-mix');

mix.sourceMaps(false, 'source-map') // Generate .css.map files (even in devlopment)
    .sass('resources/assets/sass/admin/admin.scss', 'public/css_v2')
    .sass('resources/assets/sass/admin/user.scss', 'public/css_v2')
    .sass('resources/assets/sass/admin/home.scss', 'public/css_v2')
    .sass('resources/assets/sass/admin/dbviews.scss', 'public/css_v2')
    .js('resources/assets/js/admin.js', 'public/js_v2')
    .js('resources/assets/js/diseases.js', 'public/js_v2');

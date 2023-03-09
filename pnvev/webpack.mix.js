const mix = require('laravel-mix');

/*
 * See https://stackoverflow.com/a/71116953 about webpackConfig details.
 */

mix.sourceMaps(false, 'source-map') // Generate .css.map files (even in devlopment)
    .webpackConfig({
        module: {
            rules: [
              {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                  loader: 'babel-loader',
                  options: {
                    presets: [
                      ['@babel/preset-env', { targets: "defaults" }]
                    ]
                  }
                }
              }
            ]
          }
    })
    .sass('resources/assets/sass/admin/admin.scss', 'public/css_v2')
    .js('resources/assets/js/admin.js', 'public/js_v2')
    .js('resources/assets/js/dbviews.js', 'public/js_v2')
    .js('resources/assets/js/diseases.js', 'public/js_v2');

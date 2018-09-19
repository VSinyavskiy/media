/* eslint-disable
  strict,
  lines-around-directive,
  import/order,
  import/no-extraneous-dependencies,
  no-restricted-syntax
*/
'use strict';

const helpers = require('./helpers.js');
const glob = require('glob');
const path = require('path');
const webpack = require('webpack');
const webpackMerge = require('webpack-merge');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const HtmlWebpackHarddiskPlugin = require('html-webpack-harddisk-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
// const WriteFilePlugin = require('write-file-webpack-plugin');

module.exports = function({
  env = 'development',
  outputDir = 'build',
  srcJS = 'app',
} = {}) {
  const OUTPUT_DIR = outputDir;
  const JS_VARIANT = srcJS;
  const PROD = !!(env === 'production');
  const DEV_SERVER = !!(env === 'dev-server');
  const PAGES = glob.sync(helpers.rootPath('./src/pug/*.pug'), {
    nodir: true,
    nonull: false,
  }).map(filename => path.parse(filename).name);
  const QUERY = {
    fonts: ['outputPath=fonts/', 'publicPath=../fonts/', 'name=[name].[ext]', 'limit=10000'].join('&'),
    images: ['outputPath=img/', 'publicPath=../img/', 'name=[name].[ext]'].join('&'),
    template_images: ['outputPath=img/', 'publicPath=assets/img/', 'name=[name].[ext]'].join('&'),
    files: ['outputPath=files/', 'publicPath=../files/', 'name=[name].[ext]'].join('&'),
    template_files: ['outputPath=files/', 'publicPath=assets/files/', 'name=[name].[ext]'].join('&'),
  };
  const CSSNANO_OPTIONS = PROD ? {
    // cssnano options
    autoprefixer: false,
    zindex: false,
  } : false;

  let defaults = {
    resolve: {
      modules: [
        'node_modules',
        helpers.rootPath('./src/js/'),
        helpers.rootPath('./src/vendor/'),
      ],
      alias: {
        Vendors: helpers.rootPath('./src/vendor/'),
        Scripts: helpers.rootPath('./src/js/'),
        Styles: helpers.rootPath('./src/styles/'),
        Templates: helpers.rootPath('./src/pug/'),
        Images: helpers.rootPath('./src/img/'),
        Fonts: helpers.rootPath('./src/fonts/'),
      },
      extensions: ['.js', '.jsx'],
    },
  };

  let config = webpackMerge(defaults, {
    // devtool: 'cheap-module-eval-source-map',
    devtool: 'source-map',
    context: helpers.rootPath(),
    entry: {
      vendor: [
        'dom4',
        'delegated-events',
        // 'jquery',
        './src/js/vendor/vendor.js',
      ],
      application: [
        './src/styles/vendors.css',
        './src/styles/vendors.scss',
        './src/styles/application.scss',
        `./src/js/${JS_VARIANT}/application.js`,
      ],
    },
    output: {
      path: helpers.rootPath(OUTPUT_DIR, 'assets/'),
      publicPath: 'assets/',
      filename: 'js/[name].js', // .[hash:4]
      chunkFilename: 'js/[id].[name].js', // .[chunkhash:4]
      library: 'Markup',
    },
    module: {
      rules: [{
        enforce: 'pre',
        test: /\.(js|jsx)$/,
        include: helpers.rootPath('./src/js/'),
        use: 'eslint-loader',
      }, {
        test: /\.(js|jsx)$/,
        exclude: RegExp(`node_modules|src(\\|/)vendor|${OUTPUT_DIR}`),
        loader: 'babel-loader',
        options: {
          cacheDirectory: true,
        },
      }, {
        test: /\.(js|jsx)$/,
        include: helpers.rootPath('./src/vendor/'),
        use: 'script-loader',
      }, {
        test: /\.(sass|scss)$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [{
            loader: 'css-loader',
            options: {
              minimize: CSSNANO_OPTIONS,
              sourceMap: true,
              importLoaders: 3,
            },
          }, {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
            },
          }, {
            loader: 'sass-loader',
            options: {
              precision: 8,
              sourceMap: true,
              // includePaths: [helpers.rootPath('./src/styles/sass/')],
            },
          }],
        }),
      }, {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [{
            loader: 'css-loader',
            options: {
              minimize: CSSNANO_OPTIONS,
              sourceMap: true,
              importLoaders: 1,
            },
          }, {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
            },
          }],
        }),
      }, {
        test: /\.(pug)$/,
        loader: 'pug-loader',
        options: {
          root: helpers.rootPath('./src/pug/'),
          pretty: false,
        },
      },
      { test: /\.woff(\?.*)?$/, use: `url-loader?mimetype=application/font-woff&${QUERY.fonts}` },
      { test: /\.woff2(\?.*)?$/, use: `url-loader?mimetype=application/font-woff2&${QUERY.fonts}` },
      { test: /\.otf(\?.*)?$/, use: `url-loader?mimetype=font/opentype&${QUERY.fonts}` },
      { test: /\.ttf(\?.*)?$/, use: `url-loader?mimetype=application/octet-stream&${QUERY.fonts}` },
      { test: /\.eot(\?.*)?$/, use: `file-loader?${QUERY.fonts}` },
      {
        test: /\.svg(\?.*)?$/,
        include: /fonts?(\\|\/)/,
        issuer: { exclude: helpers.rootPath('./src/pug/') },
        use: `url-loader?mimetype=image/svg+xml&${QUERY.fonts}`,
      }, {
        test: /\.svg(\?.*)?$/,
        exclude: /fonts?(\\|\/)/,
        issuer: { exclude: helpers.rootPath('./src/pug/') },
        use: `file-loader?${QUERY.images}`,
      }, {
        test: /\.(png|jpe?g|gif)$/,
        issuer: { exclude: helpers.rootPath('./src/pug/') },
        use: `file-loader?${QUERY.images}`,
      }, {
        test: /\.(png|jpe?g|gif|svg)$/,
        issuer: { include: helpers.rootPath('./src/pug/') },
        use: `file-loader?${QUERY.template_images}`,
      }, {
        test: /\.(xlsx?|docx?|pdf|zip|rar|mpe?g4|webm)$/i,
        issuer: { exclude: helpers.rootPath('./src/pug/') },
        use: `file-loader?${QUERY.files}`,
      }, {
        test: /\.(xlsx?|docx?|pdf|zip|rar|mpe?g4|webm)$/i,
        issuer: { include: helpers.rootPath('./src/pug/') },
        use: `file-loader?${QUERY.template_files}`,
      }],
    },
    plugins: [
      new webpack.NamedModulesPlugin(),
      new webpack.DefinePlugin({
        PROD: JSON.stringify(PROD),
      }),
      new webpack.ProvidePlugin({
        '$': 'jquery',
        'jQuery': 'jquery',
        'window.jQuery': 'jquery',
      }),
      new webpack.optimize.CommonsChunkPlugin({
        name: 'vendor',
        minChunks(module) {
          return module.context && module.context.indexOf('node_modules') !== -1;
        },
      }),
      new webpack.optimize.CommonsChunkPlugin({
        names: ['common'],
      }),
      new ExtractTextPlugin({ filename: 'css/[name].css', allChunks: true }), // .[contenthash:4]
      new CopyWebpackPlugin([
        { from: 'src/game', to: 'game' },
      ], {
        cache: true,
      }),
    ],
    watchOptions: {
      ignored: RegExp(`node_modules|src(\\|/)vendor|${OUTPUT_DIR}`),
    },
    devServer: {
      // historyApiFallback: true,
      contentBase: helpers.rootPath(OUTPUT_DIR),
      publicPath: 'http://localhost:9000/assets/',
      compress: false,
      host: '0.0.0.0',
      port: 9000,
      disableHostCheck: true,
      stats: 'minimal',
      overlay: {
        warnings: false,
        errors: true,
      },
      headers: { 'Access-Control-Allow-Origin': '*' },
      staticOptions: {
        index: '*.*',
      },
    },
  });

  // Build static pages
  for (let tpl of PAGES) {
    config.plugins.push(
      new HtmlWebpackPlugin({
        alwaysWriteToDisk: true,
        inject: false,
        filename: helpers.rootPath(OUTPUT_DIR, `${tpl}.html`),
        template: helpers.rootPath(`./src/pug/${tpl}.pug`),
        minify: {
          collapseWhitespace: true,
          // conservativeCollapse: true,
          collapseInlineTagWhitespace: false,
        },
        env: {
          prod: PROD,
          pages: PAGES,
        },
      }),
    );
  }
  config.plugins.push(new HtmlWebpackHarddiskPlugin());

  // if (DEV_SERVER) {
  //   config = webpackMerge(config, {
  //     plugins: [
  //       new WriteFilePlugin({
  //         test: /game(\\|\/)/,
  //         useHashIndex: true,
  //       }),
  //     ],
  //   });
  // }

  if (!DEV_SERVER) {
    config = webpackMerge(config, {
      plugins: [
        new CleanWebpackPlugin([OUTPUT_DIR], {
          root: helpers.rootPath(),
          // exclude: ['shared.js'],
          verbose: true,
          dry: DEV_SERVER,
        }),
      ],
    });
  }

  // Configuration alterations for production
  if (PROD) {
    config = webpackMerge(config, {
      devtool: 'source-map',
      plugins: [
        new ImageminPlugin({
          test: /\.(jpe?g|png|gif|svg)$/i,
        }),
        new webpack.LoaderOptionsPlugin({
          minimize: true,
          debug: false,
        }),
        new webpack.optimize.UglifyJsPlugin({
          compress: {
            drop_console: true,
            unused: true,
            dead_code: true,
            warnings: false,
          },
        }),
      ],
    });
  }

  return config;
};

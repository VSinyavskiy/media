/* eslint-disable
  strict,
  lines-around-directive
*/
'use strict';

const env = process.env.NODE_ENV;

process.noDeprecation = true;

module.exports = require('./config/webpack.default.js')({
  env: process.env.NODE_ENV,
  outputDir: env === 'dev-server' ? 'dev' : 'build',
  // outputDir: 'build',
  // outputDir: 'dev',
  // srcJS: 'app',
});

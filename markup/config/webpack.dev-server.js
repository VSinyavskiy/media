process.noDeprecation = true;

module.exports = require('./webpack.default.js')({
  env: process.env.NODE_ENV,
  // outputDir: 'build',
  outputDir: 'dev',
  // srcJS: 'app',
});

/* eslint-disable
  strict,
  lines-around-directive,
*/
'use strict';

let path = require('path');

let root = path.resolve(__dirname, '..');
function rootPath(...args) {
  return path.join(...[root].concat(args));
}

module.exports = { rootPath };

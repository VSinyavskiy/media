/* eslint-disable
  import/order,
  import/no-extraneous-dependencies,
*/
const helpers = require('./helpers.js');
const htmlBeautify = require('js-beautify').html;
const fs = require('fs');
const glob = require('glob');
const options = require('../.jsbeautifyrc.json');

glob(helpers.rootPath('./build/*.html'), { absolute: true }, (err, files) => {
  if (err) throw err;
  files.forEach((file) => {
    const data = fs.readFileSync(file, 'utf8');
    const beautifiedData = htmlBeautify(data, options);
    fs.writeFileSync(file, beautifiedData, 'utf8');
    console.log(`html-beautify ${file}`);
  });
});

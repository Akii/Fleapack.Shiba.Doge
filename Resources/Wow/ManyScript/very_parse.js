var DSON = require('dson-djs');

var suchArguments = process.argv.slice(2);
var wowArgument = suchArguments.join(' ');

console.log(DSON.parse(wowArgument));
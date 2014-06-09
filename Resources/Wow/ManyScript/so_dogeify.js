var DSON = require('dson-djs');

var suchArguments = process.argv.slice(2);
var wowArgument = suchArguments[0];

// if shibe thinks this package is going to be save, shibe going to have a bad time
var suchJson = eval("(" + wowArgument + ")");

console.log(DSON.dogeify(suchJson));
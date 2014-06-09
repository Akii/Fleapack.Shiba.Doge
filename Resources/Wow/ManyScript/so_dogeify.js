var DSON = require('dson-djs');

var readline = require('readline');
var rl = readline.createInterface({
	input: process.stdin,
	output: process.stdout
});

rl.on('line', function(line){
	// if shibe thinks this package is going to be save, shibe going to have a bad time
	var suchJson = eval("(" + line + ")");
	console.log(DSON.dogeify(suchJson));
});
var DSON = require('dson-djs');

var readline = require('readline');
var rl = readline.createInterface({
	input: process.stdin,
	output: process.stdout
});

rl.on('line', function(line){
	console.log(JSON.stringify(DSON.parse(line), null, 2));
});
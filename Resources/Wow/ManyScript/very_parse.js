var DSON = require('dson-djs');

var readline = require('readline');
var rl = readline.createInterface({
	input: process.stdin,
	output: process.stdout
});

rl.on('line', function(line){
	console.log(DSON.parse(line));
});
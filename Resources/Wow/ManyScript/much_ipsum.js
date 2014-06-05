var veryword = [
	'ipsum', 'lorem', 'layout', 'text', 'word', 'design', 'swag', 'doge', 'full',
	'ipsum', 'lorem', 'layout', 'text', 'word', 'design', 'swag', 'doge', 'full',
	'ipsum', 'lorem', 'layout', 'text', 'word', 'design', 'swag', 'doge', 'full',
	'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit', 'aenean', 'mattis'
];

var muchtemp = veryword.slice(0);
var suchpunctuation = [',', '.', '!']

function r(arr) {
	if (muchtemp.length === 0) {
		muchtemp = veryword.slice(0);
	}

	if (!arr) {
		arr = muchtemp;
	}

	var veryindex = Math.floor(Math.random() * arr.length);
	var suchreturn = arr[veryindex];

	muchtemp.splice(veryindex, 1);

	if (suchpunctuation.indexOf(suchreturn.substr(-1)) === -1) {
		suchreturn += suchpunctuation[Math.floor(Math.random() * suchpunctuation.length)];
	}

	return suchreturn;
}

var dogefix = [
	'wow', 'such ' + r(), 'very ' + r(), 'much ' + r(),
	'wow', 'such ' + r(), 'very ' + r(), 'much ' + r(),
	'wow', 'such ' + r(), 'very ' + r(), 'much ' + r(),
	'wow', 'such ' + r(), 'very ' + r(), 'much ' + r(),
	'wow', 'such ' + r(), 'very ' + r(), 'much ' + r(),
	'so ' + r(), 'many ' + r(), 'want ' + r(),
	'i can haz ' + r(), 'i iz cute?', 'yes master doge',
	'plz ' + r(), 'oh my ' + r(), 'rate me', 'txt me',
	'so ' + r(), 'many ' + r(), 'want ' + r(),
	'plz ' + r(), 'oh my ' + r(),
	'so ' + r(), 'many ' + r(), 'want ' + r(),
	'plz ' + r(), 'oh my ' + r(),
	'go ' + r(), 'need ' + r(),
	'go ' + r(), 'need ' + r(),
];

function generateIpsum(qtd) {
	var ipsum = "";
	for (var x = 0; x < qtd; x++) {
		ipsum += r(dogefix) + " ";
		if (x % 50 == 0 && x != 0) {
			ipsum += "\n";
		}
	}
	return ipsum;
}

var suchArguments = process.argv.slice(2);
var wowArgument = suchArguments[0];

console.log(generateIpsum(wowArgument));
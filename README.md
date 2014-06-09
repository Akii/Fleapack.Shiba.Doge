Fleapack.Shiba.Doge
======

Shiba for TYPO3 Flow

![Doge](http://dogeon.org/doge.gif)

### What does Fleapack.Shiba.Doge provide?

The package provides a variety of things to dogeify your TYPO3 Flow applications. By default, any JSON output will be automatically converted to DSON (<http://dogeon.org>). Any HTML will be enriched with wise words from Shiba.

## Installation
### Composer

	{
		"require": {
			"fleapack/shiba-doge": "dev-master"
		}
	}

Or run `composer require fleapack/shiba-doge dev-master`.

### Requirements

This needs node.js for random things. Just install node and run those commands:

```npm install dogescript```

```npm install dson-djs```

## Configuration

In the `Settings.yaml` file, you can adjust what is dogeified automatically and how much should be dogeified.

## Examples
After installing this package, navigate your favorite user-agent to the following urls (replace "wow.local" with your own host):


This will show the current website

```
http://wow.local/Fleapack.Shiba.Doge/Test/Dson
```

Example JSON output. Depending on the configuration this might be DSON (default).

```
http://wow.local/Fleapack.Shiba.Doge/Test/Dson.json
```

Example DSON output.

```
http://wow.local/Fleapack.Shiba.Doge/Test/Dson.dson
```

This demonstrates the MuchIpsumViewHelper:
```
http://wow.local/Fleapack.Shiba.Doge/Test/Show
```

## Configuring Packages with DSON

Yes, that's a thing now. Just add your configuration file as you normally would with the right file extension and contents. Note: DSON files will have precedence over YAML configurations. Shiba highly recommends installing the `zegl/dson-php` package though, other methods have such bugs, result so bad configuration. Wow.
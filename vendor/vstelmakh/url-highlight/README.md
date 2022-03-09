<img src="./resources/url-highlight-logo.svg" width="286" height="93" alt="Url highlight logo">

---

[![Build status](https://github.com/vstelmakh/url-highlight/workflows/build/badge.svg?branch=master)](https://github.com/vstelmakh/url-highlight/actions)
[![Packagist version](https://img.shields.io/packagist/v/vstelmakh/url-highlight?color=orange)](https://packagist.org/packages/vstelmakh/url-highlight)
[![PHP version](https://img.shields.io/packagist/php-v/vstelmakh/url-highlight)](https://www.php.net/)
[![License](https://img.shields.io/github/license/vstelmakh/url-highlight?color=yellowgreen)](LICENSE)

**Url highlight** - PHP library to parse URLs from string input. Works with complex URLs, edge cases and encoded input.  

Features:
- Replace URLs in string by HTML tags (make clickable)
- Match URLs without scheme by top-level domain
- Work with HTML entities encoded input
- Extract URLs from string
- Check if string is URL

## Installation
Install the latest version with [Composer](https://getcomposer.org/):  
```bash
composer require vstelmakh/url-highlight
```
Also, there are
 [<img src="./resources/twig-logo.png" width="8" height="12" alt="Twig logo"> Twig extension](https://github.com/vstelmakh/url-highlight-twig-extension)
 and [<img src="./resources/symfony-logo.png" width="12" height="12" alt="Symfony logo"> Symfony bundle](https://github.com/vstelmakh/url-highlight-symfony-bundle) available.  

## Quick start  
```php
<?php
require __DIR__ . '/vendor/autoload.php';

use VStelmakh\UrlHighlight\UrlHighlight;

$urlHighlight = new UrlHighlight();
echo $urlHighlight->highlightUrls('Hello, http://example.com.');

// Output:
// Hello, <a href="http://example.com">http://example.com</a>.
```

To properly handle HTML entity escaped string, see [Encoder](#encoder).

## Usage
#### Check if string is URL
```php
<?php
$urlHighlight->isUrl('http://example.com'); // return: true
$urlHighlight->isUrl('Other string'); // return: false
```

#### Parse URLs from string
```php
<?php
$urlHighlight->getUrls('Hello, http://example.com.');
// return: ['http://example.com']
```

#### Replace URLs by HTML tags (make clickable)
```php
<?php
$urlHighlight->highlightUrls('Hello, http://example.com.');
// return: 'Hello, <a href="http://example.com">http://example.com</a>.'
```

## Configuration
There are 3 parts which could be configured according to your needs:
- [Validator](#validator) - define if match is valid and should be recognized as URL (e.g. allow/disallow specific schemes)
- [Highlighter](#highlighter) - define the way how URL should be highlighted (e.g. replaced by html `<a>` tag)
- [Encoder](#encoder) - define how to work with encoded input (e.g. html special chars)

Configuration provided via constructor implementing corresponding interface instance.
Use `null` to keep default:  
```php
<?php
use VStelmakh\UrlHighlight\Encoder\HtmlSpecialcharsEncoder;
use VStelmakh\UrlHighlight\UrlHighlight;
use VStelmakh\UrlHighlight\Validator\Validator;

$validator = new Validator();
$encoder = new HtmlSpecialcharsEncoder();
$urlHighlight = new UrlHighlight($validator, null, $encoder);
```

### Validator
There is one validator bundled with the library. Which is used by default with settings listed below.  
Create validator instance to define different properties:

```php
<?php
use VStelmakh\UrlHighlight\UrlHighlight;
use VStelmakh\UrlHighlight\Validator\Validator;

$validator = new Validator(
    true, // bool - if should use top level domain to match urls without scheme
    [],   // string[] - array of blacklisted schemes
    [],   // string[] - array of whitelisted schemes
    true  // bool - if should match emails (if match by TLD set to "false" - will match only "mailto" urls)
);
$urlHighlight = new UrlHighlight($validator);
```
If you need custom behavior - create and use your own validator implementing [ValidatorInterface](./src/Validator/ValidatorInterface.php).  

### Highlighter
There are 2 highlighters bundled with the library:
- `HtmlHighlighter` - converts matches to html tags.  
    Example: `http://example.com` &rarr; `<a href="http://example.com">http://example.com</a>`
- `MarkdownHighlighter` - converts matches to markdown format.  
    Example: `http://example.com` &rarr; `[http://example.com](http://example.com)`

By default, `HtmlHighlighter` is used, with settings listed below.  

Highlighter usage example:  

```php
<?php
use VStelmakh\UrlHighlight\Highlighter\HtmlHighlighter;
use VStelmakh\UrlHighlight\UrlHighlight;

$highlighter = new HtmlHighlighter(
    'http', // string - scheme to use for urls matched by top level domain
    []      // string[] - key/value map of tag attributes, e.g. ['rel' => 'nofollow', 'class' => 'light']
);
$urlHighlight = new UrlHighlight(null, $highlighter);
```
If you need custom behavior - create and use your own highlighter implementing [HighlighterInterface](./src/Highlighter/HighlighterInterface.php).  

### Encoder
Encoder should be used to handle encoded input properly. For example HTML escaped string could contain something
like: `http://example.com?a=1&quot;` or `http://example.com?a=1&amp;b=2` which will be wrongly matched as URL.

By default, there is no encoder used. There are 2 encoders bundled with library:
- `HtmlEntitiesEncoder` - to work with HTML entities encoded string (any character expected to be HTML entity encoded)
- `HtmlSpecialcharsEncoder` - to work with HTML escaped string (only `&` `"` `'` `<` `>` expected to be encoded)

Encoder usage example:

```php
<?php
use VStelmakh\UrlHighlight\Encoder\HtmlSpecialcharsEncoder;
use VStelmakh\UrlHighlight\UrlHighlight;

$encoder = new HtmlSpecialcharsEncoder();
$urlHighlight = new UrlHighlight(null, null, $encoder);

$urlHighlight->highlightUrls('&lt;a href=&quot;http://example.com&quot;&gt;Example&lt;/a&gt;');
// return: '&lt;a href=&quot;<a href="http://example.com">http://example.com</a>&quot;&gt;Example&lt;/a&gt;'
```
If you need custom behavior - create and use your own encoder implementing [EncoderInterface](./src/Encoder/EncoderInterface.php).  
Keep in mind - using **encoder require more regex operations and could have performance impact**.
Better to not use encoder if you don't expect encoded string.

## Credits
[Volodymyr Stelmakh](https://github.com/vstelmakh)  
Licensed under the MIT License. See [LICENSE](LICENSE) for more information.  

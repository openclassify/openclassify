# A PHP port of the YUI CSS compressor

[![Latest Stable Version](https://poser.pugx.org/tubalmartin/cssmin/v/stable)](https://packagist.org/packages/tubalmartin/cssmin) [![Total Downloads](https://poser.pugx.org/tubalmartin/cssmin/downloads)](https://packagist.org/packages/tubalmartin/cssmin) [![Daily Downloads](https://poser.pugx.org/tubalmartin/cssmin/d/daily)](https://packagist.org/packages/tubalmartin/cssmin) [![License](https://poser.pugx.org/tubalmartin/cssmin/license)](https://packagist.org/packages/tubalmartin/cssmin)

This port is based on version 2.4.8 (Jun 12, 2013) of the [YUI compressor](https://github.com/yui/yuicompressor).   
This port contains fixes & features not present in the original YUI compressor.

**Table of Contents**

1.  [Installation & requirements](#install)
2.  [How to use](#howtouse)
3.  [Tests](#tests)
4.  [API Reference](#api)
5.  [Who uses this?](#whousesit)
6.  [Changelog](#changelog)

<a name="install"></a>

## 1. Installation & requirements

### Installation

Use [Composer](http://getcomposer.org/) to include the library into your project:

    $ composer.phar require tubalmartin/cssmin

Require Composer's autoloader file:

```php
<?php

require './vendor/autoload.php';

use tubalmartin\CssMin\Minifier as CSSmin;

// Use it!
$compressor = new CSSmin;
```

### Requirements

* PHP 5.3.2 or newer with PCRE extension.

<a name="howtouse"></a>

## 2. How to use

There are three ways you can use this library:

1. [PHP](#php)
2. [CLI](#cli)
3. [GUI](#gui)

<a name="php"></a>

### PHP

```php
<?php

// Autoload libraries
require './vendor/autoload.php';

use tubalmartin\CssMin\Minifier as CSSmin;

// Extract the CSS code you want to compress from your CSS files
$input_css = file_get_contents('test.css');

// Create a new CSSmin object.
// By default CSSmin will try to raise PHP settings.
// If you don't want CSSmin to raise the PHP settings pass FALSE to
// the constructor i.e. $compressor = new CSSmin(false);
$compressor = new CSSmin;

// Set the compressor up before compressing (global setup):

// Keep sourcemap comment in the output.
// Default behavior removes it.
$compressor->keepSourceMapComment();

// Remove important comments from output.
$compressor->removeImportantComments();

// Split long lines in the output approximately every 1000 chars.
$compressor->setLineBreakPosition(1000);

// Override any PHP configuration options before calling run() (optional)
$compressor->setMemoryLimit('256M');
$compressor->setMaxExecutionTime(120);
$compressor->setPcreBacktrackLimit(3000000);
$compressor->setPcreRecursionLimit(150000);

// Compress the CSS code!
$output_css = $compressor->run($input_css);

// You can override any setup between runs without having to create another CSSmin object.
// Let's say you want to remove the sourcemap comment from the output and
// disable splitting long lines in the output.
// You can achieve that using the methods `keepSourceMap` and `setLineBreakPosition`:
$compressor->keepSourceMapComment(false);
$compressor->setLineBreakPosition(0);
$output_css = $compressor->run($input_css); 

// Do whatever you need with the compressed CSS code
echo $output_css;
```

<a name="cli"></a>

### CLI

A binary file named `cssmin` will be created after installation in `./vendor/bin` folder.

Output help:
```
./vendor/bin/cssmin -h
```
Output compression result to the command line:
```
./vendor/bin/cssmin -i ./my-css-file.css
```
Output compression result to another file:
```
./vendor/bin/cssmin -i ./my-css-file.css -o ./my-css-file.min.css
```
Output compression result to another file and keep sourcemap comment in the output:
```
./vendor/bin/cssmin -i ./my-css-file.css -o ./my-css-file.min.css --keep-sourcemap
```
See the binary help for all available CLI options.

<a name="gui"></a>

### GUI

We've made a simple web based GUI to use the compressor, it's in the `gui` folder.

GUI features:

* Optional on-the-fly LESS compilation before compression with error reporting included.
* Absolute control of the library.

How to use the GUI:

* You need a server with PHP 5.3.2+ installed.
* Download the repository and upload it to a folder in your server.
* Run `php composer.phar install` in project's root to install dependencies.
* Open your favourite browser and enter the URL to the `/gui` folder.

<a name="tests"></a>

## 3. Tests

Tests from YUI compressor have been modified to fit this port.

How to run the test suite:

* Run `php composer.phar install` in project's root to install dependencies. `phpunit` will be installed locally.
* After that, run `phpunit` in the command line:

```
./vendor/bin/phpunit
```

PHPUnit diffing is too simple so when a test fails it's hard to see the actual diff, that's why I've created a 
test runner that displays inline coloured diffs for a failing test. Only one test can be run at a time.

Here's how to use it:

```
./tests/bin/runner -t <expectation-name> [-f <fixture-name>] [--keep-sourcemap] [--remove-important-comments] [--linebreak-position <pos>]
```

<a name="api"></a>

## 4. API Reference

### __construct ([ bool *$raisePhpLimits* ])

Class constructor, creates a new CSSmin object.

**Parameters**

*raisePhpLimits*

If TRUE, CSSmin will try to raise the values of some php configuration options.
Set to FALSE to keep the values of your php configuration options.
Defaults to TRUE.

### run (string *$css*)

Minifies a string of uncompressed CSS code.
`run()` may be called multiple times on a single CSSmin instance.

**Parameters**

*css*

A string of uncompressed CSS code.
CSSmin default value: `''` (empty string).

**Return Values**

A string of compressed CSS code or an empty string if no string is passed.

### keepSourceMapComment (bool *$keepSourceMap*)

Sets whether to keep sourcemap comment `/*# sourceMappingURL=<path> */`in the output.  
CSSmin default behavior: Sourcemap comment gets removed from output.

### removeImportantComments (bool *$removeImportantComments*)

Sets whether to remove important comments from output.  
CSSmin default behavior: Important comments outside declaration blocks are kept in the output.

### setLinebreakPosition (int *$position*)

Some source control tools don't like it when files containing lines longer than, say 8000 characters, are checked in.
The linebreak option is used in that case to split long lines after a specific column.

CSSmin default value: `0` (all CSS code in 1 long line).  
Minimum value supported: `1`.

### setMaxExecutionTime (int *$seconds*)

Sets the `max_execution_time` configuration option for this script

CSSmin default value: `60`  
Values & notes: [max_execution_time documentation](http://php.net/manual/en/info.configuration.php#ini.max-execution-time)

### setMemoryLimit (mixed *$limit*)

Sets the `memory_limit` configuration option for this script

CSSmin default value: `128M`  
Values & notes: [memory_limit documentation](http://php.net/manual/en/ini.core.php#ini.memory-limit)

### setPcreBacktrackLimit (int *$limit*)

Sets the `pcre.backtrack_limit` configuration option for this script

CSSmin default value: `1000000`  
Values & notes: [pcre.backtrack_limit documentation](http://php.net/manual/en/pcre.configuration.php#ini.pcre.backtrack-limit)

### setPcreRecursionLimit (int *$limit*)

Sets the `pcre.recursion_limit` configuration option for this script.

CSSmin default value: `500000`  
Values & notes: [pcre.recursion_limit documentation](http://php.net/manual/en/pcre.configuration.php#ini.pcre.recursion-limit)


<a name="whousesit"></a>

## 5. Who uses this port

* [Magento](https://magento.com/) eCommerce platforms and solutions for selling online.
* [Minify](https://github.com/mrclay/minify) Minify is an HTTP content server. It compresses sources of content (usually files), combines the result and serves it with appropriate HTTP headers.
* [Autoptimize](http://wordpress.org/plugins/autoptimize/) is a Wordpress plugin. Autoptimize speeds up your website and helps you save bandwidth by aggregating and minimizing JS, CSS and HTML.
* [IMPRESSPAGES](http://www.impresspages.org/) PHP framework with content editor.
* [Other dependent Composer packages](https://packagist.org/packages/tubalmartin/cssmin/dependents).

<a name="changelog"></a>

## 6. Changelog

### v4.1.1 15 Jan 2018

FIXED:
* Breakage when minifying at-import rule with unquoted urls containing semicolons [#45](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/45)

### v4.1.0 16 May 2017

* NEW:
  * `--dry-run` CLI argument to perform a dry run and display statistics.
* IMPROVED:
  * Performance: 2x times faster than v4.0.0 after code profiling:
    * A 1MB file takes 1.8s with PHP 5.3.29 and 350ms with PHP 7.0.18 (on average).
    * A full Bootstrap v3.3.7 CSS suite takes 330ms with PHP 5.3.29 and 50ms with PHP 7.0.18 (on average).

### v4.0.0 15 May 2017

NEW:
* API:
  * Removed: `setChunkLength()` method and `--chunk-length` CLI argument.
  * Modified: `keepSourceMap()` method is now named `keepSourceMapComment()`. CLI argument `--keep-sourcemap` stays the same but we've added `--keep-sourcemap-comment` too.
  * Modified: `run()` method signature. It only accepts one argument now.
  * Added: `removeImportantComments()` method & `--keep-important-comments` CLI argument.
* Important comments `/*! ... */` can be optionally removed from output too calling `removeImportantComments()` method.

### v3.3.1 16 May 2017

* Backported performance improvements made in v4.1.0

### v3.3.0 13 May 2017

NEW:
* CLI binary displays some useful stats after execution.
* A concatenated file can be safely compressed now: `@charset`, `@import` & `@namespace` at-rules will be placed correctly. 
* Conditional group rules fully and safely supported, that is, unlimited rule nesting levels. Previously only one nesting level was fully supported.

NOTES:
* Pretty big refactor done for two main reasons:
  * Make minified output even more reliable even when a potential scenario has not been tested beforehand.
  * Make development, testing and contribution a bit easier due to simplified logic.
* As a consequence of this refactor, stylesheet chunking is not needed anymore. `setChunkLength` method and `--chunk-length` CLI argument
  still exist for backwards compatibility reasons but have no effect at all.

### v3.2.0 10 May 2017

NEW:
* PHPUnit added as test runner.
* CLI binary provided.
* CSS Sourcemap special comment supported.
* `ms` unit compression: from `300ms` to `.3s`.
* Shortable double colon (CSS3) pseudo-elements are now shortened to single colon (CSS2): from `::after` to `:after`.
* `background: none` & `background: transparent` are shortened to `background:0 0`.

IMPROVED:
* Some regular expressions.
* Long line splitting algorithm.
* Lowercasing pseudo-classes, pseudo-elements and functions to cover more cases.
* Shortening of suitable shorthand properties with repeated values. All cases are covered now.
* Tests.

FIXED:
* When splitting long lines in the output, if a comment or string contained closing curly braces `}`, the curly brace
  could be recognised as a selector or at-rule closing curly brace resulting in an unexpected newline being added.

### v3.1.2 17 Apr 2017

* Improved compression of long named colors: now all long named colors get compressed to their shorter HEX counterpart.
* Fixes cases such as [#39](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/39)
* Huge performance improvement after code profiling. See table below for results when running the whole test suite:

PHP version used: 5.3.29

| chunkLength | v3.1.1 | v3.1.2 |
| --- | --- | --- |
| 100 | 6.8s | 2.6s |
| 1000 | 5.3s | 2s |
| 2000 | 5.2s | 1.95s |
| 5000 | 5.1s | 1.9s |

PHP version used: 7.0.8

| chunkLength | v3.1.1 | v3.1.2 |
| --- | --- | --- |
| 100 | 2s | 0.72s |
| 1000 | 1s | 0.37s |
| 2000 | 0.8s | 0.33s |
| 5000 | 0.7s | 0.3s |


### v3.1.1 11 Apr 2017

* Regexes improved.
* Small performance improvements.
* Blocks such as `@media` blocks with empty rules are removed too.
* Quoted unquotable attribute selectors get unquoted now i.e. from `col[class*="col-"]` to `col[class*=col-]`. Covers most common cases. Safe approach.

### v3.1.0 9 Apr 2017

* Code deeply analyzed. Some areas rewritten from the ground up with maximum performance in mind. No change in compressor behavior.
* Fixed some hidden bugs discovered along the way that affected performance negatively.
* IE5/Mac comment hack removed from minifier logic. Those comments will no longer be preserved.
* The table below displays the performance optimization done in this version in comparison with the previous one running the whole test suite:

PHP version used: 5.3.29

| chunkLength | v3.0.0 | v3.1.0 |
| --- | --- | --- |
| 100 | 38s | 6.9s |
| 1000 | 8.5s | 5.4s |
| 2000 | 7.3s | 5.3s |
| 5000 | 5.8s | 5.2s |

PHP version used: 7.0.8

| chunkLength | v3.0.0 | v3.1.0 |
| --- | --- | --- |
| 100 | 22.8s | 2.1s |
| 1000 | 2.9s | 1.1s |
| 2000 | 2s | 0.9s |
| 5000 | 1.3s | 0.8s |

### v3.0.0 4 Apr 2017

* New API compliant with PSR-1, PSR-2 & PSR-4. PHP 5.3.2+ required. I think it was time!
* Many tests added, strengthened and fixed. Big, real life, stylesheets included such as Bootstrap or Foundation.
* Fixed some critical and minor issues, such as:
   * Chunking system breaking some stylesheets (broken at rules block) or leaving some bits off.
   * Backreferences in replacement strings breaking stylesheets.
   * [#23](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/23)
   * Others...
* Color compression improved. Now all named colors are supported i.e. from `white` to `#fff`.
* Shortening zero values is back but in a safe manner, shortening values assigned to "safe" properties only i.e. from `margin: 1px 0.0em 0rem 0%` to `margin:1px 0 0`. Check the code to see the list of "safe" properties.
* `padding` and `margin` properties are shortened to the bare minimum i.e. from `margin: 3px 2.1em 3px 2.1em` => `margin:3px 2.1em`
* Upgrading to v3 is strongly recommended for users enjoying PHP 5.3.2+. 

### v2.4.8-p10 4 Apr 2017

* This is the last v2 release. v3 onwards will only support PHP 5.3.2+.
* This patch has all improvements and fixes v3.0.0 has. See v3.0.0 notes for further info (no API change in this version of course).
* Updating to this patch is strongly recommended for users stuck with PHP versions lower than PHP 5.3.

### v2.4.8-p9 28 Mar 2017

* Rolling back property declaration with scalar expressions (>= PHP 5.6) introduced in v2.4.8-p8 to support PHP 5.0. No change in compressor behavior.

### v2.4.8-p8 27 Mar 2017

* Fixed issue [#18](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/pull/18)
* Added `set_chunk_length` method.
* `bold` & `normal` values get compressed to `700` & `400` respectively for `font-weight` property.
* GUI updated.
* FineDiff library loaded through Composer.
* README updated.

### v2.4.8-p7 26 Mar 2017

* Fixed many issues [#20](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/20), [#22](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/22), [#24](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/24), [#25](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/25), [#26](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/26) reported by contributors and others that I'm sure haven't been reported, at least yet. Sorry for the long delay guys.
* This release is all about stability and reliability and as such I've had to take some controversial decisions such as:
   * Not minifying `none` property value to `0` because in some subtle scenarios the resulting output may render some styles differently.
   * Not removing units from zero length values because in many cases the output will break the intended behavior. Patching every single case after someone finds a new breaking case is not good IMHO taking into account CSS is a live spec and browsers differ in some cases.
* Hope you agree with me removing those conflicting parts. Enjoy this release :)
   
### v2.4.8-p6 21 Mar 2017

* Fixed PHP CLI issues. See [#36](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/pull/36)

### v2.4.8-p5 27 Feb 2017

* Fixed PHP 7 issues.

### v2.4.8-p4 22 Sep 2014

* Composer support. The package is [tubalmartin/cssmin](https://packagist.org/packages/tubalmartin/cssmin)
* Fixed issue [#17]

### v2.4.8-p3 26 Apr 2014

* Fixed all reported bugs: See issues [#11], [#13] (first case only) and [#14].
* LESS compiler upgraded to version 1.7.0

### v2.4.8-p2 13 Nov 2013

* Chunk length reduced to 5000 chars (previously 25.000 chars) in an effort to avoid PCRE backtrack limits (needs feedback).
* Improvements for the `@keyframes 0%` step bug. Tests improved.
* Fix IE7 issue on matrix filters which browser accept whitespaces between Matrix parameters
* LESS compiler upgraded to version 1.4.2

### v2.4.8-p1 8 Aug 2013

* Fix for the `@keyframes 0%` step bug. Tests added.
* LESS compiler upgraded to version 1.4.1

[#11]: https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/11
[#13]: https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/13
[#14]: https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/14
[#17]: https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port/issues/17

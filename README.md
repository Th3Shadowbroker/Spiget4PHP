# Spiget4PHP
Spiget4PHP is a PHP-wrapper for the Spiget-API created by inventivetalent ([GitHub](https://github.com/inventivetalentDev) | [Website](https://inventivetalent.org))

## Composer
You can install the Spiget4PHP core using composer ([View on packagist](https://packagist.org/packages/th3shadowbroker/spiget4php)):
``` 
composer require th3shadowbroker/spiget4php
```
If you want to work more object-oriented it's recommended to install the obj-package too. ([View on packagist](https://packagist.org/packages/th3shadowbroker/spiget4php-obj) | [Git](https://github.com/th3shadowbroker/spiget4php-obj))
```
composer require th3shadowbroker/spiget4php-obj
```


## Example
```php
require 'SpigetAPI.php';
use de\m4taiori\spiget4php\SpigetAPI as SpigetAPI;

//Yes you can use 'new' but getInstance() is a better way because you don't have to create a ton of instances.
$spiget = SpigetAPI::getInstance();

/*
 * Some functions use optional arguments/parameters. Use null if you want to use the default value
 * defined by the spiget-web-api.
 * 
 * Nearly all functions in this lib throw SpigetExceptions if something's going horribly wrong or is just invalid. However
 * if you want to receive nulls instead of exceptions you can disable exceptions by using setThrowExceptions()
 * at any time.
 */

//Let's get a list of the categories
$categories = $spiget->getCategoryList();

//All results will be returned as PHP assoc.-array
var_dump($categories); //<-- Let's see the result as it is in PHP
```

## Suggestions and issues
If you have any suggestions or want to report an issue don't be afraid of using the issue-tracker. However most of the time
I'm not able to work on my "freetime-projects" so feel free to submit pull-request even if you've only corrected a typo :octocat:

## Plans for the future
I've already planned the implementation of the webhook-support provided by spiget. I haven't implemented webhook-support
yet because I don't need it for my purposes at the moment.

## Documentation
If you want to learn more about Spiget4PHP visit the [docs](https://docs.m4taiori.io/spiget4php/).

## Contact
Follow or just message me on social-media:
- [Twitter](https://twitter.com/m4taiori)
- [Keybase](https://keybase.io/th3shadowbroker)
- [M4taiori.de](https://m4taiori.de)
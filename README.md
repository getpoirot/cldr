
[[ Work in progress ]]

I will put more example and documentation.

at very basic, you may use something like this:


```php

$locale = \Locale::getDefault();
$mainProvider = new \Poirot\Cldr\DataProvider\MainProvider($locale);

echo $mainProvider->getCharacterOrder(); // right-to-left

/*
array(3) {
  ["metric"]=>
  string(10) "متریک"
  ["UK"]=>
  string(20) "بریتانیایی"
  ["US"]=>
  string(16) "امریکایی"
}
*/
$mn = $mainProvider->getMeasurementSystemNames();

$mainProvider->setLocale('en');
echo $mainProvider->getTerritoryName('IR'); // Iran

/* Use custom data path */
// Iran
echo $mainProvider->getRepoReader()
    ->getEntityByPath(
        'localeDisplayNames/territories/territory',
        array('type' => 'IR')
    );

```

## Support ##
To report bugs or request features, please visit the [Issue Tracker](https://github.com/phpoirot/cldr/issues).

*Please feel free to contribute with new issues, requests and code fixes or new features.*

The contents of this repo will fix the asset preview url issues on Craft 4 until version 4.2.0.2

### Instructions
1. Download this repository and copy it inside your modules folder
2. Rename this folder to `assetpreview`
3. Load the module inside `config/app.php` or `config/app.web.php` like this
```php
    'modules' => [
        //...
        'asset-preview' => \modules\assetpreview\Module::class,
        //...
    ],
    'bootstrap' => ['asset-preview'],
```

4. Make sure to remove this module after Craft CMS provides an official fix
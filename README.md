Stingray
======

Stingray - Access array elements via dot notation

Installing via Composer
-----------------------
Add Stingray to your project:

```bash
$>  composer.phar require projectmeta/stingray *
```

or directly to composer.json:

```json
{
    "require": {
        "projectmeta/stingray": "*"
    }
}
```

Then update your dependencies:

```bash
$>  composer.phar update
```

Example Usage
-----------------------
To get any node from an array:
```php
<?php

//Some file needing access to array nodes

use projectmeta\Stingray\Stingray;

$stingray = new Stingray();

$someArray = array(
    'node_lvl1' => array(
        'node_lvl2' = array(
            'node_lvl3a' => true,
            'node_lvl3b' => false,
            'node_lvl3c' => array()
            )
        )
    )
);

$nodeAlias = 'node_lvl1.node_lvl2.node_lvl3a';

$newValue = false;

// return true
$stingray->get($someArray, $nodeAlias);

// change true to false
$stingray->set($someArray, $nodeAlias, $newValue);
```

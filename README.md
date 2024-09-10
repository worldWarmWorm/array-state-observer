# array-state-observer

### Content
* [Installation](#installation)
* [Call and using library](#call-and-using-library)
* [GitHub](#github)

### Installation
array-state-observer can be installed by using [Composer](https://getcomposer.org), just run this command in your project:

```
composer require world-warm-worm/array-state-observer
```

### Call and using library
Simple example of calling and using library:

```php
<?php

require_once('vendor/autoload.php');

use WorldWarmWorm\ArrayStateObserver\SimpleArrayObserver;

// we have some dummy initial data. let it be three ids of something
$before = [1, 2, 3];

// let's change initial data through some job with it
$after = array_slice($before, 0, 2);

// here we have object of SimpleArrayObserver that contains calculated data
$observer = SimpleArrayObserver::init($before, $after);

// here we want to get all of calculated data
$result = $observer->all();

// that's it!
var_dump($result);

// short notation
// var_dump(SimpleArrayObserver::init($before, $after)->all());

/** 
  array(2) {
    ["added"]=>
    array(0) {
    }
    ["deleted"]=>
    array(1) {
      [2]=>
      string(1) "3"
    }
  }
 */
```

In case we are sure that the data will only be deleted or only added, the corresponding methods are provided. In the example above we removed the last id from the array. So we can confidently use method deleted() and get only deleted id to work with it further:

 ```
var_dump(SimpleArrayObserver::init($before, $after)->deleted());

/** 
  array(1) {
     [2]=>
     int(3)
   }
*/

```

### GitHub

You are welcome to [array-state-observer ](https://github.com/worldWarmWorm/array-state-observer)
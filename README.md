# Exchange rates
> Currency exchange rates lib for PHP
## Description
It's test project. Exchange rates only for pairs USD/RUR and EUR/RUR
### Example
```php
use Rate\Rate;

require_once __DIR__ . '/vendor/autoload.php';

use Rate\Rate;

$rate = new Rate();
print_r($rate->getExchangeRates('2018-04-17'));
```

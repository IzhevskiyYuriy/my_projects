<?php
//Скрипт для "прогрева" кеша регионов и городов - чтоб в рабочей системе не грузились долго страницы у пользователей
 

if (!defined('ROOT')) define('ROOT', dirname(__FILE__));

require_once ROOT . '/functions.php';

$regions = json_decode(getRegionsList(), true);

$counter = 0;

foreach ($regions as $region) {
    $regionId = $region['id'];
    
    $counter++;

    getCitiesList($regionId, CACHE_CITIES_DIR);

    echo "region: $regionId, counter: $counter\n";
    
    // some pause for not high load on provider API system
    if ($counter % 3 === 0) sleep(3);
}

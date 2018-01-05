<?php
if (!defined('ROOT')) define('ROOT', dirname(__FILE__));
require_once ROOT . '/functions.php';

$cities = [];

if (!empty($_GET['region_id'])) {
    $regionId = intval($_GET['region_id']);

    $regionData = getCitiesList($regionId, CACHE_CITIES_DIR);

    $decodeJsonDataCity = json_decode($regionData, true);

    if (is_array($decodeJsonDataCity) && !empty($decodeJsonDataCity['cities'])) {
        $cities = $decodeJsonDataCity['cities'];
    }
}

echo json_encode(['cities' => $cities]);





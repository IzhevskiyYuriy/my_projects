<?php

define('CACHE_CITIES_DIR', ROOT . '/cache/cities/');

function getCitiesList($regionId, $cacheDir) {
    $cache_file = $cacheDir . $regionId . '.txt';

    $regionData = cacheIt($cache_file, function () use ($regionId) {
        return file_get_contents('https://api3.leadgid.ru/api/universal/regions/' . $regionId . '?affiliate_id=25113&api_key=l5naDE1uwan5');
    });

    return $regionData;
}

function getRegionsList() {
    return cacheIt(ROOT . '/cache/regions.txt', function () {
        return file_get_contents('https://api3.leadgid.ru/api/universal/regions?affiliate_id=25113&api_key=l5naDE1uwan5');
    });
}


function cacheIt($fileName, $dataRetriever) {
    if (file_exists($fileName) && (filemtime($fileName) > (time() - 60 * 60*24*100 ))) {
        // Cache file is less than five minutes old.
        // Don't bother refreshing, just use the file as-is.
        $data = file_get_contents($fileName);
    } else {
        // Our cache is out-of-date, so load the data from our remote server,
        // and also save it over our cache for next time.
        $data = $dataRetriever();
        file_put_contents($fileName, $data, LOCK_EX);
    }

    return $data;
}

<?php
require_once ROOT . '/functions.php';

$regions = getRegionsList();

$decodeJsonDataRegions = json_decode($regions, true);
?>

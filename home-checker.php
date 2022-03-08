<?php
require_once 'common.php';

$homeItems = bahmanAPI('homeItems', [], 'GET', 'function');
$count = count($homeItems);
$carsList = [];

if ($count !== 0) {
    foreach ($homeItems as $car)
        $carsList[] = [
            'id' => $car->id,
            'title' => $car->title,
            'image' => $car->imageUrl,
        ];

    notify("$count items are available now. List: " . json_encode($carsList, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}

echo json_encode($carsList);

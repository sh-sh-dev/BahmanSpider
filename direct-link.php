<?php
require_once 'common.php';

global $car, $wantedColorWithPriority, $wantedOptionsWithPriority, $wantedTypeWithPriority;

$totalRetryCount = 5;
$remainingRetryCounts = $totalRetryCount;

$selectedColor = null;
$db = null;

while (!$db && $remainingRetryCounts >= 1) {
    $db = getCirculations($car);
    notify('tried for ' . ($totalRetryCount - $remainingRetryCounts) . 'th time. result: ' . json_encode($db));
    $remainingRetryCounts--;
}

if ($remainingRetryCounts === 0)
    die(json_encode([
        'ok' => false,
        'error' => 'No response from Iranecar',
        'checks' => $totalRetryCount
    ]));

$adorableColor = findAdorableColor($wantedColorWithPriority);

$links = getLinks($db, $adorableColor->colorCode);

echo json_encode([
    'selected-color' => [
        'argument' => $selectedColor,
        'array' => $adorableColor
    ],
    'links' => $links
], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

notify(json_encode($links, JSON_PRETTY_PRINT));

function getLinks($db, $colCode) {
    $pId = $db->productId; // or maybe productGroup / carId
    $cId = $db->id;
    $cRow = $db->crcl_row;
    $col = $db->circulationColors[0]->id;

    return [
        'select-trim' => "https://bahman.iranecar.com/product-group/$pId/circulations/ticket/no-ticket",
        'select-color' => "https://bahman.iranecar.com/product-group/$pId/circulation/$cId/options/ticket/no-ticket",
        'form' => "https://bahman.iranecar.com/registration?pId=$pId&cId=$cId&cRow=$cRow&col=$col&colCode=$colCode",
    ];
}

<?php
require_once 'common.php';

global $carId, $typeId, $optionCode, $colorPreference;

$totalRetryCount = 5;
$remainingRetryCounts = $totalRetryCount;

$selectedColor = null;
$circulationsList = null;

while (!$circulationsList && $remainingRetryCounts >= 1) {
    $circulationsList = getCirculations($carId);
    notify('tried for ' . ($totalRetryCount - $remainingRetryCounts) . 'th time. result: ' . json_encode($circulationsList));
    $remainingRetryCounts--;
}

if ($remainingRetryCounts === 0)
    die(json_encode([
        'ok' => false,
        'error' => 'No response from Iranecar',
        'checks' => $totalRetryCount
    ]));

$circulation = selectCirculationFromList($circulationsList, $typeId);
$color = findAdorableColor($circulation, $colorPreference);
$option = findAdorableOption($circulation, $optionCode);

$links = getLinks($circulation, $color, $option);

echo json_encode([
    'links' => $links,
    'selected-color' => $color,
], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

notify(json_encode($links, JSON_PRETTY_PRINT));

function getLinks($circulation, $color, $option) {
    $pId = $circulation->productId; // or maybe productGroup / carId
    $cId = $circulation->id;
    $cRow = $circulation->crcl_row;
    $col = $color->id;
    $colCode = $color->colorCode;

    $formLink = "https://bahman.iranecar.com/registration?pId=$pId&cId=$cId&cRow=$cRow&col=$col&colCode=$colCode";

    if ($option)
        $formLink .= '&op=' . $option->id;

    return [
        'select-type' => "https://bahman.iranecar.com/product-group/$pId/circulations/ticket/no-ticket",
        'select-color' => "https://bahman.iranecar.com/product-group/$pId/circulation/$cId/options/ticket/no-ticket",
        'form' => $formLink
    ];
}

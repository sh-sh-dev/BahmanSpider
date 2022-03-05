<?php
require_once 'common.php';

$queueId = '6d84123o-9sbc-8d5d-546b-awda22fe243a4';
$orderId = 184530;

// Main process

$nextPageUrl = '';

while ($nextPageUrl == "") {
    echo "[" . date('H:i:s') . "] still searching...\n";

    $checkResult = bahmanAPI('CheckResult', [
        'queueId' => $queueId,
        'orderId' => $orderId
    ], 'POST');

    $nextPageUrl = $checkResult->nextPageUrl;
}

echo "---------------- FOUND THE LINK ----------------";
echo PHP_EOL.PHP_EOL;
echo $nextPageUrl;
echo PHP_EOL.PHP_EOL;
echo "Debug data: \n";
@print_r($checkResult);

notify('Its your turn. BUYYYYYYYYY' . PHP_EOL . PHP_EOL . $nextPageUrl);
notify(@print_r($checkResult, true));

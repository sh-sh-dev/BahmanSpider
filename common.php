<?php
require_once 'config.php';

header('Content-type: application/json');
set_time_limit(0);

// Functions

function bot(string $method, array $data = null) {
    global $botToken;

    $url = 'https://api.telegram.org/bot' . $botToken . '/' . $method;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if (!empty($data))
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    return !(bool)$error;
}

function notify(string $message) {
    global $channel;

    bot('sendMessage', [
        'chat_id' => $channel,
        'text' => $message
    ]);
}

function bahmanAPI(string $endpoint, array $data = [], string $method = 'GET', string $domain = 'customer-api') {
    $ch = curl_init();
    $url = "https://bahman-$domain.iranecar.com/api/$endpoint";

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    else
        $url .= '?' . http_build_query($data);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Origin: https://bahman.iranecar.com',
        'Referrer: https://bahman.iranecar.com/',
        'Dnt: 1',
        'Sec-Ch-Ua: \"Google Chrome\";v=\"98\", \" Not;A Brand\";v=\"99\", \"Chromium\";v=\"98\"',
        'Sec-Ch-Ua-Mobile: ?0',
        'Sec-Ch-Ua-Platform: \"Windows\"',
        'Sec-Fetch-Site: same-site',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Dest: empty',
        'Accept-Language: en-US,en;q=0.9,fa;q=0.8',
        'Accept: application/json, text/plain, */*',
    ]);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0 Safari/537.36');

    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}

function removeArabic(array $colors) {
    for ($i = 0; $i < count($colors); $i++) {
        $colors[$i] = str_replace(
            ['ي', 'ك',],
            ['ی', 'ک'],
            $colors[$i]
        );
    }

    return $colors;
}

function getCirculations(int $carId) {
    return @bahmanAPI(
        'GetCirculationData',
        [ 'CarModelId' => $carId ],
        'POST'
    );
}

function selectCirculationFromList($circulationsList, $wantedType) {
    if (count($circulationsList) === 1 || !$wantedType)
        return $circulationsList[0];

    $carIds = array_column($circulationsList, 'carId');

    return $circulationsList[(array_search($wantedType, $carIds) ?: 0)];
}

function findAdorableColor($circulation, array $colorPreference) {
    $availableColors = removeArabic(array_column($circulation->circulationColors, 'plainColor'));

    foreach ($colorPreference as $color) {
        if ($color === '*') {
            $circulation->circulationColors[0]->programInput = '*';
            return $circulation->circulationColors[0];
        }

        $colorIndex = array_search($color, $availableColors);

        if ($colorIndex !== false) {
            $circulation->circulationColors[$colorIndex]->programInput = $color;
            return $circulation->circulationColors[$colorIndex];
        }
    }

    return null;
}

function findAdorableOption($circulation, $optionCode) {
    if (count($circulation->options) === 0 || !$optionCode)
        return null;

    $optionsList = array_column($circulation->options, 'optionCode');

    return $circulation->options[(array_search($optionCode, $optionsList) ?: 0)];
}

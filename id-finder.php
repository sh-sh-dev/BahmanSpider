<?php
require_once 'common.php';
global $channel, $photosDirectory;

$url = 'https://bahman.s3.ir-thr-at1.arvanstorage.com/CDN/static-files/cars/Images/carModel';

// Main Process

$idToFetchFrom = getLatestId() + 1;

processLinks($idToFetchFrom, $idToFetchFrom + 35);

// Functions

function getLatestId() {
    global $photosDirectory;

    $list = [];
    $files = glob("$photosDirectory/*.png");

    foreach ($files as $file)
        $list[] = explode('/', explode('.', $file)[0])[1];

    if (count($list) === 0)
        return 0;

    sort($list);
    return end($list);
}

function processLinks($start, $end) {
    global $url, $channel, $photosDirectory;

    $latestOkId = null;

    for ($i = $start; $i < $end; $i++) {
        $photoLink = "$url/$i.png";

        $photo = @file_get_contents($photoLink);

        if ($photo) {
            $latestOkId = $i;

            file_put_contents("$photosDirectory/$i.png", $photo);

            bot('sendPhoto', [
                'chat_id' => $channel,
                'photo' => $photoLink,
                'caption' => "ID $i"
            ]);

            echo "got $i\n";
        }
    }

    if (($end - $latestOkId) < 10) {
        echo "still have to check... \n";
        processLinks($end, $end + 35);
    }

    return true;
}

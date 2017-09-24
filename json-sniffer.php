#!/usr/bin/php
<?php

echo "execute json format validation.\n\n";

$dir = './events';
$list = scandir($dir);

foreach ($list as $file) {
  if (preg_match('/.*\.json\z/', $file)) {
    $row = file_get_contents($dir . '/' . $file);
    $json = json_decode($row);
    if (!$json) {
      echo "\n[[error]] $file is invalid json format.\n";
      exit;
    }
    echo '  ' . $file . "\n";
  }
}
echo "\n[[success]] all files are valid json format.\n";

$currentEvent = $list[count($list) - 2];
$raw = file_get_contents($dir . '/' . $currentEvent);
$json = json_decode($raw, true);

$artists = [];
$songs = [];
foreach ($json['setlist'] as $setlist) {
  foreach ($setlist as $set) {
    if (!empty($set[0])) {
      $splited = explode('/', $set[0]);
      foreach ($splited as $artist) {
        $artists[] = trim($artist);
      }
      if (!empty($set[1])) {
        $songs = array_merge($songs, $set[1]);
      }
    }
  }
}

sort($artists);
sort($songs);
$uniqueArtists = count(array_unique($artists));
$uniqueSongs = count(array_unique($songs));
echo "\ncurrent event $currentEvent\n";
echo "artists: $uniqueArtists\n";
echo "songs:   $uniqueSongs\n";

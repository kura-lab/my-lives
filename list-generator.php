#!/usr/bin/php
<?php

echo "generate event list.\n\n";

require_once('vendor/autoload.php');

use kuralab\jsonviewer\JsonViewer;

$dir = './events';
$list = scandir($dir);
$filename = 'list.json';

$files = [];
$artists = [];
$songs = [];
foreach ($list as $file) {
  if (preg_match('/.*\.json\z/', $file) && $file !== $filename) {
    $files[] = $file;
    $row = file_get_contents($dir . '/' . $file);
    $json = json_decode($row, true);
    if (!empty($json['setlist'])) {
      foreach ($json['setlist'] as $sets) {
        foreach ($sets as $set) {
          if (!empty($set[0])) {
            $splited = explode(',', $set[0]);
            foreach ($splited as $artist) {
              $artists[] = trim($artist);
            }
          }
          if (!empty($set[1])) {
            $songs = array_merge($songs, $set[1]);
          }
        }
      }
    }
  }
}

$rowJson = json_encode($files);

$delimiter = "\n";
$indent = 2;

$viewer = new JsonViewer($rowJson, $delimiter, $indent);
$visualized = $viewer->visualize();
echo $visualized;

file_put_contents($dir . '/' . $filename, $visualized);

echo "\n\nwrote event list to $dir/$filename\n\n";

$countArtists = count($artists);
$countSongs = count($songs);
sort($artists);
sort($songs);
$uniqueArtists = count(array_unique($artists));
$uniqueSongs = count(array_unique($songs));
echo "artists: $countArtists (unique $uniqueArtists)\n";
echo "songs:   $countSongs (unique $uniqueSongs)\n";

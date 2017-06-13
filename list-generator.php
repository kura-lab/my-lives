#!/usr/bin/php
<?php

echo "generate event list.\n\n";

require_once('vendor/autoload.php');

use kuralab\jsonviewer\JsonViewer;

$dir = './events';
$list = scandir($dir);
$filename = 'list.json';

$files = [];
foreach ($list as $file) {
  if (preg_match('/.*\.json\z/', $file) && $file !== $filename) {
    $files[] = $file;
  }
}

$rowJson = json_encode($files);

$delimiter = "\n";
$indent = 2;

$viewer = new JsonViewer($rowJson, $delimiter, $indent);
$visualized = $viewer->visualize();
echo $visualized;

file_put_contents($dir . '/' . $filename, $visualized);

echo "\n\nwrote event list to $dir/$filename\n";

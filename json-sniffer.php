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

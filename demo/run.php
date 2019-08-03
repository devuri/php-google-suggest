<?php

require_once __DIR__ . '/../vendor/autoload.php';

use euclid1990\PhpGoogleSuggest\GoogleSuggest;

$configArr = require __DIR__.'/config/google_suggest.php';
$config = ['google_suggest' => $configArr];
$googleSuggest = new GoogleSuggest(new Illuminate\Config\Repository($config));

$english = 'Google';
$result = $googleSuggest->search($english, $configArr['language']);
echo "Search results for English keyword: [$english].\n";
print_r($result);

$japanese = 'あいうえお';
$result = $googleSuggest->search($japanese, $configArr['language']);
echo "Search results for Japanese keyword: [$japanese].\n";
print_r($result);

$vietnamese = 'tìm';
$result = $googleSuggest->search($vietnamese, $configArr['language']);
echo "Search results for Vietnamese keyword: [$vietnamese].\n";
print_r($result);

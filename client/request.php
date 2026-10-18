<?php
$url = $argv[1] ?? 'http://127.0.0.1:8081/';
$mh = curl_multi_init();
$handles = [];
for ($i = 0; $i < 3; $i++) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_multi_add_handle($mh, $ch);
    $handles[] = $ch;
}
$t = microtime(true);
do { curl_multi_exec($mh, $running); curl_multi_select($mh); } while ($running);
printf("3 requests total: %.2f sec\n", microtime(true) - $t);
foreach ($handles as $ch) echo curl_multi_getcontent($ch);


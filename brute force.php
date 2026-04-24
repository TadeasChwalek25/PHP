<?php

$target = "5c4c3d6b1e6c7c0c5a5f9e3c6f4e3c0d";
$chars = 'abcdefghijklmnopqrstuvwxyz';
$maxLen = 5;
$maxAttempts = 10000000;

$start = microtime(true);
$attempts = 0;
$found = false;

for ($len = 1; $len <= $maxLen; $len++) {
    $indexes = array_fill(0, $len, 0);

    while (true) {
        
        $str = '';
        foreach ($indexes as $i) {
            $str .= $chars[$i];
        }

        $attempts++;

        if (md5($str) === $target) {
            echo "Heslo je: $str\n";
            $found = true;
            break 2;
        }

        if ($attempts >= $maxAttempts) break 2;

        for ($pos = $len - 1; $pos >= 0; $pos--) {
            if ($indexes[$pos] < strlen($chars) - 1) {
                $indexes[$pos]++;
                break;
            } else {
                $indexes[$pos] = 0;
                if ($pos === 0) break 2;
            }
        }
    }
}

$time = microtime(true) - $start;

if (!$found) {
    echo "Útok nebyl úspěšný.\n";
}

echo "Počet pokusů: $attempts\n";
echo "Délka trvání: " . round($time, 4) . " s\n";

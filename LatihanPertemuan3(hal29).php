<?php

$a = true;
$b = false;

// variable sc akan bernilai false
$c = $a && $b;
printf("%b && %b = %b", $a, $b, $c);
echo "<hr>";

// variable sc akan bernilai true
$c = $a || $b;
printf("%b || %b = %b", $a, $b, $c);
echo "<hr>";

// variable sc akan bernilai false
$c = !$a;
printf("!%b = %b", $a, $c);
echo "<hr>";
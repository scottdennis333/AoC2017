<?php
$input = file_get_contents("day5input.txt");

$jumps = explode(PHP_EOL, $input);

$pos = 0;
$steps = 0;
while($pos >= 0 && $pos<count($jumps)){
    $temp = $jumps[$pos];
    if($temp >= 3){
        $jumps[$pos]--;
    }else{
        $jumps[$pos]++;
    }
    $pos += $temp;
    $steps++;
}

echo "$steps<br>";


?>
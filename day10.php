<?php
$input = '187,254,0,81,169,219,1,190,19,102,255,56,46,32,2,216';
$list = range(0,255);
$pos = 0;
$skip = 0;


for($i=0; $i<strlen($input); $i++){
    $lengths[] = ord($input[$i]);
}
array_push($lengths,"17", "31", "73", "47", "23");

for($r = 0; $r<64; $r++){
    foreach($lengths as $x){
        $reverse = array();
        for($i=0; $i<$x; $i++){
            $reverse[] = $list[($pos+$i)%256];
        }
        $reverse = array_reverse($reverse);
        for($i=0; $i<$x; $i++){
            $list[($pos+$i)%256] = $reverse[$i];
        }
        $pos += $x + $skip;
        $skip++;
    }
}

$sparse = array_chunk($list, 16);

foreach($sparse as $x){
    $xor = 0;
    foreach($x as $y){
        $xor ^= $y;
    }
    $dense[] = $xor;
}

$knot = "";
foreach($dense as $x){
    $knot .= dechex($x);
}
echo $knot;
?>
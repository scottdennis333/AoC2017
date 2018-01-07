<?php
$buffer = array(0);
$current = 0;

for($i=1; $i<2018; $i++){
    $current = ($current+304) % $i + 1;
    array_splice($buffer, $current, 0, $i);
}
echo $buffer[array_search('2017', $buffer)+1] . "<br>";

$current = 0;

for($i=1; $i<50000001; $i++){
    $current = ($current+304) % $i + 1;
    if($current == 1){
        $pos1 = $i;
    }
}
echo $pos1;
?>
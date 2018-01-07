<?php
$input = file_get_contents("day4input.txt");

$lines = explode(PHP_EOL, $input);
$sum=0;
$sum2=0;
foreach($lines as $x){
    $phrase = explode(" ", $x);
    
    if(count($phrase) == count(array_unique($phrase))){
        $sum++;
    }
}

foreach($lines as $x){
    $phrase = explode(" ", $x);
    for($i=0; $i<count($phrase); $i++){
        $string = str_split($phrase[$i]);
        sort($string);
        $phrase[$i] = implode("",$string);
    }
    if(count($phrase) == count(array_unique($phrase))){
        $sum2++;
    }
}
echo "$sum<br>";
echo $sum2;
?>
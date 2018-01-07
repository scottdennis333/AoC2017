<?php
$input = file_get_contents("day2input.txt");

$lines = explode(PHP_EOL, $input);
$sum=0;
$sum2=0;

foreach($lines as $x){
    $spreadsheet[] =  preg_split('/\s+/', $x);
}
foreach($spreadsheet as $x){
    $sum += max($x) - min($x);
}

foreach($spreadsheet as $x){
    for($i=0; $i<count($x); $i++){
        for($j=0; $j<count($x); $j++){
            if($i != $j){
                if($x[$i] % $x[$j] == 0){
                    $sum2 += $x[$i]/$x[$j];
                }
            }
        }
    }
}
echo "$sum<br>";
echo "$sum2";
?>
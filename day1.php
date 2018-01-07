<?php
$input = file_get_contents("day1input.txt");

$sum = 0;
$sum2 = 0;
for($i=0; $i<strlen($input); $i++){
    if($input[$i] == $input[($i+1) % strlen($input)]){
        $sum += $input[$i];
    }
    if($input[$i] == $input[($i+(strlen($input)/2)) % strlen($input)]){
        $sum2 += $input[$i];
    }
}
echo "$sum<br>";
echo $sum2;
?>
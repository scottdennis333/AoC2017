<?php
$input = file_get_contents("day6input.txt");

$memory = explode("\t", $input);
$seen[] = implode(",",$memory);
$redist = 0;
while(count($seen) == count(array_unique($seen))){
    $max = max($memory);
    $key = array_search($max, $memory);
    $memory[$key] = 0;
    $pos = $key+1;
    for($i=$max; $i>0; $i--){
        $memory[$pos % (count($memory))]++;
        $pos++;
    }
    $redist++;
    $seen[] = implode(",",$memory);
}
echo "$redist<br>";
echo  (count($seen)-1) - array_search(end($seen),$seen);
    
?>
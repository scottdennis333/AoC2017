<?php
$input = file_get_contents("day13input.txt");
$lines = explode(PHP_EOL, $input);
$firewall = [];
$up = false;
$severity = 0;

foreach($lines as $x){
    if(preg_match('/(\d+): (\d+)/', $x, $match)){
        list($fill, $depth, $range) = $match;
        $firewall[$depth] = $range;
    }
}

for($i=0; $i<=max(array_keys($firewall)); $i++){
    if(in_array($i, array_keys($firewall))){
        if($i % (2*$firewall[$i]-2) == 0){
            $severity += ($i * $firewall[$i]);
        }       
    }
}
$caught = true;
$delay = 0;
while($caught){
    $caught = false;
    for($i=0; $i<=max(array_keys($firewall)); $i++){
        if(in_array($i, array_keys($firewall))){
            if(($i + $delay) % (2*$firewall[$i]-2) == 0){
                $caught = true;
                $delay++;
                break;
            }
        }
    }
}


echo "$severity<br>";
echo $delay;
?>
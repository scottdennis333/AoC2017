<?php
$input = file_get_contents("day24input.txt");

$lines = explode(PHP_EOL, $input);

foreach($lines as $x){
    if(preg_match('|(\d+)/(\d+)|', $x, $match)){
        [$fill, $port1, $port2] = $match;
        $components[] = [$port1, $port2];
    }
}

$sum = 0;
for($i=0; $i<count($components); $i++){
    if($components[$i][0] == 0){
        $strongest = $components[$i][1];
        $openPort = $components[$i][1];
        array_splice($components,$i,1,[]);
        findStrongest($components, $openPort, $strongest, $sum);
    }else if($components[$i][1] == 0){
        $strongest = $components[$i][0];
        $openPort = $components[$i][0];
        array_splice($components,$i,1,[]);
        findStrongest($components, $openPort, $strongest, $sum);
    }
}

echo $sum;

function findStrongest($components, $openPort, $strongest, &$sum){
    $found = false;
    for($i = 0; $i<count($components); $i++){
        $temp = $components[$i];
        if($components[$i][0] == $openPort){
            $strongest += $components[$i][0] + $components[$i][1];
            $openPort = $components[$i][1];
            array_splice($components,$i,1);
            findStrongest($components, $openPort, $strongest, $sum);
            array_splice($components,$i,0,array($temp));
            $found = true;
        }else if($components[$i][1] == $openPort){
            $strongest += + $components[$i][0] + $components[$i][1];
            $openPort = $components[$i][0];
            array_splice($components,$i,1);
            findStrongest($components, $openPort, $strongest, $sum);
            array_splice($components,$i,0,array($temp));
            $found = true;
        }
    }
    if(!$found){
        if($strongest > $sum){
            $sum = $strongest;
        }
    }
}

?>
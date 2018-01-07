<?php
$genA = 289;
$genB = 629;
$judge = 0;

for($i=0; $i<5000000; $i++){
    
    while(1){
        $genA = ($genA * 16807) % 2147483647;
        if($genA % 4 == 0){
            break;
        }
    } 
    while(1){
        $genB = ($genB * 48271) % 2147483647;
        if($genB % 8 == 0){
            break;
        }
    }
    
    $binA = substr(decbin($genA), -16);
    $binB = substr(decbin($genB), -16);
    
    if($binA == $binB){
        $judge++;
    }
    
}
echo $judge;
?>
<?php

ini_set('memory_limit', -1);
$steps = 12994925;

$state = 'A';

$tape = array_fill(0, ($steps*2), 0);
$pos = count($tape)/2;

for($i=0; $i<$steps; $i++){
    switch($state){
        case 'A':
            if($tape[$pos] == 0){
                $tape[$pos] = 1;
                $pos++;
                $state = 'B';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 0;
                $pos--;
                $state = 'F';          
                break;
            }
        case 'B':
            if($tape[$pos] == 0){
                $tape[$pos] = 0;
                $pos++;
                $state = 'C';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 0;
                $pos++;
                $state = 'D';
                break;
            }
        case 'C':
            if($tape[$pos] == 0){
                $tape[$pos] = 1;
                $pos--;
                $state = 'D';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 1;
                $pos++;
                $state = 'E';
                break;
            }
        case 'D':
            if($tape[$pos] == 0){
                $tape[$pos] = 0;
                $pos--;
                $state = 'E';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 0;
                $pos--;
                $state = 'D';
                break;
            }
        case 'E':
            if($tape[$pos] == 0){
                $tape[$pos] = 0;
                $pos++;
                $state = 'A';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 1;
                $pos++;
                $state = 'C';
                break;
            }
        case 'F':
            if($tape[$pos] == 0){
                $tape[$pos] = 1;
                $pos--;
                $state = 'A';
                break;
            }elseif($tape[$pos] == 1){
                $tape[$pos] = 1;
                $pos++;
                $state = 'A';
                break;
            }
    }
}
$checksum = 0;
for($i=0; $i<count($tape); $i++){
    if($tape[$i] == 1){
        $checksum++;
    }
}
echo $checksum;
?>
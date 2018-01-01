<?php
$input = file_get_contents("day18input.txt");

$instr = explode(PHP_EOL, $input);
$registers = array();
$sound = 0;
foreach($instr as $x){
    if(!array_key_exists($x[4], $registers) && !is_numeric($x[4])){
        $registers[$x[4]] = 0;
    }
}

for($i = 0; $i<count($instr); $i++){
    $line = $instr[$i];
    $info = explode(" ", $line);
    if(count($info) == 3){
        list($cond, $var1, $var2) = $info;
    }else{
        list($cond, $var1) = $info;
    }
    $number = is_numeric($var2);
    switch($cond){
        case 'snd':
            $sound = $registers[$var1];
            break;
        case 'set':
            if($number){
                $registers[$var1] = $var2;
            }else{
                $registers[$var1] = $registers[$var2];
            }
            break;
        case 'add':
            if($number){
                $registers[$var1] += $var2;
            }else{
                $registers[$var1] += $registers[$var2];
            }
            break;
        case 'mul':
            if($number){
                $registers[$var1] *= $var2;
            }else{
                $registers[$var1] *= $registers[$var2];
            }
            break;
        case 'mod':
            if($number){
                $registers[$var1] %= $var2;
            }else{
                $registers[$var1] %= $registers[$var2];
            }
            break;
        case 'rcv':
            if($registers[$var1] != 0){
                break 2;
            }
            break;
        case 'jgz':
            if($var1 > 0 || ( (array_key_exists($var1, $registers) ) && ($registers[$var1] > 0) ) ){
                if($number){
                    $i += $var2-1;
                }else{
                    $i += $registers[$var2]-1;
                }
            }
            break;
    }
}
echo $sound;

?>
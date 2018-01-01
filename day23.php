<?php
$input = file_get_contents("day23input.txt");

$instr =  explode(PHP_EOL, $input);

$registers = ['a'=>0,'b'=>0,'c'=>0,'d'=>0,'e'=>0,'f'=>0,'g'=>0,'h'=>0,];


$total = 0;

for($i = 0; $i<count($instr); $i++){
    $line = $instr[$i];
    $info = explode(" ", $line);
    if(count($info) == 3){
        list($cond, $var1, $var2) = $info;
    }else{
        list($cond, $var1) = $info;
    }
    $number = is_numeric($var2);
    switch ($cond){
        case 'set':
            if($number){
                $registers[$var1] = $var2;
            }else{
                $registers[$var1] = $registers[$var2];
            }
            break;
        case 'sub':
            if($number){
                $registers[$var1] -= $var2;
            }else{
                $registers[$var1] -= $registers[$var2];
            }
            break;
        case 'mul':
            if($number){
                $registers[$var1] *= $var2;
            }else{
                $registers[$var1] *= $registers[$var2];
            }
            $total++;
            break;
        case 'jnz':
            if($var1 != 0 || ( (array_key_exists($var1, $registers) ) && ($registers[$var1] != 0) ) ){
                if($number){
                    $i += $var2-1;
                }else{
                    $i += $registers[$var2]-1;
                }
            }
            break;
    }
}
echo $total;
?>
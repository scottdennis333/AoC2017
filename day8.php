<?php
$input = file_get_contents("day8input.txt");

$lines = explode(PHP_EOL, $input);

foreach($lines as $line){
    $instr = explode(" ", $line);
    $registers[$instr[0]] = 0;
}

foreach($lines as $line){
    list($reg, $dir, $val, $if, $reg2, $cond, $val2) = explode(' ', $line);
    
    switch($cond){
        case '>':
            $valid = ($registers[$reg2] > $val2);
            break;
        case '>=':
            $valid = $registers[$reg2] >= $val2;
            break;
        case '<':
            $valid = $registers[$reg2] < $val2;
            break;
        case '<=':
            $valid = $registers[$reg2] <= $val2;
            break;
        case '==':
            $valid = $registers[$reg2] == $val2;
            break;
        case '!=':
            $valid = $registers[$reg2] != $val2;
            break;
    }
    if($valid){
        switch($dir){
            case 'inc':
                $registers[$reg] += $val;
                break;
            case 'dec':
                $registers[$reg] -= $val;
                break;
        }
    }
    $highest[] = max($registers);
}

echo max($registers) . "<br>";
echo max($highest);


?>
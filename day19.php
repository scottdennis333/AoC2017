<?php
$input = file_get_contents("day19input.txt");

$lines = explode(PHP_EOL, $input);

$row = 0;
$col = 0;
$direction = 'down';

$maxR = count($lines) - 1;
$maxC = strlen($lines[0]) - 1;

for($i = 0; $i<$maxC; $i++){
    if($lines[0][$i] == '|'){
        $col = $i;
    }
}

$path = '';
$end = false;
$steps = 0;

while(!$end){
    $symbol = $lines[$row][$col];
    switch($symbol){
        case '|':
        case '-':
            $steps++;
            switch($direction){
                case 'down':
                    $row++;
                    break;
                case 'up':
                    $row--;
                    break;
                case 'left':
                    $col--;
                    break;
                case 'right':
                    $col++;
                    break;
            }
            break;
        case '+':
            $steps++;
            switch($direction){
                case 'down':
                case 'up':
                    if($col < $maxC && $lines[$row][$col+1] != ' '){
                        $col++;
                        $direction = 'right';
                    }else{
                        $col--;
                        $direction = 'left';
                    }
                    break;
                case 'left':
                case 'right':
                    if($row > $maxR && $lines[$row+1][$col] != ' '){
                        $row++;
                        $direction = 'down';
                    }else{
                        $row--;
                        $direction = 'up';
                    }
                    break;
            }
            break;
        case ' ':
            $end = true;
            break;
        default:
            $steps++;
            $path .= $symbol;
            switch($direction){
                case 'down':
                    $row++;
                    break;
                case 'up':
                    $row--;
                    break;
                case 'left':
                    $col--;
                    break;
                case 'right':
                    $col++;
                    break;
            }
    }
}

echo "$path <br>  $steps";

?>
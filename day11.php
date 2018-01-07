<?php
$input = file_get_contents("day11input.txt");

$grid = explode(",", $input);

$x = 0;
$y = 0;
$z = 0;

foreach($grid as $x){
    switch($x){
        case 'n':
            $y++;
            $z--;
            break;
        case 's':
            $y--;
            $z++;
            break;
        case 'ne':
            $x++;
            $z--;
            break;
        case 'nw':
            $x--;
            $y++;
            break;
        case 'se':
            $x++;
            $y--;
            break;
        case 'sw':
            $x--;
            $z++;
            break;         
    }
    $farthest[] = max(abs($x), abs($y), abs($z));
}

echo max(abs($x), abs($y), abs($z)) . "<br>";
echo max($farthest);

?>
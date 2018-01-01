<?php
$input = file_get_contents("day22input.txt");
$lines = explode(PHP_EOL, $input);

for ($i = 0; $i < 1500; $i ++)
{
    for ($j = 0; $j < 1500; $j ++)
    {
        $map[$i][$j] = ".";
    }
}
for ($i = 0; $i < count($lines); $i ++)
{
    if (strlen($lines[$i]) > 1)
    {
        for ($j = 0; $j < strlen($lines[$i]); $j ++)
            $map[750 + $i][750 + $j] = $lines[$i][$j];
    }
}

$direction = array(
    "#" => array(
        "up" => "right",
        "right" => "down",
        "down" => "left",
        "left" => "up"
    ),
    "." => array(
        "up" => "left",
        "left" => "down",
        "down" => "right",
        "right" => "up"
    )
);

$infected = 0;
$row = 762;
$col = 762;
$dir = "up";

for ($i = 0; $i < 10000000; $i ++)
{
    if ($map[$row][$col] == '.')
    {
        $dir = $direction['.'][$dir];
        $map[$row][$col] = 'W';
        move($row, $col, $dir);
    } elseif ($map[$row][$col] == "#")
    {
        $dir = $direction['#'][$dir];
        $map[$row][$col] = 'F';
        move($row, $col, $dir);
    } elseif($map[$row][$col] == "W")
    {
        $map[$row][$col] = '#';
        move($row, $col, $dir);
        $infected ++;
    } elseif($map[$row][$col] == "F")
    {
        //uturn
        $dir = $direction['#'][$dir];
        $dir = $direction['#'][$dir];
        $map[$row][$col] = '.';
        move($row, $col, $dir);
    }
}
echo $infected;

function move(&$row, &$col, $dir)
{
    if ($dir == "up")
    {
        $row --;
    }
    if ($dir == "down")
    {
        $row ++;
    }
    if ($dir == "left")
    {
        $col --;
    }
    if ($dir == "right")
    {
        $col ++;
    }
}
?>
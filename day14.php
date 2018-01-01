<?php
ini_set('memory_limit', - 1);
$input = "oundnydw";
$grid = [
    []
];
$used = 0;
$j = 0;

for ($i = 0; $i < 128; $i ++)
{
    $j = 0;
    $hash = $input . '-' . $i;
    $hex = str_split(knot($hash));
    foreach ($hex as $x)
    {
        $binary = str_split(base_convert($x, 16, 2));
        foreach ($binary as $y)
        {
            $grid[$i][$j] = $y;
            $j ++;
            if ($y == 1)
            {
                $used ++;
            }
        }
    }
}
echo $used;
$count = 0;
$visited = array();


for ($i = 0; $i < count($grid); $i ++)
{
    for ($j = 0; $j < count($grid[$i]); $j ++)
    {
        if ($grid[$i][$j] == 1 && !array_search(($i . ',' . $j), $visited))
        {
            $count ++;
            findAllConnected($grid, $visited, $i, $j);
        }
    }
}

echo "<br>" . $count;

function findAllConnected(&$grid, &$visited, $i, $j)
{
    if ($i < 0 || $i > 127 || $j < 0 || $j > count($grid[$i]) || $grid[$i][$j] != 1)
    {
        return;
    }
    $visited[] = $i . ',' . $j;
    findAllConnected($grid, $visited, $i + 1, $j);
    findAllConnected($grid, $visited, $i - 1, $j);
    findAllConnected($grid, $visited, $i, $j + 1);
    findAllConnected($grid, $visited, $i, $j - 1);
}

function knot($input)
{
    $list = range(0, 255);
    $pos = 0;
    $skip = 0;
    
    for ($i = 0; $i < strlen($input); $i ++)
    {
        $lengths[] = ord($input[$i]);
    }
    array_push($lengths, "17", "31", "73", "47", "23");
    
    for ($r = 0; $r < 64; $r ++)
    {
        foreach ($lengths as $x)
        {
            $reverse = array();
            for ($i = 0; $i < $x; $i ++)
            {
                $reverse[] = $list[($pos + $i) % 256];
            }
            $reverse = array_reverse($reverse);
            for ($i = 0; $i < $x; $i ++)
            {
                $list[($pos + $i) % 256] = $reverse[$i];
            }
            $pos += $x + $skip;
            $skip ++;
        }
    }
    
    $sparse = array_chunk($list, 16);
    
    foreach ($sparse as $x)
    {
        $xor = 0;
        foreach ($x as $y)
        {
            $xor ^= $y;
        }
        $dense[] = $xor;
    }
    
    $knot = "";
    foreach ($dense as $x)
    {
        $knot .= dechex($x);
    }
    return $knot;
}
?>
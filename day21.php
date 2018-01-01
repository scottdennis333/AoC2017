<?php
$input = file_get_contents("day21input.txt");

$lines = explode(PHP_EOL, $input);
$rules = array();

$pattern = '.#./..#/###';

$image = explode("/", $pattern);

foreach ($lines as $line)
{
    if (preg_match('|(.*) => (.*)|', $line, $matches))
    {
        list ($fill, $input, $output) = $matches;
        $rules[$input] = $output;
    }
}

for ($runs = 0; $runs < 5; $runs ++)
{
    $section = [];
    $newSection = [];
    if (count($image) % 2 == 0)
    {
        for ($i = 0; $i < count($image); $i += 2)
        {
            for ($j = 0; $j < strlen($image[$i]); $j += 2)
            {
                $section[] = array($image[$i][$j] . $image[$i][$j + 1], $image[$i + 1][$j] .
                     $image[$i + 1][$j + 1]);
            }
        }
    } else
    {
        for ($i = 0; $i < count($image); $i += 3)
        {
            for ($j = 0; $j < strlen($image[$i]); $j += 3)
            {
                $section[] = array($image[$i][$j] . $image[$i][$j + 1] . $image[$i][$j + 2],
                     $image[$i + 1][$j] . $image[$i + 1][$j + 1] . $image[$i + 1][$j + 2],
                     $image[$i + 2][$j] . $image[$i + 2][$j + 1] . $image[$i + 2][$j + 2]);
            }
        }
    }
    for ($i = 0; $i < count($section); $i ++)
    {
        $variation = [];
        $variation[] = $section[$i];
        $variation[] = flip($section[$i]);
        
        $temp = rotate($section[$i]);
        $variation[] = $temp;
        $variation[] = flip($temp);
        
        $temp = rotate($temp);
        $variation[] = $temp;
        $variation[] = flip($temp);
        
        $temp = rotate($temp);
        $variation[] = $temp;
        $variation[] = flip($temp);
        
        foreach ($rules as $key => $value)
        {
            for ($j = 0; $j < count($variation); $j ++)
            {

                if ($variation[$j] == (explode("/", $key)))
                {

                    $newSection[] = explode("/", $value);

                    break 2;
                }
            }
        }
    }
    $newImage = array_fill(0, count($newSection[0]), null);
    for ($i = 0; $i < count($newSection); $i ++)
    {
        for ($j = 0; $j < count($newSection[$i]); $j ++)
        {
            $newImage[$j] .= $newSection[$i][$j];
        }
    }

    $image = $newImage;
}

$total = 0;
for($i = 0; $i<count($image); $i++){
    for($j = 0; $j<strlen($image[$i]); $j++){
        if($image[$i][$j] == '#'){
            $total++;
        }
    }
}
echo $total;
function flip($image)
{
    for ($i = 0; $i < count($image); $i ++)
    {
        $newImage[$i] = strrev($image[$i]);
    }
    return $newImage;
}

function rotate($image)
{
    // create 2d array
    $newImage = [
        []
    ];
    for ($i = 0; $i < count($image); $i ++)
    {
        for ($j = 0; $j < strlen($image[$i]); $j ++)
        {
            $newImage[$i][$j] = $image[$i][$j];
        }
    }

    // rotate
    array_unshift($newImage, null);
    $newImage = call_user_func_array('array_map', $newImage);
    $newImage = array_map('array_reverse', $newImage);
    
    // back to 1d array
    for ($i = 0; $i < count($newImage); $i ++)
    {
        $image[$i] = implode($newImage[$i]);
    }
    return $image;
}

?>
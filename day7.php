<?php
$input = file_get_contents("day7input.txt");

$lines = explode(PHP_EOL, $input);

$programs = [];
foreach ($lines as $x)
{
    if (preg_match('/^(.*?) \((\d+)\)$/', $x, $line))
    {
        list ($fill, $name, $weight) = $line;
        $programs[$name] = [
            'name' => $name,
            'weight' => $weight,
            'total' => $weight,
            'children' => array()
        ];
    } elseif (preg_match('/^(.*?) \((\d+)\) -> (.*)$/', $x, $line))
    {
        list ($fill, $name, $weight, $children) = $line;
        $programs[$name] = [
            'name' => $name,
            'weight' => $weight,
            'total' => $weight,
            'children' => array_map('trim', explode(',', $children))
        ];
    }
}

foreach ($programs as $key => $value)
{
    $found = true;
    foreach ($programs as $x)
    {
        if (in_array($key, $x['children']))
        {
            $found = false;
        }
    }
    if ($found)
    {
        $root = $programs[$key];
    }
}
echo $root['name'] . "<br>";

findWeight($root);

while (1)
{
    if ($root['children'] == null)
    {
        $change = $root['weight'] + ($correct - $root['total']);
        break;
    }
    
    $weights = array_map("getWeights", $root['children']);
    
    $min = min($weights);
    $max = max($weights);
    
    if ($min == $max)
    {
        $change = $root['weight'] + ($correct - $root['total']);
        break;
    }
    
    $countMin = 0;
    $countMax = 0;
    
    foreach ($root['children'] as $x)
    {
        if ($programs[$x]['total'] == $min)
        {
            $countMin ++;
        } else
        {
            $countMax ++;
        }
    }
    
    if ($countMin > $countMax)
    {
        $wrong = $max;
        $correct = $min;
    } else
    {
        $wrong = $min;
        $correct = $max;
    }
    
    foreach ($root['children'] as $x)
    {
        if ($programs[$x]['total'] == $wrong)
        {
            $root = $programs[$x];
        }
    }
}
echo $change;

function getWeights($child)
{
    global $programs;
    return $programs[$child]['total'];
}

function findWeight($node)
{
    global $programs;
    foreach ($node['children'] as $x)
    {
        findWeight($programs[$x]);
        $node['total'] += $programs[$x]['total'];
    }
    $programs[$node['name']] = $node;
}
?>
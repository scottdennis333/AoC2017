    <?php
    $input = file_get_contents("day20input.txt");
    
    $lines = explode(PHP_EOL, $input);
    $count = 0;
    
    $closest = PHP_INT_MAX;
    
    foreach ($lines as $x)
    {
        if (preg_match(
            '/p=<(-?\d+),(-?\d+),(-?\d+)>, v=<(-?\d+),(-?\d+),(-?\d+)>, a=<(-?\d+),(-?\d+),(-?\d+)>/',
            $x, $particle))
        {
            $particles[] = [
                'num' => $count,
                'collision' => false,
                'p' => [
                    'x' => $particle[1],
                    'y' => $particle[2],
                    'z' => $particle[3]
                ],
                'v' => [
                    'x' => $particle[4],
                    'y' => $particle[5],
                    'z' => $particle[6]
                ],
                'a' => [
                    'x' => $particle[7],
                    'y' => $particle[8],
                    'z' => $particle[9]
                ]
            ];
            $count ++;
        }
    }
    
    for ($i = 0; $i < 50; $i ++)
    {
        for ($j = 0; $j < count($particles); $j ++)
        {
            if ($particles[$j]['collision'])
            {
                continue;
            }
            $particles[$j]['v']['x'] += $particles[$j]['a']['x'];
            $particles[$j]['v']['y'] += $particles[$j]['a']['y'];
            $particles[$j]['v']['z'] += $particles[$j]['a']['z'];
            
            $particles[$j]['p']['x'] += $particles[$j]['v']['x'];
            $particles[$j]['p']['y'] += $particles[$j]['v']['y'];
            $particles[$j]['p']['z'] += $particles[$j]['v']['z'];
            
        }
        for ($z = 0; $z < count($particles); $z ++)
        {
            if (! $particles[$z]['collision'])
            {
                for ($x = 0; $x < count($particles); $x ++)
                {
                    if (! $particles[$x]['collision'] && ($particles[$z]['num'] !=
                         $particles[$x]['num']) && ($particles[$z]['p']['x'] ==
                         $particles[$x]['p']['x']) && ($particles[$z]['p']['y'] ==
                         $particles[$x]['p']['y']) && ($particles[$z]['p']['z'] ==
                         $particles[$x]['p']['z']))
                    {
                        $particles[$z]['collision'] = true;
                        $particles[$x]['collision'] = true;
                    }
                }
            }
        }
    }
    $active = 0;
    for($i = 0; $i<count($particles); $i++){
        if(!$particles[$i]['collision']){
            $active++;
        }
    }
    echo $active;
?>
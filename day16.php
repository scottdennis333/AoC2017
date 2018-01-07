<?php
$input = file_get_contents("day16input.txt");

$dance = explode(",", $input);

$programs = range('a','p');
$seen = [];

while(1){
    foreach($dance as $x){
        if( preg_match('|([a-z])(\w+).(\w+)|', $x, $match) ){
            list($fill,$symbol,$p1,$p2) = $match;
        }else if(preg_match('|([a-z])(\d+)|', $x, $match) ){
            list($fill,$symbol,$p1) = $match;
        }
        
        switch ($symbol){
            case 's':
                for($i=0; $i<$p1; $i++){
                    array_unshift($programs, (array_pop($programs)));
                }
                break;
            case 'x':
                $temp = $programs[$p1];
                $programs[$p1] = $programs[$p2];
                $programs[$p2] = $temp;
                break;
            case 'p':
                $key1 = array_search($p1, $programs);
                $key2 = array_search($p2, $programs);
                $temp = $programs[$key1];
                $programs[$key1] = $programs[$key2];
                $programs[$key2] = $temp;
                break;
        }
    }
    
    if(in_array(implode($programs), $seen)){
        $cycle = 1000000000 % count($seen)-1;
        break;
    }
    $seen[] = implode($programs);
    

}

echo $seen[$cycle];

?>
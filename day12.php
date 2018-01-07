<?php
$input = file_get_contents("day12input.txt");

$lines = explode(PHP_EOL, $input);

$pipes = [];
$group = [];
$allGroups = [];

foreach ($lines as $x) {
    if (preg_match('/(\d+) <-> (.*)/', $x, $match)) {
        list($fill, $id1, $id2) = $match;
        $pipes[$id1] = array_map('trim', explode(',', $id2));
    }
}

$allGroups[] = findGroup('0');
echo count($group) . "<br>";

foreach($pipes as $id1 => $id2){
   $found = false;
   $group = [];
   foreach($allGroups as $x){
       if(in_array($id1,$x)){
           $found = true;
           break;
       }
   }
   if(!$found){
       $allGroups[]  = findGroup($id1);
   }
}

echo count($allGroups);

function findGroup($id){
    global $pipes;
    global $group;
    if(!in_array($id, $group)){
        $group[] = $id;
        foreach($pipes[$id] as $x){
            findGroup($x);     
        }
    }
    return $group;
}


?>
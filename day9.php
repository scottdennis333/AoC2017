<?php
$input = file_get_contents("day9input.txt");

$score = 0;
$total = 0;
$sum = 0;
$garbage = false;
for($i=0; $i<strlen($input); $i++){
    if($input[$i] == '!'){
        $i++;
        continue;
    }
    if($garbage){
        if($input[$i] == '>'){
            $garbage = false;
        }else{
            $sum++;
            continue;
        }
    }else{        
        if($input[$i] == '<'){
            $garbage = true;
        }elseif($input[$i] == '{'){
            $score++;
        }elseif($input[$i] == '}'){
            $total += $score;
            $score--;
        }
    }
}

echo "$total<br>";
echo $sum;

?>
<?php
class Program{
    public $registers;
    public $queue;
    public $pause;
    public $sends;
    
   function __construct($registers){
       $this->registers = $registers;
       $this->queue = array();
       $this->pause = 0;
       $this->sends = 0;
   }
   function setQueue($val){
       $this->queue[] = $val; 
   }
   function getSends(){
       return $this->sends;
   }
   function getPause(){
       return $this->pause;
   }
   function setPause(){
       $this->pause = 0;
   }
   function run($line, $i, $id, &$prog){
       $number = false;
       $info = explode(" ", $line);
       if(count($info) == 3){
           list($cond, $var1, $var2) = $info;
           $number = is_numeric($var2);           
       }else{
           list($cond, $var1) = $info;
       }
       switch($cond){
           case 'snd':               
               $prog[$id]->setQueue($this->registers[$var1]);
               $this->sends++;
               $prog[$id]->setPause();               
               if($id == 0){
               }
               break;
           case 'set':
               if($number){
                   $this->registers[$var1] = $var2;
               }else{
                   $this->registers[$var1] = $this->registers[$var2];
               }
               break;
           case 'add':
               if($number){
                   $this->registers[$var1] += $var2;
               }else{
                   $this->registers[$var1] += $this->registers[$var2];
               }
               break;
           case 'mul':
               if($number){
                   $this->registers[$var1] *= $var2;
               }else{
                   $this->registers[$var1] *= $this->registers[$var2];
               }
               break;
           case 'mod':
               if($number){
                   $this->registers[$var1] %= $var2;
               }else{
                   $this->registers[$var1] %= $this->registers[$var2];
               }
               break;
           case 'rcv':
               if(count($this->queue) != 0){
                   $this->registers[$var1] = $this->queue[0];
                   array_shift($this->queue);
               }else{
                   $this->pause = 1; 
               }
               break;
           case 'jgz':
               if($var1 > 0 || ( (array_key_exists($var1, $this->registers) ) && ($this->registers[$var1] > 0) ) ){
                   if($number){
                       $i += $var2 -1;
                   }else{
                       $i += $this->registers[$var2]-1;
                   }
               }

               break;
       }
       return $i;
   }
}


$input = file_get_contents("day18input.txt");

$instr = explode(PHP_EOL, $input);
$registers1 = array();
$registers2 = array();

foreach($instr as $x){
    if(!is_numeric($x[4])){
        $registers1[$x[4]] = 0;
        $registers2[$x[4]] = 0;
        if($x[4] == 'p'){
            $registers2[$x[4]] = 1;
        }
    }
}

$prog = [new Program($registers1), new Program($registers2)];
$y = 0;
$i = 0;
$terminated = 0;
while($terminated != 2){
        if(!$prog[0]->getPause()){
            $line = $instr[$i];
            $i = $prog[0]->run($line,$i,1,$prog);
            $i++;
        }elseif(!$prog[1]->getPause()){
            $line = $instr[$y];
            $y = $prog[1]->run($line,$y,0,$prog);
            $y++;
        }
        $terminated = $prog[0]->getPause() + $prog[1]->getPause();
}
echo "Part 2:" . $prog[1]->getSends();
?>
<?php
$row_a = 'a(b(x)d)efghijkl';
$row_b = '(123).)(qw(e)';
function isBalance($string) {
    $openingBrackets = array("(", "[", "{");
    $closingBrackets = array(")", "]", "}");
    $stack = array();
    for ($i = 1;$i < strlen($string);$i++) {
        $char = $string[$i];
        if (in_array($char, $openingBrackets)) {
            array_push($stack, $char);
        }
        if (in_array($char, $closingBrackets)) {
            $matchingOpeningBracket = $openingBrackets[array_search($char, $closingBrackets) ];
            $topOfStack = array_values(array_slice($stack, -1)) [0];
            if ($topOfStack == $matchingOpeningBracket) {
                array_pop($stack);
            } else {
                echo "<span style=\"color:red;\">Eroare!</span> Parantezele nu sunt inchise corespunzator.\n";
                break;
            }
        }
        if ((strlen($string) - 1) == $i) {
            echo "<span style=\"color:green;\">Succes!</span> parantezele sunt inchise corespunzator\n";
        }
    }
}
?>
<style>
    .mt-20 {margin-top:20px;}
    .mb-20 {margin-top:20px;}
    .mt-40 {margin-top:20px;}
</style>
<div class="row">
    <div class="mt-20">Sir 1: <?=$row_a;?></div>
    <div class="mt-20">Sir 2: <?=$row_b;?></div>
    <div style="width:500px;" class="mt-20">Am folosit functia: <br />
function isBalance($string) {
    $openingBrackets = array("(", "[", "{");
    $closingBrackets = array(")", "]", "}");
    $stack = array();
    for ($i = 1;$i < strlen($string);$i++) {
        $char = $string[$i];
        if (in_array($char, $openingBrackets)) {
            array_push($stack, $char);
        }
        if (in_array($char, $closingBrackets)) {
            $matchingOpeningBracket = $openingBrackets[array_search($char, $closingBrackets) ];
            // Store value of top-most stack value
            $topOfStack = array_values(array_slice($stack, -1)) [0];
            if ($topOfStack == $matchingOpeningBracket) {
                array_pop($stack);
            } else {
                echo "<span style=\"color:red;\">Eroare!</span> Parantezele nu sunt inchise corespunzator.\n";
                break;
            }
        }
        if ((strlen($string) - 1) == $i) {
            echo "<span style=\"color:green;\">Succes!</span> parantezele sunt inchise corespunzator\n";
        }
    }
}
</div>
 <div class="mt-20">Rezultat: <br /><br />
 
 Sir 1: <?=isBalance($row_a);?> <br />
 Sir 2: <?=isBalance($row_b);?> <br />
 
 </div>
</div>



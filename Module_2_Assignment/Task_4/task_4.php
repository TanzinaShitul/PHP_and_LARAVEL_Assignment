<?php
function printFibonacci($count) {
    $num1 = 0;
    $num2 = 1;

    for ($i = 0; $i < $count; $i++) {
        echo $num1 . " ";
        
        $next = $num1 + $num2;
        $num1 = $num2;
        $num2 = $next;

    }

}

printFibonacci(15);
?>

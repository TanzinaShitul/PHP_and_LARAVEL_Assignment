<?php
$num1 = 0;
$num2 = 1;

echo "First 10 Fibonacci number is:\n";

for ($i = 0; $i < 10; $i++) { 
    echo $num1 . " ";
    $next = $num1 + $num2;

    if ($next > 100) {
        break;
    }

    $num1 = $num2;
    $num2 = $next;
}
?>

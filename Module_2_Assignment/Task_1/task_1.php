<?php
function printEvenForLoop($start, $end, $step) {
    for ($i = $start; $i <= $end; $i += $step) {
        if ($i % 2 === 0) {
            echo $i . " ";
        }
    }
}

function printEvenWhileLoop($start, $end, $step) {
    $i = $start;
    while ($i <= $end) {
        if ($i % 2 === 0) {
            echo $i . " ";
        }
        $i += $step;
    }
}

function printEvenDoWhileLoop($start, $end, $step) {
    $i = $start;
    do {
        if ($i % 2 === 0) {
            echo $i . " ";
        }
        $i += $step;
    } while ($i <= $end);
}

echo "Using for loop: ";
printEvenForLoop(2, 20, 2);
echo "\n";

echo "Using while loop: ";
printEvenWhileLoop(2, 20, 2);
echo "\n";

echo "Using do-while loop: ";
printEvenDoWhileLoop(2, 20, 2);
echo "\n";
?>

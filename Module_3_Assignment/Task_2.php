<?php
function removeEvenNumbers($numbers) {
    $result = [];
    foreach ($numbers as $value) {
        if ($value % 2 != 0) {
            $result[] = $value;
        }
    }
    return $result;
}

$numbers = range(1, 10);

$resultingArray = removeEvenNumbers($numbers);

print_r($resultingArray);
?>
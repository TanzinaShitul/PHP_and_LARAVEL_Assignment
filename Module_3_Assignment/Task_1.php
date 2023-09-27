<?php
function modifyText($text) {
    $lowerText = strtolower($text);
    $finalText = str_replace("brown", "red", $lowerText);
    echo $finalText;
}

$text = "The quick brown fox jumps over the lazy dog.";
modifyText($text);
?>
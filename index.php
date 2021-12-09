<?php

$key = [
    'user' => 'dooyong', 
    'pwd' => '1234'
];

$index = array_keys($key);
$value = array(implode(', ', $index), ":" . implode(', :', $index));

// echo implode(', :', $index);

$values = (isset($dog) || isset($value)) ? 'true' : 'false';
echo $values;

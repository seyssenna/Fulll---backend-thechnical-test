<?php


$digits = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]; 

function incrementDigits(array $digitsArray): array
{
    $incrementedDigits = [];

    foreach($digitsArray as $digit){
        $digit === 9 ? $digit = 0 : $digit ++;
        $incrementedDigits[] = $digit;
    }

    return $incrementedDigits;
};

print_r(incrementDigits($digits));


// WITH array_map()

// function incrementDigits(int $digit):int
// {
//     return $digit === 9 ? $digit = 0 : $digit ++;
// }

// print_r(array_map('incrementDigits', $digits));
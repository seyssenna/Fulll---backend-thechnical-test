<?php

function fizzBuzz(int $nbr): string
{
    if (!($nbr%3)){
        if (!($nbr%5)) {

            return $nbr . ' FizzBuzz';
        } else {

            return $nbr . ' Fizz';
        }
    } elseif (!($nbr%5)) {

        return $nbr . ' Buzz';
    } else {

        return $nbr;
    }   
}
echo( fizzBuzz(rand(0,1000)) );
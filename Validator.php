<?php

class Validator{
    public function string($value, $min=1, $max=1000){
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }
}
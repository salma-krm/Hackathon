<?php
namespace App\Http\Services;

use Exception;
use SebastianBergmann\Comparator\ExceptionComparator;

class CalculeService {

    function  some(int $a , int $b) :int {
        return $a + $b;
    }

    function divide(int $a,int $b){
   
            if($b == 0){
                throw new Exception("Division by zero is not allowed.");
            }
        
            return $a/$b;
    }

}
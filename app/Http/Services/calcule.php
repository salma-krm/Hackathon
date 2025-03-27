<?php
namespace app\Http\Services;

use Exception;

class calcule{
    public function some (int $a, int $b){
        return $a+$b;
    }
    public function divide(int $a , int $b){
        if($b==0){
            throw  new Exception('divide by zero not allowed');
        }
        return $a/$b;
    }

}
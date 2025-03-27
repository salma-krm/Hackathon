<?php 
namespace Tests\Unit;

use calcule;
use Exception;
use Tests\TestCase;
class  calculetest extends TestCase
{
    protected $calcule;
    public  function setup():void {
        parent::setUp();
        $this->calcule = new calcule;
    }
    public function testSomme(){
       $resultat=  $this->calcule->some(3,9);
        $this->assertEquals(12,$resultat);
    }
    public function testDivide(){
        $resultat=  $this->calcule->divide(4,2);
        $this->assertEquals(2,$resultat);

    }
    public function testdividefunctionthrowexception(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('divide vy zero is nit allowed');
        $this->calcule->divide(2,0);
    }
}
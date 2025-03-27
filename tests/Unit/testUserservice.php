<?php

use App\Http\Services\User;
use app\Http\Services\UserRepositorys;
use app\Http\Services\UserServices;
use Tests\TestCase;

class testUserservice extends TestCase{
  public function testcreate(){
    $mockrepository = $this->createMock(UserRepositorys::class);
    $mockrepository->method('existbyEmail')->with('salmatergui@gmail.com')->willReturn(false);
    $user = new user ('salmatergui@gmail.com','salma');
    $mockrepository->method('create')->with($user)->willReturn($user);
    $service = new UserServices($mockrepository);
   
    $newUser = $service->create($user);
    $this->assertEquals($user->getEmail(), $newUser->getEmail());
    $this->assertEquals($user->getPassword(), $newUser->getPassword());
  }
  public function testcreatewithexistemailtrhrowexception(){

  }
    
}
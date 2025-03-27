<?php
namespace app\Http\Services;

use App\Http\Services\User;
use App\Http\Services\UserRepositorys;

use Exception;

class UserServices{

   public UserRepositorys $repository;
   public function __construct(UserRepositorys $repository){
    $this->repository = $repository;
   }
   public function create(User $user){
    if( $this->repository->existbyEmail($user->getEmail())){
        throw new Exception('email elready exist');
    }
    return $this->repository->create($user);
   }
 
}
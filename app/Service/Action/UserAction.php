<?php

namespace App\Service\Action;

use App\Repositories\UserRepository;

class UserAction
{
    protected UserRepository $userRepo;

    public function  __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }
    public function run($userInfo, $refreshToken)
    {
        $email = $userInfo->getEmail();
        $data = [
            'name' => $userInfo->getName(),
            'avatar' => $userInfo->getPicture(),
            'refresh_token' => $refreshToken
        ];
       return  $this->userRepo->saveUser($email, $data);
    }


}

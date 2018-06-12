<?php

namespace API {
    class User
    {
        public function Login()
        {
            $login = \Utils::Request('login');
            $password = \Utils::Request('password');
            if($login == 'artem' && $password == '123') {
                return array(
                    'result' => 'success',
                    'token'  => \Utils::CreateGUID(__METHOD__, false),
                );
            } else {
                throw new \Exception("Invalid login or password");
            }
        }
    }
}
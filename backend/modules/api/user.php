<?php

namespace API {
    class User
    {
        public function Login()
        {
            $login = \Utils::Request('login');
            $password = \Utils::Request('password');
            return array(
                'result' => 'success',
                'token'  => \Utils::CreateGUID(__METHOD__, false),
                'param0' => 2324234,
            );
        }
    }
}
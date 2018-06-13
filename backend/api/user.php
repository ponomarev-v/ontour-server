<?php

namespace API {
    class User
    {
        public function Info()
        {
            if(\Utils::ArrayGet('active', $_SESSION)) {
                return array(
                    'token' => session_id(),
                    'login' => $_SESSION['login'],
                );
            } else {
                throw new \Exception('User not logged in');
            }
        }

        public function Login()
        {
            $login = \Utils::Request('login');
            $password = \Utils::Request('password');
            if($login == 'artem' && $password == '123') {
                $_SESSION['active'] = true;
                $_SESSION['login'] = $login;
                return $this->Info();
            } else {
                throw new \Exception("Invalid login or password");
            }
        }

        public function Logout()
        {
            session_destroy();
            return true;
        }

        public function Register()
        {
            $data = array(
                'login'    => \Utils::Request('login'),
                'password' => \Utils::Request('password'),
                'email'    => \Utils::Request('email'),
                'phone'    => \Utils::Request('phone'),
            );
            if($id = \Users::RegisgterUser($data)) {
                $_SESSION['active'] = true;
                $_SESSION['login'] = $data['login'];
                $_SESSION['userid'] = $id;
                return $this->Info();
            }
        }
    }
}
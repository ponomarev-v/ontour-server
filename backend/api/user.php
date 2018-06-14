<?php

namespace API {
    class User
    {
        public function Info()
        {
            if(\Utils::ArrayGet('active', $_SESSION)) {
                $info = \Users::GetUserInfo($_SESSION['userid']);
                \Users::UpdateLastActive($_SESSION['userid'], time());
                return array(
                    'token' => session_id(),
                    'login' => $_SESSION['login'],
                    'gsgsfg'=> '',
                );
            } else {
                throw new \Exception('Пользователь не авторизован в системе');
            }
        }

        public function Login()
        {
            $login = \Utils::Request('login');
            $password = \Utils::Request('password');
            if($id = \Users::CheckUserCredentials($login, $password)) {
                return $this->internalLogin($login, $id);
            } else {
                throw new \Exception("Неверно указано имя пользователя или пароль");
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
                return $this->internalLogin($data['login'], $id);
            }
        }

        /**
         * @param $login
         * @param $id
         * @return array
         */
        private function internalLogin($login, $id)
        {
            $_SESSION['active'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['userid'] = $id;
            return $this->Info();
        }
    }
}
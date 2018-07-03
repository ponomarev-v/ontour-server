<?php

namespace API {
    class User
    {
        public function Info()
        {
            if(\Utils::ArrayGet('active', $_SESSION)) {
                if($info = \Users::GetUserInfo($_SESSION['userid'])) {
                    \Users::UpdateLastActive($_SESSION['userid'], time());
                    return array(
                        'token'  => session_id(),
                        'userid' => $_SESSION['userid'],
                        'name'   => $info['name'],
                        'age'    => $info['age'],
                        'school' => $info['school'],
                        'phone'  => $info['phone'],
                        'email'  => $info['email'],
                        'rating' => $info['rating'],
                        'score'  => $info['score'],
                    );
                } else {
                    throw new \Exception('Ошибка при получении информации о пользователе');
                }
            } else {
                throw new \Exception('Пользователь не авторизован в системе');
            }
        }

        public function Profile(){
            $new_data = array(
                'name' => \Utils::Request('name'),
                'age' => \Utils::Request('age'),
                'phone' => \Utils::Request('phone'),
                'email' => \Utils::Request('email'),
                'school' => \Utils::Request('school'),
            );
            $id = $_SESSION['userid'];
            return \Users::ChangeUserProfile($id, $new_data);
        }

        public function Change_Password(){
            $pass_old = \Utils::Request('password_o');
            $pass_new = \Utils::Request('password_n');
            $id = $_SESSION['userid'];
            return \Users::ChangePass($id, $pass_old, $pass_new);
        }

        public function Login()
        {
            $login = \Utils::Request('login');
            $password = \Utils::Request('password');
            if($id = \Users::CheckUserCredentials($login, $password)) {
                return $this->internalLogin($id);
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
                'name'     => \Utils::Request('name'),
                'password' => \Utils::Request('password'),
                'email'    => \Utils::Request('email'),
                'phone'    => \Utils::Request('phone'),
            );
            if($id = \Users::RegisterUser($data)) {
                return $this->internalLogin($id);
            }
        }


        /**
         * @param $login
         * @param $id
         * @return array
         */
        private function internalLogin($id)
        {
            $_SESSION['active'] = true;
            $_SESSION['userid'] = $id;
            return $this->Info();
        }

    }
}
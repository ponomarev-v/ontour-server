<?php

namespace API {
    class User
    {
        //функция для дебагингааааа
        public  function TestFunc()
        {
            $TabName  = \Utils::Request('tn');
            $ColName  = \Utils::Request('cn');
            $query   = \Utils::Request('q');
        //    $res = \Core::DB() -> rawQuery("SELECT count(*) FROM object WHERE reg LIKE 'SD%' ");
        //    echo $res
            return \Utils::FindSmth($TabName, $ColName, $query);
        }
        public function EmailVerification()
        {
            $id = \Utils::Request('id');
            $KeyGet = \Utils::Request('key');
            return \Users::EmailVerification($id,$KeyGet);

        }

        public function GeoIpLocation()
        {
            return $_SERVER['GEOIP_REGION_NAME'];
        }
        //возращает регион юзера при помощи запроса на http://ipgeobase.ru. хорошо говорит места по России но на европу кажись врет.
        public function LocationRegion(){
            $ip = \Utils::GetIp();
            $result = \Utils::UserRegion($ip);
            if($result == null){
                throw new \Exception('Ошибка при получении региона пользователя');
            }
            else {
                return $result['region'];
            }
        }

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
        //права юзера
        public function CheckUserRules(){
            return \Users::CheckUsersRules($_SESSION['userid']);
        }
        //изменение профиля user
        public function Profile(){
            $new_data = array(
                'name' => \Utils::Request('name'),
                'age' => \Utils::Request('age'),
                'phone' => \Utils::Request('phone'),
                'email' => \Utils::Request('email'),
                'school' => \Utils::Request('school'),
            );
            $id = $_SESSION['userid'];
           // return \Users::ChangeUserProfile($id, $new_data);
            return \Users::UpdateUserProfile($id, $new_data);
        }
        //поменять password

        public function Change_Password(){
            $pass_old = \Utils::Request('old_password');
            $pass_new = \Utils::Request('new_password');
            $id = $_SESSION['userid'];
            return \Users::ChangePass($id, $pass_old, $pass_new);
        }

        //логин....
        public function Login()
        {
            // Сюда приходят данные с сайта
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
        //активация сессии и присуждение id
        private function internalLogin($id)
        {
            $_SESSION['active'] = true;
            $_SESSION['userid'] = $id;
            return $this->Info();
        }

    }
}
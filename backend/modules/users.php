<?php

class Users
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISABLED = 2;

    public static function CheckUserData($data)
    {
        if(!isset($data['login']) || strlen($data['login']) < 3 || strlen($data['login']) > 255)
            throw new \Exception("Логин должен быть не менее 3 и не более 255 символов");
        if(!isset($data['password']) || strlen($data['password']) < 8 || strlen($data['password']) > 255)
            throw new \Exception("Пароль должен быть не менее 8 и не более 255 символов");
        if(!isset($data['email']) || empty($data['email']))
            throw new \Exception("Не указан email");
        if(!isset($data['phone']) || empty($data['phone']))
            throw new \Exception("Не указан телефон");
    }

    public static function RegisgterUser($data)
    {
        print_r($data);
        self::CheckUserData($data);
        // Подключаемся к базе
        $db = Core::DB();
        // Ищем пользователя в базе
        $res = $db->where('login', $data['login'])->get('user');
        if(empty($res)) {
            $user_data = array(
                'login'     => $data['login'],
                'password'  => md5($data['password']),
                'phone'     => $data['phone'],
                'email'     => $data['email'],
                'role'      => self::ROLE_USER,
                'date_reg'  => time(),
                'date_last' => time(),
                'status'    => self::STATUS_DISABLED,
                'rating'    => 0,
                /* TODO Если регистрация по приглашению, то возможна установка начальных баллов */
                /* и установка баллов для того, кто пригласил */
                'score'     => 0,
                'name'      => $data['login'],
            );
            $db->insert('user', $user_data);
            $new_id = $db->getInsertId();
            return $new_id;
        } else {
            throw new Exception('Пользователь '.$data['login'].' уже существует');
        }
    }

    public static function CheckUserCredentials($login, $password)
    {
        // Подключаемся к базе
        $db = Core::DB();
        // Ищем пользователя
        $res = $db
            ->where('login', $login)
            ->where('password', md5($password))
            ->get('user');
        if(sizeof($res) == 1) {
            return $res[0]['id'];
        } else {
            return null;
        }
    }

    public static function GetUserInfo($userid)
    {
        // Подключиться к базу
        // получить информацию по ID
        // вернуть ее
        $db = Core::DB();
        $res = $db -> where('id', $userid);
        return $res;

    }

    public static function UpdateLastActive($userid, $time)
    {
        // Подключиться к базу
        // Обновляем поле date_last
    }
}
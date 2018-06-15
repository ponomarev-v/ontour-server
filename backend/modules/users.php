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
        if(!isset($data['password']) || strlen($data['password']) < 8 || strlen($data['password']) > 255)
            throw new \Exception("Пароль должен быть не менее 8 и не более 255 символов");
        if(!isset($data['surname']) || empty($data['surname']))
            throw new \Exception("Не указана фамилия");
        if(!isset($data['name']) || empty($data['name']))
            throw new \Exception("Не указано имя");
        if(!isset($data['phone']) || strlen($data['phone']) != 10)
            throw new \Exception("Не указан телефон");
    }

    public static function RegisgterUser($data)
    {
        $data['phone'] = Utils::FormatPhone($data['phone']);
        self::CheckUserData($data);
        // Подключаемся к базе
        $db = Core::DB();
        // Проверка по имени телефона
        $res = $db->where('phone', $data['phone'])->get('user');
        if(!empty($res)) {
            throw new Exception('Пользователь с указанным телефоном уже существует');
        }
       // if(!empty($res)) {
       //     throw new Exception('Пользователь с указанным email-адресом уже существует');
       // }

        $user_data = array(
            'password'  => md5($data['password']),
            'phone'     => $data['phone'],
            'email'     => '',
            'role'      => self::ROLE_USER,
            'date_reg'  => time(),
            'date_last' => time(),
            'status'    => self::STATUS_DISABLED,
            'rating'    => 0,
            /* TODO Если регистрация по приглашению, то возможна установка начальных баллов */
            /* и установка баллов для того, кто пригласил */
            'score'     => 0,
            'name'      => $data['name'],
            'surname'   => $data['surname'],

        );

        $db->insert('user', $user_data);
        $new_id = $db->getInsertId();
        if($new_id > 0)
            return $new_id;
        else
            throw new Exception('Непредвиденная ошибка при регистрации пользователя');
    }

    public static function CheckLogin($login){
        return (stripos($login, '@') !== false) ? 1 : 0;
     }

    public static function CheckUserCredentials($login, $password)
    {
        // Подключаемся к базе
        $db = Core::DB();
        // Ищем пользователя
        if ( self::CheckLogin($login) == 1 ){
            $res = $db
                ->where('email', $login)
                ->where('password', md5($password))
                ->get('user');
        }
        elseif (self::CheckLogin($login) == 0 ){
            $res = $db
                ->where('phone', $login)
                ->where('password', md5($password))
                ->get('user');
        }
        if(sizeof($res) == 1) {
            return $res[0]['id'];
        } else {
            return null;
        }
    }

    public static function GetUserInfo($userid)
    {
        $res = Core::DB()->where('id', $userid)->getOne('user');
        return $res;
    }

    public static function UpdateLastActive($userid, $time)
    {
        Core::DB()->where('id', $userid)->update('user', array(
            'date_last' => time(),
        ));
        return true;
    }
}
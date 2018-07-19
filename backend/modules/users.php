<?php

class Users
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISABLED = 2;

//проверка веденных данных
    public static function CheckUserData($data)
    {
        //проверяем размер пароля
        if(!isset($data['password']) || strlen($data['password']) < 8 || strlen($data['password']) > 255)
            throw new \Exception("Пароль должен быть от 8 до 255 символов");

        // TODO нормальная проверка email-a
        //нормальная проверка email
        if(filter_var($data['email'],FILTER_VALIDATE_EMAIL)== false)
            throw new \Exception("email отсутствует или указан неверно");
        //костыльная проверка по email&
        //if(!isset($data['email']) || empty($data['email']) || stripos($data['email'], '@') == false)
        //    throw new \Exception("emal отсутствует или указан неверно");
        //проверка на имя
        if(!isset($data['name']) || empty($data['name']))
            throw new \Exception("Не указано имя");
        //проверка на номер телефона

        if(!isset($data['phone']) || strlen($data['phone']) != 10)
            throw new \Exception("Не указан телефон");
    }
//возращаем роль юзера
    public static function CheckUsersRules($id){
        $res = Core::DB()->where('id', $id);
        if (isset($res) && !empty($res)){
            if($res['role'] == 'admin')
                return self::ROLE_ADMIN;
            else
                return self::ROLE_USER;
        }
        else
            throw new Exception('Ошибка подключения к БД');
    }
//регестрация юзера
    public static function RegisterUser($data)
    {
        //формат номера телефона
        $data['phone'] = Utils::FormatPhone($data['phone']);
        self::CheckUserData($data);
        // Подключаемся к базе
        $db = Core::DB();
        // Проверка по имени телефона
        $res = $db->where('phone', $data['phone'])->get('user');
        if(!empty($res)) {
            throw new Exception('Пользователь с указанным телефоном уже существует');
        }
        $res = $db->where('email', $data['email'])->get('user');
        if(!empty($res)) {
            throw new Exception('Пользователь с указанной почтой уже существует');
        }
        $user_data = array(
            'password'  => md5($data['password']),
            'phone'     => $data['phone'],
            'email'     => $data['email'],
            'role'      => self::ROLE_USER,
            'date_reg'  => time(),
            'date_last' => time(),
            'status'    => self::STATUS_NEW,
            'rating'    => 0,
            /* TODO Если регистрация по приглашению, то возможна установка начальных баллов */
            /* и установка баллов для того, кто пригласил */
            'score'     => 0,
            'name'      => $data['name'],
        );

        $db->insert('user', $user_data);
        $new_id = $db->getInsertId();
        if($new_id > 0)
            return $new_id;
        else
            throw new Exception('Непредвиденная ошибка при регистрации пользователя');
    }
    // код потверждения юзера при вызове функции генерит новый код и записавает в бд
    public static function CreateCodeVerification($user)
    {
        Core::DB()->where('id', $user)->update('user', array(
            'activate_code' => Utils::generateRandomString(),
        ));
        return true;

    }

    //потверджение email*
    public static function CreateEmailVerification($user)
    {
        $db = Core::DB();
        $res = $db->where('id',$user)->get('user');
        $link = "http://api.turneon.ru/?method=user.EmailVerification&id=" . $user . "&pass=" . $res['password'] . "&key=" . $res['\'activate_code'];
        //if(filter_var($res['email'],FILTER_VALIDATE_EMAIL) == false)
        //{
          //  throw new \Exception("email error");
        //}
        $email = $res['email'];
        return mail($email,'Код активации','13456y');
    }
//смена пароля
//TODO починить
    public static function ChangePass($id, $pass_old, $pass_new)
    {
        $db = Core::DB();
        if (!isset($pass_old) || strlen($pass_old) < 8 || strlen($pass_old) > 255)
            throw new \Exception("Старый пароль должен быть от 8 до 255 символов");

        if (!isset($pass_new) || strlen($pass_new) < 8 || strlen($pass_new) > 255)
            throw new \Exception("Новый пароль должен быть от 8 до 255 символов");
        $res = $db->where('id', $id)->get('user');
        $pass_old = md5($pass_old);
        $pass_new = md5($pass_new);
        if (!isset($res) || empty($res))
            throw new \Exception("Ошибка получение данных БД о пользователе или пользователь не существует");
        else {
            if ($pass_old == $res[0]['password'])
            {
                if($pass_new != $res[0]['password']) {
                    $upd = array(
                        'password' => $pass_new
                    );
                    $db->where('id', $id)->update('user', $upd);
                }
                else
                    throw new \Exception("Старый пароль совпадает с новым");
                return $db->getLastError();
            }
            else
                throw new \Exception("Неправильный старый пароль");
        }
        return true;
    }
//проверка данных на обновление userdata
    public static function ChangeUserProfile($id, $data)
    {
        // Подключаемся к базе
        $db = Core::DB();
        $upd = array();
        if(isset($data['phone']) && !empty($data['phone']))
        {
            $data['phone'] = Utils::FormatPhone($data['phone']);
            $res = $db->where('phone', $data['phone'])->where('id', $id, '!=')->get('user');
            if(!empty($res)) {
                throw new Exception('Указанный телефон занят другим пользователем');
            }
            $upd['phone'] = $data['phone'];
        }
        if(isset($data['name']))
        {
            $data['name'] = trim($data['name']);
            if(empty($data['name']))
                throw new Exception('Имя пользователя не может быть пустым');
            $upd['name'] = $data['name'];
        }
        if(isset($data['email']) && !empty($data['email']))
        {
            $res = $db->where('email', $data['email'])->where('id', $id, '!=')->get('user');
            if(!empty($res)) {
                throw new Exception('Указанный email занят другим пользователем');
            }
            $upd['email'] = $data['email'];
        }
        if(isset($data['age']) && !empty($data['age'])) {
            $upd['age'] = $data['age'];
        }
        if(isset($data['school']) && !empty($data['school'])) {
            $upd['school'] = $data['school'];
        }
        //сам update
        $db->where('id', $id)->update('user', $upd);
        if($msg = $db->getLastError())
            throw new Exception('Непредвиденная ошибка при сохранении данных.'.(Config::DEBUG ? ' '.$msg : ''));
        else
            return true;
    }
//проверка по login и password
    public static function CheckUserCredentials($login, $password)
    {
        // Подключаемся к базе
        $db = Core::DB();
        // Ищем пользователя
        if($ph = Utils::FormatPhone($login)) {
            // через phone
            $res = $db
                ->where('phone', $ph)
                ->where('password', md5($password))
                ->get('user');
        } else {
            $res = $db
                // через email
                ->where('email', $login)
                ->where('password', md5($password))
                ->get('user');
        }
        if(sizeof($res) == 1)
            return $res[0]['id'];
        else
            return null;

    }
//возращаем инфо о юзере
    public static function GetUserInfo($userid)
    {
        // здесь мы подкллючаемся к бд и достаем инфу по пользователю по id.
        $res = Core::DB()->where('id', $userid)->getOne('user');
        return $res;
    }
//когда юзер был в сети
    public static function UpdateLastActive($userid, $time)
    {
        Core::DB()->where('id', $userid)->update('user', array(
            'date_last' => time(),
        ));
        return true;
    }
}
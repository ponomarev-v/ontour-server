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
//регестрация юзера норм рааботает
    public static function RegisterUser($data)
    {
        //формат номера телефона
        $data['phone'] = \Utils::FormatPhone($data['phone']);
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
            'phone-activation-code' => 'test',
            'email-status' => 0,
            'phone-status' => 0,
            //TODO Если регистрация по приглашению, то возможна установка начальных баллов
            // и установка баллов для того, кто пригласил
            'score'     => 0,
            'name'      => $data['name'],
        );

        $db->insert('user', $user_data);
        $new_id = $db->getInsertId();
        if($msg = $db->getLastError())
            throw new Exception('Непредвиденная ошибка при сохранении данных.'.(Config::DEBUG ? ' '.$msg : ''));
        if($new_id > 0) {
            //генерит код при регестрации
            $status = Users::CreateCodeVerification($new_id);
            if($status == true)
                if(!empty($data['email']))
                    Users::SendEmailVerification($new_id);
            return $new_id;
        }
        else
            throw new Exception('Непредвиденная ошибка при регистрации пользователя');
    }

//смена пароля - работает
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

    //Обновление юзера по нормальному? вроде да
    public static function UpdateUserProfile($id, $data)
    {
        $db = Core::DB();
        $upd = array();
        $data['phone'] = \Utils::FormatPhone($data['phone']);
        //почта и мобила
        $bd = $db->where('id',$id)->get('user');
        // костыль века
        $res = $bd[0];
        //проверка мобилы
        if($res['phone'] != $data['phone'])
        {
            if(!empty($data['phone']) && Utils::FindBd('phone', $data['phone']))
                throw new Exception('Указанный телефон занят другим пользователем');
        }
        //проверка почты
        if(filter_var($data['email'],FILTER_VALIDATE_EMAIL) == false)
            throw new \Exception("email отсутствует или указан неверно");
        if($res['email'] != $data['email'])
        {
            if(!empty($data['email']) && Utils::FindBd('email', $data['email']))
                throw new Exception('Указанный email занят другим пользователем');

        }
        //проверка возраста
        if($data['age'] > 120)
            throw new \Exception("Те сколько лет то?");
        $upd['phone'] = $data['phone'];
        $upd['email'] = $data['email'];
        //проврка имени
        if(!empty($data['name']))
        {
            $data['name'] = trim($data['name']);
            $upd['name'] = $data['name'];
        }
        else
        {
            throw new Exception('Имя не может быть пустым');
        }
        if(!empty($data['age']))
        {
            $data['age'] = trim($data['age']);
            $upd['age'] = $data['age'];
        }
        else
        {
            throw new Exception('Не указан возраст');
        }
        if(!empty($data['school']))
        {
            $data['school'] = trim($data['school']);
            $upd['school'] = $data['school'];
        }
        else
        {
            throw new Exception('Не указан возраст');
        }
        //сам update
        $db->where('id', $id)->update('user', $upd);
        if($msg = $db->getLastError())
            throw new Exception('Непредвиденная ошибка при сохранении данных.'.(Config::DEBUG ? ' '.$msg : ''));
        if($res['email'] != $data['email'])
        {
            Users::CreateCodeVerification($id);
            Users::SendEmailVerification($id);
        }

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
    public static function GetUserInfo($user)
    {
        // здесь мы подкллючаемся к бд и достаем инфу по пользователю по id.
        $res = Core::DB()->where('id', $user)->getOne('user');
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
    // код потверждения юзера при вызове функции генерит новый код и записавает в бд
    //че не так было?
//ключь к мылу
    public static function CreateCodeVerification($user)
    {
        $key = \Utils::generateRandomString();
        Core::DB()->where('id', $user)->update('user', array(
            'activate_code' => $key,
            'email-status' => 0,
        ));
        return true;

    }

    //отправка email с паролем и ключом
    public static function SendEmailVerification($user)
    {
        $db = Core::DB();
        $res = $db->where('id',$user)->get('user');
        $bd = $res[0];
        $keyNoE['password'] = $bd['password'];
        $keyNoE['key'] = $bd['activate_code'];
        //$key = encrypt("$keyNoE",$bd['password']);
        //генерим сам ключь по нано технологии....
        $key = hash_hmac('ripemd160',$keyNoE['key'], $keyNoE['password']);

        $text = "Для подтверждения почты перейдите по ссылке ниже: \n" . "http://api.turneon.ru/?method=user.EmailVerification&id=" . $user . "&key=" . $key;
        $email = $bd['email'];
        $headers = 'From:EmailVerification@turneon.ru' . "\r\n";
        return mail( $email,'Код активации',$text, $headers);
    }
    //функция для проверки почты..
    public static function EmailVerification($id , $KeyGet)
    {
        $db = Core::DB();
        $res = $db->where('id',$id)->get('user');
        $bd = $res[0];
        $keyNoE['password'] = $bd['password'];
        $keyNoE['key'] = $bd['activate_code'];
        $Locality = hash_hmac('ripemd160',$keyNoE['key'], $keyNoE['password']);
        if($KeyGet == $Locality)
        {
            // меняем статус почты юзера
            Core::DB()->where('id', $id)->update('user', array(
                'email-status' => 1,
            ));
            $new_url = 'http://turneon.ru/emailVerificated.php';
            header('Location: '.$new_url);
            return true;
        }
        else
        {
            throw new Exception('Ошибка потвердения почты');

        }
    }

}
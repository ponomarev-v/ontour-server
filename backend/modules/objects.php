<?php
class Objects
{
    //проверка всего
    public static function Check_added_obj($data)
    {
        // проверка введенных пользователем данных об объекте
        if(!isset($data['cx']) || empty($data['cx']) )
            throw new \Exception("Некорректно введены координаты");
        if(!isset($data['cy']) || empty($data['cy']) )
            throw new \Exception("Некорректно введены координаты");
        if(!isset($data['name']) || empty($data['name']))
            throw new \Exception("Не указано имя");
        if(!isset($data['kind']) || empty($data['kind']))
            throw new \Exception("Не указан тип");
        if(!isset($data['reg']) || empty($data['reg']))
            throw new \Exception("Не указана область");
        //код ниже крашит
        // проверка на существование имени и координат объекта в базе
      //  $res = Core::DB()->where('name', $data['name']);
      //  if (!empty($res))
      //      throw new Exception('Объект с таким именем уже существует!');
    }
    //добавить обьект
    public static function Add_obj($data, $id)
    {
        self::Check_added_obj($data);
        // Подключаемся к базе
        $db = Core::DB();
        // Проверка по координатам
        //self::DataCheck($data);
        $obj_data = array(
            'cx'          => $data['cx'],
            'cy'          => $data['cy'],
            'kind'        => $data['kind'],
            'date_add'    => time(),
            'description' => $data['description'],
            'user_id'     => $id,
            'name'        => $data['name'],
            'reg'         => $data['reg']
        );
        // Помещам данные в базу
        $db->insert('object', $obj_data);
        $new_id = $db->getInsertId();
        if($new_id > 0)
            return $new_id;
        else
            throw new Exception('Непредвиденная ошибка при добавлении объекта');

    }
    //возращает обьект
    public static function Get_obj ($cx, $cy, $name)
    {
        // Подключаемся к базе
        $db = Core::DB();
        // проверка коорднат
        if (isset($cx) && !empty($cx) && isset($cy) && !empty($cy)) {
            $data = $db
                ->where('cx', $cx)
                ->where('cy', $cy)
                ->where('name', $name)
                ->get('object');
        }
        else
            throw new Exception('Не указаны или неправильно указаны координаты и имя');
        return $data;
    }
    //Возращает все обьекты
    public static function GetAllObj()
    {
        $db = Core::DB();
        $cols = Array("id","cx","cy","name","description","reg");
        $data = $db->get("object",null,$cols);
        return $data;
    }
    //удаление обьекта
    public static function Delete_obj($cx, $cy){
        return Core::DB()->where('cx', $cx)->where('cy', $cy)->delete('objects');
    }
    //найти обьект
    public static function Find_obj($str)
    {
        $db = Core::DB();
        if (isset($str) && !empty($str))
            $str.='%';
        else
            throw new Exception('Некорректно введенные данные');
        // делаем запрос в бд и проверяем выдаем вссе совпадения
        $res = $db->rawQuery("SELECT * FROM object WHERE name LIKE '$str'");
        return $res;
    }
    //метод для ненужного метода
    public static function Add_to_Fav($act, $objid, $id){
        $db = Core::DB();
        $ures = $db ->where('id', $id)
                    ->get('user');
        $ores = $db ->where('id', $id)
                    ->get('object');
        $ures['favorites'] = $ures['favorites'] + ',' + $ores['id'];
        $db->where('id', $id) -> update('user', $ures);
        return $ores['id'];
    }

}
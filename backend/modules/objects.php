<?php
class Objects
{
    public static function Check_added_obj($data){
        // проверка введенных пользователем данных об объекте
        if(!isset($data['cx']) || empty($data['cx']) )
            throw new \Exception("Некорректно введены координаты");
        if(!isset($data['cy']) || empty($data['cy']) )
            throw new \Exception("Некорректно введены координаты");
        if(!isset($data['name']) || empty($data['name']))
            throw new \Exception("Не указано имя");
        if(!isset($data['kind']) || empty($data['kind']))
            throw new \Exception("Не указан тип");
        if(!isset($data['obl']) || empty($data['obl']))
            throw new \Exception("Не указана область");
        // проверка на существование имени и координат объекта в базе
      //  $res = Core::DB()->where('name', $data['name']);
      //  if (!empty($res))
      //      throw new Exception('Объект с таким именем уже существует!');
    }
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
            'obl'         => $data['obl']
        );
        // Помещам данные в базу
        $db->insert('object', $obj_data);
        $new_id = $db->getInsertId();
        if($new_id > 0)
            return $new_id;
        else
            throw new Exception('Непредвиденная ошибка при добавлении объекта');

    }
    public static function Get_obj ($cx, $cy, $name){
        // Подключаемся к базе
        $db = Core::DB();
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
    public static function GetAllObj(){
        $db = Core::DB();
        $cols = Array("cx","cy","name","description","obl");
        $data = $db->get("object",null,$cols);
        return $data;
    }
    public static function Delete_obj($cx, $cy){
        return Core::DB()->where('cx', $cx)->where('cy', $cy)->delete('objects');
    }
    public static function Find_obj($str)
    {
        $db = Core::DB();
        $str.='%';
        $res = $db->rawQuery("SELECT * FROM object WHERE name LIKE '$str'");
        return $res;
    }
}
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
//методы для действия с таблицей favorites
    public static function AddtohFav($objid, $id){
        $db = Core::DB();
        $update = array(
            'user_id'   => $id,
            'object_id' => $objid,
            'add_date'  => time()
        );
        $db->insert('favorites', $update);
        return $db->getLastError();
    }

    public static function GetObjsFromFav($objid){
        return Core::DB()->where('object_id', $objid)
                         ->get('favorites');
    }

    public static function GetUesersFromFav($id){
        return Core::DB()->where('user_id', $id)
                         ->get('favorites');
    }

    public static function RemoveFromFav($objid, $id){
        $db = Core::DB();
        return $db->where('user_id', $id)
                  ->where('object_id', $objid)
                  ->delete('favorites');
    }
    //метод для действия с таблицей favorites
    //это в одном, но больше он не нужен
    public static function ActionWithFav($act, $objid, $id){
        $db = Core::DB();
        $update = array(
            'user_id'   => $id,
            'object_id' => $objid,
            'add_date'  => time()
        );
        if($act == 'add'){
            $db->insert('favorites', $update);
        }
        elseif($act == 'get_user'){
            $res = $db ->where('user_id', $id)
                       ->get('favorites');
        }
        elseif($act == 'get_object') {
            $res = $db ->where('object_id', $objid)
                       ->get('favorites');
        }
        return isset($res) && !empty($res) ? $res : $db->getLastError();
    }
    // обьекты на экран
    public static function Obj_Screen_Return($Min_X,$Min_Y,$Max_X,$Max_Y)
    {
        $db = Core::DB();
        $res = $db -> rawQuery("SELECT * FROM object WHERE $Max_X > 'cx' AND 'cx' > $Min_X AND $Max_Y > 'cy' AND 'cy' > $Min_Y");
        $msg = $db->getLastError();
        echo  $msg;
        echo json_encode($res);
        return $res;
    }

}
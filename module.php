<?php
class users {
    public $id;
    public $name;
    public $gender;
    public $data;
    public $phone;
    public $del;
    private $result;
    private function filter(){

    }
    private function get(){                                 //выборка всех не удаленных юзеров
        include_once "config.php";
        if($result = $connect->query("
                     SELECT id, name, gender, date, phone
                     FROM users
                     WHERE del = 0
        "))
            return $result;
        else
            return "Ошибка select!";
    }
    public function add(){                                 //добавление юзера
        if($this->connect->query("
                    INSERT INTO users (name, gender, date, phone, del)
                    VALUES ('$this->name', '$this->gender', '$this->data', '$this->phone', '0')
        "))
           return "OK";
        else
           return "Ошибка!";
    }
    public function del(){                                 //удаление юзера
        if($this->connect->query("
                    UPDATE users
                    SET del=('1')
                    WHERE id = '$this->id'
        "))
            return "del_ok";
        else
            return "Ошибка удаления!";
    }
    public function update(){

    }
    static function view(){                             //отрисовка всех юзеров в таблицу
        $alluser = users::get();
        $i=0;
        while($u=$alluser->fetch_assoc()){
            $i++;
            echo ("
                <tr class='userview'>
                    <td>$i</td>
                    <td class='tdName'>".$u['name']."</td>
                    <td>".$u['gender']."</td>
                    <td>".date('d.m.Y', strtotime($u['date']))."</td>
                    <td>".$u['phone']."</td>
                    <td><button type='button' class='btn_upd btn btn-success' value=".$u['id'].">...</button>
                    <button type='button' class='btn_del btn btn-danger' value=".$u['id'].">X</button></td>
                </tr>
            ");
        }
    }
}
?>
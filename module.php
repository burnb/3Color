<?php
class users {
    public $id;
    public $name;
    public $gender;
    public $data;
    public $phone;
    public $del;
    public $connect;

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
            return $connect->error;
    }

    public function add(){                                 //добавление юзера
        if($this->connect->query("
                    INSERT INTO users (name, gender, date, phone, del)
                    VALUES ('$this->name', '$this->gender', '$this->data', '$this->phone', '0')
        "))
           return array('suc' => 1);
        else
           return array('suc' => '', 'err' => $this->connect->error);
    }

    public function del(){                                 //удаление юзера
        if($this->connect->query("
                    UPDATE users
                    SET del=('1')
                    WHERE id = '$this->id'
        "))
            return array('suc' => 1);
        else
            return array('suc' => '', 'err' => "Ошибка удаления ".$this->connect->error);
    }

    public function update(){
        if($this->connect->query("
                    UPDATE users
                    SET name= '$this->name',gender='$this->gender',date='$this->data',phone='$this->phone'
                    WHERE id = '$this->id'
        "))
            return array('suc' => 1);
        else
            return array('suc' => '', 'err' => $this->name.$this->id.$this->connect->error);
    }

    static function view(){                             //отрисовка всех юзеров в таблицу
        $alluser = users::get();
        if (is_string($alluser)){
            echo('<br>Ошибка запроса на отрисовку: '.$alluser);
            exit();
        };
        $i=0;
        while($u=$alluser->fetch_assoc()){
            $i++;
            $gender=($u['gender']=='man')?'Мужской':'Женский';
            echo ("
                <tr class='userview'>
                    <td>$i</td>
                    <td class='tdName'>".$u['name']."</td>
                    <td class='tdGender'>".$gender."</td>
                    <td class='tdDate'>".date('d.m.Y', strtotime($u['date']))."</td>
                    <td class='tdPhone'>".$u['phone']."</td>
                    <td><a class='popup-with-form' href='#form'><button class='btn_edit btn btn-success' value=".$u['id'].">...</button></a>
                    <button type='button' class='btn_del btn btn-danger' value=".$u['id'].">X</button></td>
                </tr>
            ");
        }
    }
}
?>
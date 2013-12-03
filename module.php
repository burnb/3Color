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
        $this->id=strip_tags(mysql_real_escape_string(trim($this->id)));
        $this->name=strip_tags(mysql_real_escape_string(trim($this->name)));
        $this->gender=strip_tags(mysql_real_escape_string(trim($this->gender)));
        $this->data=strip_tags(mysql_real_escape_string(trim($this->data)));
        $this->phone=strip_tags(mysql_real_escape_string(trim($this->phone)));
    }

    public function valid(){
        $e=0;
        $errorForm=array();
        $this->filter();
        if (empty($this->name)){
            $errorForm['inputName'] = 'Заполните поле "Имя"!';
            $e++;
        }
        if ($this->gender!="man" && $this->gender!="women"){
            $errorForm['inputGender'] = 'Укажите пол!';
            $e++;
        }
        if (empty($this->data)){
            $errorForm['inputDate'] = 'Заполните поле "Дата рождения"!';
            $e++;
        }
        if (empty($this->phone)){
            $errorForm['inputPhone'] = 'Заполните поле "Телефон"!'.$this->data;
            $e++;
        }
        if (!$e){
            if (strlen($this->name)>256) $errorForm['inputName'] = 'Имя должно быть не более 256 символов!';
            if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/',$this->data)) $errorForm['inputDate'] = 'Поле "Дата рождения" заполненно некорректно!';
            if (!preg_match('/^(8)\(([0-9]{4})\)([0-9]{2})-([0-9]{2})-([0-9]{2})$/',$this->phone)) $errorForm['inputPhone'] = 'Поле "Телефон" заполненно некорректно!<br> Правильный формат 8(хххх)хх-хх-хх';
        }
        return $errorForm;

    }

    public function add(){                                 //добавление юзера
        $this->filter();
        $this->data=date('Y-m-d', strtotime($this->data));
        if($this->connect->query("
                    INSERT INTO users (name, gender, date, phone, del)
                    VALUES ('$this->name', '$this->gender', '$this->data', '$this->phone', '0')
        "))
           return array('suc' => 1);
        else
           return array('suc' => '', 'err' => $this->connect->error);
    }

    public function del(){                                 //удаление юзера
        $this->filter();
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
        $this->filter();
        $this->data=date('Y-m-d', strtotime($this->data));
        if($this->connect->query("
                    UPDATE users
                    SET name= '$this->name',gender='$this->gender',date='$this->data',phone='$this->phone'
                    WHERE id = '$this->id'
        "))
            return array('suc' => 1);
        else
            return array('suc' => '', 'err' => $this->name.$this->id.$this->connect->error);
    }
}

class views{
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
    static function form(){
        include_once 'views/form.php';
    }

    static function view(){                             //отрисовка всех юзеров в таблицу
        $alluser = views::get();
        if (is_string($alluser)){
            echo('<br>Ошибка запроса на отрисовку: '.$alluser);
            exit();
        };
        include_once 'views/table.php';
        }
}
?>
<?php
$i=0;
while($u=$alluser->fetch_assoc()){
    $i++;
    $gender=($u['gender']=='man')?'Мужской':'Женский';
    $view = " <tr class='userview'>
                <td>$i</td>
                <td class='tdName'>".$u['name']."</td>
                <td class='tdGender'>".$gender."</td>
                <td class='tdDate'>".date('d.m.Y', strtotime($u['date']))."</td>
                <td class='tdPhone'>".$u['phone']."</td>
                <td><a class='popup-with-form' href='#form'><button class='btn_edit btn btn-success' value=".$u['id'].">...</button></a>
                    <button type='button' class='btn_del btn btn-danger' value=".$u['id'].">X</button></td>
                </tr>
            ";
    echo($view);
};
?>
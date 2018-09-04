<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo form_open('city_controller/delete_city');
        echo form_label('准备从列表删除如下信息: ');
        echo "<br/>";
        echo form_hidden('city_name', $cities[0]->name);
        echo form_input(array('id' => 'city_name',
            'name' => 'display_city_name', 'value' => $cities[0]->name, 'disabled' => "disabled"));
        echo "<br/>";

        echo form_submit(array('id' => 'submit', 'name' => 'delete', 'value' => 'Delete'));
        echo form_submit(array('id' => 'give_up', 'name' => 'cancel', 'value' => 'Cancel'));
        echo form_close();
        ?>
    </body>
</html>

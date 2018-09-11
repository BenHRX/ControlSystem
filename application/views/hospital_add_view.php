<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>医院维护页面</title>
    </head>
    <body>
        <?php echo form_open("hospital_controller/add_hospital", "id='hospital_add_form'") ?>
        <label>所处城市:</label>
        <select name="city_choose">
        <?php
        foreach ($cities as $c) {
            if ($c->name === $selected_city->name) {
                echo "<option selected='true'>" . $c->name . "</option>";
            } else {
                echo "<option>" . $c->name . "</option>";
            }
        }
        ?>
        </select>
        <label>医院名称:</label><input type="text" name="hospital_name" value="" />
        <label>地址:</label><input type="text" name="address" value="" />
        <label>描述:</label><textarea name="description" rows="3" cols="20">暂无介绍</textarea>
        <label>经度</label><input type="text" name="longtitude" value="0.0" />
        <lable>纬度</lable><input type="text" name="latitude" value="0.0" />
        <input type="submit" name="add" value="Add" />
        <input type="submit" name="decline" value="Decline" />
        <?php echo form_close() ?>
    </body>
</html>

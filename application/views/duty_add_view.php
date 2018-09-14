<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>排班维护页</title>
    </head>
    <body>
    <lable>你好，<?php echo $user_name ?>:</lable>
    <br/>
    <label>请添加排班信息:</label>
    <?php date_default_timezone_set('Asia/Hong_Kong');?>
    <?php echo form_open("duty_controller/add_duty") ?>
    <label>日期： </label><input type="date" name="date_picker" value="<?php echo date("Y-m-d");?>" />
    <label>状态： </label>
    <input type="radio" name="status_group" value="0" />休假
    <input type="radio" name="status_group" value="1" checked="checked"/>候诊
    <input type="radio" name="status_group" value="2" />约满
    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th>9:00~10:00</th>
                <th>10:00~11:00</th>
                <th>11:00~12:00</th>
                <th>14:00~15:00</th>
                <th>15:00~16:00</th>
                <th>16:00~休息</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>可接待人数</td>
                <td><input type="text" name="available[]" value="3" size="7" /></td>
                <td><input type="text" name="available[]" value="3" size="7"/></td>
                <td><input type="text" name="available[]" value="3" size="7"/></td>
                <td><input type="text" name="available[]" value="3" size="7"/></td>
                <td><input type="text" name="available[]" value="3" size="7"/></td>
                <td><input type="text" name="available[]" value="5" size="7"/></td>
                <!--http://php.net/manual/zh/faq.html.php  -- 一个PHP对变量数组化的解释-->
            </tr>
        </tbody>
    </table>
    <input type="submit" value="Add" name="add" />
    <input type="submit" value="Decline" name="decline" />
    <?php echo form_close() ?>
</body>
</html>

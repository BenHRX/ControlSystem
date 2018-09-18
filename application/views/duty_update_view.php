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
    <?php date_default_timezone_set('Asia/Hong_Kong'); ?>
    <lable>你好，<?php echo $user_name ?>:</lable>
    <br/>
    <label>请修改以下排班信息:</label>
    <!--不支持修改日期会是比较合理-->
    <label>日期： </label><?php echo $records[0]->date; ?>
    <?php echo form_open("duty_controller/update_duty"); ?>
    <label>状态： </label>
    <?php
    for ($i = 0; $i < 3; $i++) {
//        $data_array[] = array(
//            'name' => "status_group",
//            'id' => "status_group",
//            'value' => $i,
//            'checked' => ($i === $records[0]->status),
//        );
        echo form_radio(array(
            'name' => "status_group",
            'id' => "status_group",
            'value' => $i,
            'checked' => (strval($i) === $records[0]->status),
        ));
        switch ($i) {
            case '0':
                echo "休息";
                break;
            case '2':
                echo "约满";
                break;
            default:
                echo "出诊";
        }
    }
    ?>
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
                <?php
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_1);
                echo "</td>";
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_2);
                echo "</td>";
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_3);
                echo "</td>";
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_4);
                echo "</td>";
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_5);
                echo "</td>";
                echo "<td>";
                echo form_input("time_slot[]", $records[0]->time_slot_6);
                echo "</td>";
                ?>
            </tr>
        </tbody>
    </table>
    <?php
    echo form_hidden("date", $records[0]->date);
    echo form_submit("confirm", "Confirm");
    echo form_submit("decline", "Decline");
    echo form_close();
    ?>
</body>
</html>

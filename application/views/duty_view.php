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
        <a href="<?php echo base_url() ?>index.php/user">用户信息</a>
        <a href="<?php echo base_url() ?>index.php/city">城市列表</a>
        <a href="<?php echo base_url() ?>index.php/hospital">医院列表</a>
        <!--<a href="<?//php echo base_url() ?>index.php/duty">工作安排</a>-->
        <a href="<?php echo base_url() ?>index.php/order">订单预览</a>
        <br/>
        <a href="<?php echo base_url() ?>index.php/duty_add">添加排班</a>
        <table border="1">
            <thead>
                <tr>
                    <th>医生姓名</th>
                    <th>日期</th>
                    <th>当日状态</th>
                    <th>9:00-10:00</th>
                    <th>10:00-11:00</th>
                    <th>11:00-12:00</th>
                    <th>14:00-15:00</th>
                    <th>15:00-16:00</th>
                    <th>16:00-休息</th>
                    <th>执行操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($records as $row) {
                    switch ($row->status) {
                        case 0:
                            $current_status = '休诊';
                            break;
                        case 1:
                            $current_status = '出诊';
                            break;
                        case 2:
                            $current_status = '已满';
                            break;
                        default:
                            $current_status = '出诊';
                            break;
                    }
                    echo "<tr>";
                    echo "<td>" . $row->doctor_name . "</td>";
                    echo "<td>" . $row->date . "</td>";
                    echo "<td>" . $current_status . "</td>";
                    echo "<td>" . $row->time_slot_1 . "</td>";
                    echo "<td>" . $row->time_slot_2 . "</td>";
                    echo "<td>" . $row->time_slot_3 . "</td>";
                    echo "<td>" . $row->time_slot_4 . "</td>";
                    echo "<td>" . $row->time_slot_5 . "</td>";
                    echo "<td>" . $row->time_slot_6 . "</td>";
                    echo "<td>";
//                    echo "<a href='".base_url()."/index.php/duty_delete/".$row->doctor_id."/".$row->doctor_name."/".$row->date."'>删除 </a>";
//                    echo "<a href='".base_url()."/index.php/duty_update/".$row->doctor_id."/".$row->doctor_name."/".$row->date."'>修改 </a>";
                    echo "<a href='" . base_url() . "/index.php/duty_delete/" . $row->date . "'>删除 </a>";
                    echo "<a href='" . base_url() . "/index.php/duty_update/" . $row->date . "'>修改 </a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>

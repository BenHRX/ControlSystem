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
        <a href="<?php echo base_url() ?>index.php/duty">工作安排</a>
        <!--<a href="<?//php echo base_url() ?>index.php/order">订单预览</a>-->
        <table border="1">
            <thead>
                <tr>
                    <th>订单编号</th>
                    <th>顾客姓名</th>
                    <th>联系电话</th>
                    <th>服务医生</th>
                    <th>预约日期</th>
                    <th>预约时间</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($records as $row) {
                    switch ($row->time_slot) {
                        case 1:
                            $period = "9:00 - 10:00";
                            break;
                        case 2:
                            $period = "10:00 - 11:00";
                            break;
                        case 3:
                            $period = "11:00 - 12:00";
                            break;
                        case 4:
                            $period = "14:00 - 15:00";
                            break;
                        case 5:
                            $period = "15:00 - 16:00";
                            break;
                        case 6:
                            $period = "16:00 - 休息";
                            break;
                        default:
                            break;
                    }
                    switch ($row->order_status) {
                        case 0:
                            $status = "未付款";
                            break;
                        case 1:
                            $status = "已付款";
                            break;
                        default:
                            break;
                    }
                    echo "<tr>";
                    echo "<td>" . $row->order_id . "</td>";
                    echo "<td>" . $row->customer_name . "</td>";
                    echo "<td>" . $row->contact_phone . "</td>";
                    echo "<td>" . $row->doctor_name . "</td>";
                    echo "<td>" . $row->date . "</td>";
                    echo "<td>" . $period . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "<td><input type='hidden' value='" . $row->user_id . "'/> <input type='hidden' value='" . $row->doctor_id . "'/>修改 删除 </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Control System - Doctor Information</title>
    </head>
    <body>
        <!--<a href="<?//php echo base_url() ?>index.php/user">用户信息</a>-->
        <a href="<?php echo base_url() ?>index.php/city">城市列表</a>
        <a href="<?php echo base_url() ?>index.php/hospital">医院列表</a>
        <a href="<?php echo base_url() ?>index.php/duty">工作安排</a>
        <a href="<?php echo base_url() ?>index.php/order">订单预览</a>
        <table border="1">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>用户名称</th>
                    <th>权限</th>
                    <th>姓名</th>
                    <th>医院</th>
                    <th>部门</th>
                    <th>专业领域</th>
                    <th>自我描述</th>
                    <th>控制选项</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_level = $this->session->userdata("access_right");
                if ($user_level === "9") {
                    echo "<br/>";
                    echo "<a href='" . base_url() . "index.php/user_add/'>增加用户</a>";
                }
                foreach ($records as $row) {
                    echo "<tr>";
                    echo "<td>" . $row->user_id . "</td>";
                    echo "<td>" . $row->user_name . "</td>";
                    echo "<td>" . $row->user_access . "</td>";
                    echo "<td>" . $row->name . "</td>";
                    echo "<td>" . $row->hospital . "</td>";
                    echo "<td>" . $row->department . "</td>";
                    echo "<td>" . $row->major . "</td>";
                    echo "<td>" . $row->description . "</td>";
                    if ($user_level === "9") {
                        echo "<td> <a href='" . base_url() . "index.php/user_update/" . $row->user_id . "'>修改</a> <a href='" .
                        base_url() . "index.php/user_delete/" . $row->user_id . "'>删除</a>" . "</td>";
                    } else {
                        echo "<td> <a href='" . base_url() . "index.php/user_update/" . $row->user_id . "'>修改</a></td>";
                    }
//                        echo "<td> <a href='".base_url()."index.php/user_update/".$row->user_id."'>修改</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // put your code here
        ?>
    </body>
</html>

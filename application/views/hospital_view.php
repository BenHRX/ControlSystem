<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>医院以及部门列表</title>
    </head>
    <body>
        <a href="<?php echo base_url() ?>index.php/user">用户信息</a>
        <a href="<?php echo base_url() ?>index.php/city">城市列表</a>
        <!--<a href="<?//php echo base_url() ?>index.php/hospital">医院列表</a>-->
        <a href="<?php echo base_url() ?>index.php/duty">工作安排</a>
        <a href="<?php echo base_url() ?>index.php/order">订单预览</a>
        <table border="1">
            <thead>
                <tr>
                    <th>医院名称</th>
                    <th>部门名称</th>
                    <th>所处城市</th>
                    <th>医院地址</th>
                    <th>医院简介</th>
                    <th>部门简介</th>
                    <th>操作列表</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($records as $row){
                    echo "<tr>";
                    echo "<td>".$row->name."</td>";
                    echo "<td>".$row->depart."</td>";
                    echo "<td>".$row->city."</td>";
                    echo "<td>".$row->address."</td>";
                    echo "<td>".$row->hospital_summary."</td>";
                    echo "<td>".$row->department_summary."</td>";
                    echo "<td>删除 修改</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>

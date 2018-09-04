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
        <!--<a href="<?//php echo base_url() ?>index.php/city">城市列表</a>-->
        <a href="<?php echo base_url() ?>index.php/hospital">医院列表</a>
        <a href="<?php echo base_url() ?>index.php/duty">工作安排</a>
        <a href="<?php echo base_url() ?>index.php/order">订单预览</a>
        <br/>
        <a href="<?php echo base_url() ?>index.php/city_add">增加城市</a>
        <table border="1">
            <thead>
                <tr>
                    <th>城市名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($cities as $c){
                    echo "<tr>";
                    echo "<td>".$c->name."</td>";
                    echo "<td> <a href='".base_url()."/index.php/city_update/".$c->name."'>修改</a> <a href='". base_url()."/index.php/city_delete/".$c->name."'>删除</a> </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>

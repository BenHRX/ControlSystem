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
                </tr>
            </thead>
            <tbody>
                    <?php
                    foreach($records as $row){
                        echo "<tr>";
                        echo "<td>".$row->user_id."</td>";
                        echo "<td>".$row->user_name."</td>";
                        echo "<td>".$row->user_access."</td>";
                        echo "<td>".$row->name."</td>";
                        echo "<td>".$row->hospital."</td>";
                        echo "<td>".$row->department."</td>";
                        echo "<td>".$row->major."</td>";
                        echo "<td>".$row->description."</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
        <?php
        echo form_open('user_controller/delete_user');
        echo "<br/>";
        echo form_hidden('user_id', $records[0]->user_id);
        echo form_submit(array('id' => 'submit', 'name' => 'delete', 'value' => 'Delete'));
        echo form_submit(array('id' => 'give_up', 'name' => 'cancel', 'value' => 'Cancel'));
        echo form_close();
        ?>
    </body>
</html>

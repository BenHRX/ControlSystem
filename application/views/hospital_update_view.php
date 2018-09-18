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
        <label>请输入修改信息</label>
        <table border="1">
            <thead>
                <tr>
                    <th>医院名称</th>
                    <th>部门名称</th>
                    <th>所处城市</th>
                    <th>医院地址</th>
                    <th>医院简介</th>
                    <th>部门简介</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // The hospital name should be only one.
                $hospital_name = $records[0]->name;
                foreach ($records as $row) {
                    echo "<tr>";
                    echo "<td>" . form_input($row->name, 'TestInput') . "</td>";
                    echo "<td>" . $row->depart . "</td>";
                    echo "<td>" . $row->city . "</td>";
                    echo "<td>" . $row->address . "</td>";
                    echo "<td>" . $row->hospital_summary . "</td>";
                    echo "<td>" . $row->department_summary . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        echo form_open("hospital_controller/delete_hospital");
        echo form_hidden("hospital_name", $hospital_name);
        echo form_submit("accept", "Accept");
        echo form_submit("decline", "Decline");
        echo form_close();
        ?>
    </body>
</html>

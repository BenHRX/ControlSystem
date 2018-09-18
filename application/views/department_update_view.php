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
        <label>输入修改以下信息</label>
        <?php         echo form_open("hospital_controller/update_department"); ?>
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
                // This should be one record accept
//                foreach ($records as $row) {
//                var_dump($record);
                    echo "<tr>";
                    echo "<td>" . $record[0]->name . "</td>";
                    echo "<td>" . form_input("new_department",$record[0]->depart) . "</td>";
                    echo "<td>" . $record[0]->city . "</td>";
                    echo "<td>" . $record[0]->address . "</td>";
                    echo "<td>" . $record[0]->hospital_summary . "</td>";
                    $attr = array(
                        'name' => 'new_depart_summary',
                        'value' => $record[0]->department_summary,
                        'rows' => '1',
                        'cols' => '40',
                    );
                    echo "<td>" . form_textarea($attr) . "</td>";
//                    echo "<td>" . form_textarea("new_depart_summary", $record[0]->department_summary, 'rows="1",cols="20"') . "</td>";
                    echo "</tr>";
//                }
                ?>
            </tbody>
        </table>
        <?php
        echo form_hidden('old_department_name', $record[0]->depart);
        echo form_hidden("hospital_name", $record[0]->name);
        echo form_submit("accept", "Accept");
        echo form_submit("decline", "Decline");
        echo form_close();
        ?>
    </body>
</html>

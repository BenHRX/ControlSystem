<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>用户维护页</title>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>
        <script>
            var baseUrl = "<?php echo base_url() ?>index.php/";
            $(document).ready(function () {
                $('#hospital_choose').change(function () {
                    var hospital_name = $(this).val();
                    $.ajax({
                        url: baseUrl + "department_by_hospital",
                        method: "post",
                        data: {hospital: hospital_name},
                        dataType: "json",
                        success: function (response) {
                            var len = response.length;
                            // 添加解锁隔壁select的动作
                            if (len > 0) {
                                console.log(response);
                                $('#department_choose').empty(); // 清空数据
                                for (var row in response) {
                                    $('#department_choose').append($("<option>" + response[row]['department'] + "</option>"));
                                }
//                                $('#department_choose').attr("disabled", false);
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php echo form_open('user_controller/update_user'); ?>
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
                // Expect only one user can be list here, better use $records[0].
//                foreach ($records as $row) {
//                    echo "<tr>";
//                    echo "<td>" . $row->user_id . "</td>";
//                    echo "<td>" . $row->user_name . "</td>";
//                    echo "<td>" . $row->user_access . "</td>";
//                    echo "<td>" . form_input('new_real_name', $row->name) . "</td>";
//                    echo "<td>" . $row->hospital . "</td>";
//                    echo "<td>" . $row->department . "</td>";
//                    echo "<td>" . form_input('new_major', $row->name) . "</td>";
//                    echo "<td>" . form_input('new_description', $row->description) . "</td>";
//                    echo "</tr>";
//                }
                echo "<tr>";
                echo "<td>" . $records[0]->user_id . "</td>";
                echo "<td>" . $records[0]->user_name . "</td>";
                echo "<td>" . $records[0]->user_access . "</td>";
                echo "<td>" . form_input('new_real_name', $records[0]->name) . "</td>";
                echo "<td>";
                $options = array();
                foreach($hospitals as $h){
                    $options[$h['name']] = $h['name'];
                }
                echo form_dropdown('hospital_list', $options, $records[0]->hospital, array('id'=>'hospital_choose'));
//                echo $records[0]->hospital; 
                echo "</td>";
                echo "<td>"; 
                $department_list = array();
                foreach ($departments as $d) {
                    $department_list[] = $d['department'];
                }
//                echo form_dropdown('department_list', array($records[0]->department), $records[0]->department, array('id'=>'department_choose', 'disabled'=>'true'));
                echo form_dropdown('department_list', $department_list, $records[0]->department, array('id'=>'department_choose'));
                echo "</td>";
                echo "<td>" . form_input('new_major', $records[0]->major) . "</td>";
                echo "<td>" . form_input('new_description', $records[0]->description) . "</td>";
                echo "</tr>";
                ?>
            </tbody>
        </table>
        <?php
        echo "<br/>";
        $hints_str = "Please input user '" . $this->session->userdata('user') . "' password before submit the form:";
        echo form_label($hints_str);
        echo "<br/>";
        echo form_password("confirm_pwd");
        echo "<br/>";
        echo form_hidden('user_id', $records[0]->user_id);
        echo form_submit(array('id' => 'submit', 'name' => 'update', 'value' => 'Update'));
        echo form_submit(array('id' => 'give_up', 'name' => 'cancel', 'value' => 'Cancel'));
        echo form_close();
        ?>
        <?php echo validation_errors(); // Seems it is a string ?>
    </body>
</html>

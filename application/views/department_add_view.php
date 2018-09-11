<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>医院部门维护页面</title>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <script>
            var baseUrl = "<?php echo base_url() ?>index.php/";
            $(document).ready(function () {
                $('#city_choose').change(function () {
                    var city_option = $(this).val();
                    console.log("whether I can be here?");
                    $.ajax({
                        url: baseUrl + "hospital_by_city",
                        method: "post",
                        data: {city: city_option},
                        dataType: "json",
                        success: function (response) {
                            var len = response.length;
                            // 添加解锁隔壁select的动作
                            if (len > 0) {
                                console.log(response);
                                $('#hospital').empty(); // 清空数据
                                for (var row in response) {
                                    $('#hospital').append($("<option>" + response[row]['name'] + "</option>"));
                                }
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php echo form_open("hospital_controller/add_department", "id='department_add_form'") ?>
        <label>所处城市:</label>
        <select name="city_choose" id="city_choose">
            <?php
            foreach ($cities as $c) {
                if ($c->name === $selected_city->name) {
                    echo "<option selected='true'>" . $c->name . "</option>";
                } else {
                    echo "<option>" . $c->name . "</option>";
                }
            }
            ?>
        </select>
        <label>医院名称:</label>
        <select name="hospital_name" id="hospital">
            <?php
            foreach ($hospitals as $h) {
                if ($h['name'] === $selected_hospital['name']) {
                    echo "<option selected='true'>" . $h['name'] . "</option>";
                } else {
                    echo "<option>" . $h['name'] . "</option>";
                }
            }
            ?>
        </select>
        <label>科室名称:</label><input type="text" name="department_name" value="" />
        <label>描述:</label><textarea name="description" rows="3" cols="20">暂无介绍</textarea>
        <input type="submit" name="add" value="Add" />
        <input type="submit" name="decline" value="Decline" />
        <?php echo form_close() ?>
    </body>
</html>

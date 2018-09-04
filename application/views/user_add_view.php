<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>添加用户</title>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

        <script>
            var baseUrl = "<?php echo base_url() ?>index.php/"
            $(document).ready(function () {
                $('#city_section').change(function () {
                    var city_option = $(this).val();
//                    alert("at least let me know u can run to here" + city_option + baseUrl);
                    if (city_option !== '') {
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
                                    $('#department').empty();
                                    $('#department').attr("disabled", true);
                                    $('#hospital').empty();   // 清空数据
                                    $('#hospital').append($("<option> </option>"));
                                    for (var row in response) {
                                        $('#hospital').append($("<option>" + response[row]['name'] + "</option>"));
                                    }
                                    $('#hospital').attr("disabled", false);
                                }
                            }
                        });
                    }
                });

                $('#hospital').change(function () {
                    var hospital_option = $(this).val();
//                    alert("at least let me know u can run to here" + hospital_option + baseUrl);
                    if (hospital_option !== '') {
                        $.ajax({
                            url: baseUrl + "department_by_hospital",
                            method: "post",
                            data: {hospital: hospital_option},
                            dataType: "json",
                            success: function (response) {
                                var len = response.length;
                                // 添加解锁隔壁select的动作
                                console.log(response);
                                if (len > 0) {
                                    $('#department').empty();
                                    $('#department').append($("<option> </option>"));
                                    for (var row in response) {
                                        $('#department').append($("<option>" + response[row]['department'] + "</option>"));
                                    }
                                    $('#department').attr("disabled", false);
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            function add_user_check() {
                var canSubmit = true;
                $("#user_add_form .required").each(function () {
                    var thisValue = this.value;
                    if (!thisValue) {
                        console.log("No value id " + this.id);
                        canSubmit = false;
                    }
                    console.log("Get the value " + this.value + " Hope get ID " + this.id);
                });
                if (canSubmit) {
                    $("#user_add_form").append($("<input type='hidden' name='confirm' value='Confirm'/>"));
                    $('#user_add_form').submit();
                }
            }
        </script>
    </head>
    <body>
        <?php
        echo form_open("user_controller/add_user", "id='user_add_form'");
        ?>
        <!--<form id="user_add_form" method="POST" enctype="multipart/form-data" action="user_controller/add_user">-->
        <label>用户名称:</label><input id="user_name" class="required" type="text" name="user_name" value="" />
        <label>用户密码:</label><input id="user_password" class="required" type="password" name="user_password" value="" />
        <label>用户权限:</label><input id="user_access" class="required" type="text" name="user_access" value="0" size="1" />
        <label>医生姓名:</label><input id="real_name" class="required" type="text" name="name" value="" />
        <label>所处地区:</label><select id="city_section" class="required" name="city">
            <option> </option>
            <?php
            foreach ($cities as $c) {
                echo "<option>" . $c->name . "</option>";
            }
            ?>
        </select>
        <label>所属医院:</label><select id="hospital" class="required" name="hospital" disabled="disabled">
            <option> </option>
        </select>
        <!--use ajax to get the value-->
        <label>所属科室:</label><select id="department" class="required" name="department" disabled="disabled">
        </select>
        <label>擅长专业:</label><input id="major" type="text" name="major" value="" />
        <label>个人描述:</label><textarea id="description" class="required" name="description" rows="3" cols="60">
这个人很懒,什么都没有留下.
        </textarea>
        <input type="button" value="Confirm" name="confirm" onclick="add_user_check()"/>
        <input type="submit" value="Decline" name="decline" />
        <input type="reset" value="Reset" name="reset" />
        <!--</form>-->
        <?php
        echo form_close();
        ?>

    </body>
</html>

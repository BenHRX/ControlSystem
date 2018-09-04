<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Control System Login</title>
    </head>
    <body>
        <?php
        echo form_open('user_controller/user_login_check');
        echo form_label('User name: ');
        echo form_input(array('id' => 'user_name', 'name' => 'user_name'));
        echo "<br/>";

        echo form_label('Password: ');
        echo form_input(array('id' => 'user_pwd', 'name' => 'user_pwd'));
        echo "<br/>";

        echo form_submit(array('id' => 'submit', 'value' => 'Login'));
        echo form_reset(array('id' => 'reset', 'value' => 'Reset'));
        echo form_close();
        
        if(isset($error) && $error == 'Access Denied'){
            echo "<br/>";
            echo "Access Denied";
        }
        ?>
    </body>
</html>

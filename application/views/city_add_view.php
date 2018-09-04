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
        <?php 
            echo form_open('city_controller/add_city'); 
            echo form_label('城市名称: '); 
            echo form_input(array('id'=>'city_name',
               'name'=>'city_name')); 
            echo "<br/>"; 

            echo form_submit(array('id'=>'submit','value'=>'Add'));
            echo form_close();
         ?>
    </body>
</html>

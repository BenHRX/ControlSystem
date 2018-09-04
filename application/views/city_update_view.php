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
            echo form_open('city_controller/update_city'); 
            echo form_hidden('old_city_name',$cities[0]->name); 
            echo form_label('城市名称: '); 
            echo form_input(array('id'=>'city_name',
               'name'=>'city_name','value'=>$cities[0]->name)); 
            echo "<br/>"; 

            echo form_submit(array('id'=>'submit','value'=>'Edit'));
            echo form_close();
         ?>
    </body>
</html>

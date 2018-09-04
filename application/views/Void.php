<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dummy Page</title>
    </head>
    <body>
        <?php
        session_start();
        echo "Now in the dummy page for testing!";
//        $incomeGet = var_dump($_GET);
//        $inComePost = var_dump($_POST);
//        $inComeSession = var_dump($_SESSION);
//        $inComeCookies = var_dump($_COOKIE);
        ?>
        <table border="2" cellspacing="1" cellpadding="2">
            <thead>
                <tr>
                    <th>进入参数信息</th>
                    <th>对应数值</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo "<tr><td>Get Info</td><td>";
                var_dump($_GET);
                echo "</td></tr>";
                echo "<tr><td>Post Info</td><td>";
                var_dump($_POST);
                echo "</td></tr>";
                echo "<tr><td>Session Info</td><td>";
                var_dump($_SESSION);
                echo "</td></tr>";
                echo "<tr><td>Cookies Info</td><td>";
                var_dump($_COOKIE);
                echo "</td></tr>";
                echo "<tr><td>Server Info</td><td>";
                var_dump($_SERVER);
                echo "</td></tr>";
                ?>
            </tbody>
        </table>
        <?php
        $inComeWebPage = filter_input(INPUT_SERVER, 'HTTP_REFERER');
//        $inComeWebPage = $_SERVER['HTTP_REFERER'];
        echo "<p>$inComeWebPage</p>";
        ?>
<!--        <SCRIPT language=javascript>
            function backToUpperPage()
            {  // 错误模拟
//                window.history.go(-1);
                var redirectUrl = "<?php // echo "$inComeWebPage" . "?errorno=1" ?>";
//                alert(abc);
//                window.navigator("http://localhost/ManagerSystem/");
                window.location.href=redirectUrl;
//                self.location = "http://localhost/ManagerSystem/";
            }
        </SCRIPT>
        <text style="background-color: buttonface; font-family: Microsoft-Yahei; font-size: 20px; margin-top: 40px; padding-left: 80px; padding-right: 80px;" onclick="backToUpperPage()">点击返回</text>-->
    </body>
</html>

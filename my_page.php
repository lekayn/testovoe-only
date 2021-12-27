<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Авторизация</title>
        <link rel="stylesheet" href="styles/auth.css">
    </head>
    <body>
                <!-- Вывод успеха авторизации  -->
        <div>
            <?php 
            if(isset($_SESSION['successMsg'])){
                echo '<h2>'.$_SESSION['successMsg'].'</h2>';
            }
            unset($_SESSION['successMsg']);
            ?> 
            <br>
            <p align="center"><a href ="auth.php" >Войти в другой аккаунт</a></p>
        </div>
    </body>
</html>



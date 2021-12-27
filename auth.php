<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Авторизация</title>
        <link rel="stylesheet" href="styles/auth.css">
    </head>
    <body>
        <form action="php/signin.php" method="POST">
            <h2 align="center">Авторизация</h2>
            <p><input type="text" name="email" placeholder="Эл.почта" required/></p>
            <p><input type="password" name="password" placeholder="Пароль" required/></p>
            <p><input type="submit" value="Войти" class="AllBtn"></p>
            <p align="center"><a href ="register.php" >Регистрация</a></p>
                <!-- Вывод ошибок авторизации и успеха -->
            <?php 
            if(isset($_SESSION['errorMsg'])){
                echo '<p class ="Msg">'.$_SESSION['errorMsg'].'</p>';
            }
            if(isset($_SESSION['successMsg'])){
                echo '<p class ="Msg">'.$_SESSION['successMsg'].'</p>';
            }
            unset($_SESSION['errorMsg']);
            unset($_SESSION['successMsg']);
            ?> 
        </form>

    </body>
</html>



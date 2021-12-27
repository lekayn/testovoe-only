<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Регистрация</title>
        <link rel="stylesheet" href="styles/auth.css">
    </head>
    <body>
        <form action="php/signup.php" method="POST">
            <h2 align="center">Регистрация</h2>
            <p>Имя<input type="text" name="name" placeholder="Введите Ваше имя" required/></p>
            <p>Эл.почта<input type="text" name="email" placeholder="Введите эл.почту" required/></p>
            <p>Пароль<input type="password" name="password" placeholder="Придумайте пароль" required/></p>
            <p><input type="password" name="passwordConfirm" placeholder="Подтвердите пароль" required/></p>
            <p><input type="submit" value="Зарегистрироваться" class="AllBtn"></p>
            <p>Уже зарегистрированы? <a href="auth.php">Войти</a></p>

                    <!-- Обработка ошибок регистрации -->
            <?php 
            if(isset($_SESSION['errorMsg'])){
                echo '<p class ="Msg">'.$_SESSION['errorMsg'].'</p>';
            }
            unset($_SESSION['errorMsg']);
            ?>   
        </form>
    </body>
</html>
<?php 

function connectDB(){
    //устанавливаем соединение с БД
    $link = mysqli_connect("localhost", "root", "1", "my_company");
    if ($link === false){
        return; //Ошибка: Невозможно подключиться к MySQL!
    }
    //cоединение установлено успешно
    mysqli_set_charset($link, "utf8");
    return $link;
}
function checkEmailExists($email){
    //соединяемся с БД
    $link = connectDB();
    if($link === null){
        return -1; //ошибка соединения с БД
    }

    //экранируем принятый логин перед SQL запросом
    $tempEmail = mysqli_real_escape_string($link, $email);
    $emailExistsSQL = "SELECT * FROM users WHERE email = '$tempEmail'";
    $result = mysqli_query($link, $emailExistsSQL);
    if(mysqli_num_rows($result) > 0){
        mysqli_close($link);
        return 1; //Данный логин существует, занят
    } else {
        mysqli_close($link); 
        return 0; //Данный логин не занят
    }
}

function authUser($email, $password){
    //соединяемся с БД
    $link = connectDB();
    if($link === null){
        return false;
    }
    //экранируем принятые логин и пароль перед запросом на авторизацию к БД
    $tempEmail = mysqli_real_escape_string($link, $email);
    $tempPass = md5(mysqli_real_escape_string($link, $password));

    //делаем запрос к БД на наличие такого пользователя и пароля 
    $sql = "SELECT * FROM users WHERE email = '$tempEmail' AND password ='$tempPass'";
    $result = mysqli_query($link, $sql);

    //"Не получилось сделать запрос к БД!" 
    if(!$result){
        return "Ошибка входа.";  
    }     

    //Неправильный логин/пароль
    if(mysqli_num_rows($result) <= 0){
        return "Неверный логин/пароль"; 
    }

    //логин пароль верны - разрешаем авторизацию пользователя
    else{          
        //закрываем sql соединение
        mysqli_close($link);
        return "Ок";
    }
}

function addUser($email, $password, $name){
    //соединяемся с БД
    $link = connectDB();
    if(!$link){
        return false;
    }

    //экранируем пользовательские данные и шифруем пароль пользователя
    $tempEmail = mysqli_real_escape_string($link, $email);
    $tempPass = md5(mysqli_real_escape_string($link, $password));
    $tempName = mysqli_real_escape_string($link, $name);

    //записываем пользователя в БД
    $addUserSQL = "INSERT INTO users(email, name, password) 
    VALUES ('$tempEmail', '$tempName', '$tempPass')";
    $result = mysqli_query($link, $addUserSQL);

    //не удалось зарегистрировать пользователя, ошибка MySQL
    if(!$result){
        mysqli_close($link);
        return false;
    }
    //успешная регистрация
    else{
        return true;
    }
}
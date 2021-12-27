<?php 
session_start();

//принимаем переданные регистрационные данные 
$tempName =  $_POST['name'];
$tempEmail = $_POST['email'];
$tempPass = $_POST['password'];
$tempConfirmPass = $_POST['passwordConfirm'];

//проверяем правильность введенных данных, сообщаем об ошибках
require_once "check_correct_data.php";
$checkError = checkRegData($tempEmail, $tempPass, $tempConfirmPass, $tempName);
if($checkError !== "Ок") {
    $_SESSION['errorMsg'] = $checkError;  
    header('Location: ../register.php'); 
    exit();
 }
else{
    //регистрация пользователя
    //добавляем пользователя в БД
    require_once "db_connection.php";    
    if(!addUser($tempEmail, $tempPass, $tempName)){
        //ошибка регистрации - оповещаем и перенаправляем на страницу регистрации
        $_SESSION['errorMsg'] = "Не удалось добавить пользователя в БД.";  
        header('Location: ../register.php'); 
        exit();
    }
    //успешная регистрация 
    else{
        $_SESSION['successMsg'] = "Вы успешно зарегистрировались!";  
        header('Location: ../auth.php'); 
        exit();
    }
}
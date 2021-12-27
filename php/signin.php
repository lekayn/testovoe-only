<?php 
session_start();

//принимаем переданные логин и пароль 
$tempEmail = $_POST['email'];
$tempPass = $_POST['password'];

// print_r($tempEmail. " ". $tempPass);
   
//получаем разрешение на авторизацию
require_once "db_connection.php";
$authPermission = authUser($tempEmail, $tempPass);

//разрешение не получено, сообщаем об этом
if($authPermission !== "Ок"){
    $_SESSION['errorMsg'] = $authPermission;  
    header('Location: ../auth.php'); 
    exit(); 
}  
//авторизация разрешена
else{ 
    // перенаправляем пользователя на его личную страничку
    $_SESSION['successMsg'] = "Поздравляем, Вы успешно авторизовались!!!";  
    header('Location: ../my_page.php'); 
    exit(); 
} 
?>
<?php function checkRegData($email, $password, $confirmPassword, $name){
    //не совпадают пароли
    if($password!== $confirmPassword) {
        return "Пароли не совпадают.";  
    }
    //Некорректный емейл
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){    
        return "Некорректный email.";  
    }
    //короткое имя
    if(strlen($name) < 2){    
        return "Короткое имя.";  
    }
    //длинное имя
    if(strlen($name) > 30){    
        return "Длинное имя.";  
    }
    //существующий пользователь 
    require_once "db_connection.php";
    $errorEmailExists = checkEmailExists($email);
    if($errorEmailExists === -1){
        return "Ошибка проверки данных.";  
    }
    else if($errorEmailExists === 1 ){
        return "Логин занят.";
    }
    //всё ок
    else { return "Ок"; }
}

?>
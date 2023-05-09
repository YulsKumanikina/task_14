<?php 

$timeLeft;




function getUsersList(){
    $json = file_get_contents(__DIR__ . '/array.json');
    $users = json_decode($json, true);
    return $users;
}

 
function  existsUser($email):bool {
    $users=getUsersList();
    foreach ($users as $user) {
        if ( $user['email']=== $email) {
            echo 'такой пользователь существует!';
            return true;
        }
    }
        return false;
        
}


function  checkPassword($email, $password):bool {
    $users= getUsersList();////?
    if (existsUser($email)){
        foreach ($users as $user) {
            if ( $user['email']=== $email
            && password_verify($password,$user['password'])){
                setcookie('mail',$user['email'], 0, '/');
                setcookie('password',$user ['password'], 0, '/');
                setcookie('login',$user ['login'], 0, '/');
                setcookie('bthday',$user ['bthday'], 0, '/');
                return true;
            }
        }
        echo 'Введен неправильный пароль';
        return false;
    }
    else {

        return false;
    }


}


function getCurrentUser(){
    if (isset($_COOKIE['login']))
    return  $_COOKIE['login'];
    else return null;

}

//регистрация  нового клиента  
function addNewKlient($email) {

    if (!existsUser($email)){
    $users = getUsersList();
    $hash =password_hash ($_POST['password'], PASSWORD_BCRYPT);
    $_POST['password']=$hash ;
    $users[]=$_POST;
    $json = json_encode($users, JSON_UNESCAPED_UNICODE);
    file_put_contents(__DIR__ . '/array.json', $json);
    setcookie('mail',$_POST['email'], 0, '/');
    setcookie('password',$_POST['password'], 0, '/');
    setcookie('login',$_POST['login'], 0, '/');
    setcookie('bthday',$_POST['bthday'], 0, '/');
    header('Location: /index.php');
  //      echo 'новый зарегистрированный пользователь';
//        print_r($users);
    }
}




function newAktion(){

    if(isset($_COOKIE['timePromotion'])){

        return $timeToEndProm=86400 - (time() - $_COOKIE['timePromotion']);
    }
    
}


function datesToBirthday(){
$currYear =date('y');
$birthDay=strtotime($_COOKIE['bthday']);
$currYearBirthDay=strtotime($currYear.date('-m-d',$birthDay));
$interval=floor((time()-$currYearBirthDay)/86400);
if ($interval>0) return ((date('L') ? 366 : 365)-$interval);
if ($interval<0) return abs($interval);
else return $interval;

}


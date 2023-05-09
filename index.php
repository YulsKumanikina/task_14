<?php
require __DIR__.'/functions.php';
$login=getCurrentUser();
$timeLeft='';
$actionText='';
$birthDayText='';
$days='';
if ($login){
    $actionText='До конца персональной скидки осталось  ' ;
    $birthDayText='Ваш день рождения через';
    $timeLeft = (newAktion()==86400) ? '24:00:00' : gmdate('H:i:s ',newAktion());
    if (datesToBirthday()==0){
        $birthDayText="С Днем Рождения!"."<br>"."Только сегодня скидка"."<br>"." в 5%"."<br>"." на все услуги салона!";
        $datsNumber=' ';
        $days='';
    }
    else $days=datesToBirthday().' д.';
}
?>

<!DOCTYPE HTML>
<html lang="ru">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>SPA-salon</title>
</head> 
  <main>
    <div class="main" class="section">
        <h1>SPA-salon</h1>
        <section class="service">
            <a class="menu">О нас</a>
            <a class="menu">Услуги</a>
            <a class="menu">Контакты</a>
            <a class="button" href="login.php">Авторизуйтесь</a>
            <ul>
                <li><a>Общий оздоровительный массаж</a></li>
                <li><a>Уходовые процедуры и SPA</a></li>
                <li><a>Детокс-программа</a></li>
                <li><a>Курс для идеальной фигуры</a></li>
            </ul>   
            <div class="birthday">
                <a><?=$birthDayText?></a></br>
                <div><?= $days?></div>
            </div>
        </section>
        
        <div class="container ">
            <section class="action">
                <a class="h1">Акции</a></br>
            </section>
            <section class="action spec">
                <div class="spec">
                    <a class="h2"><?= $actionText ?><span><?= $timeLeft ?></span></a></br>
                </div>
            </section>
        </div>

        <div class="container">
            <section class="galereya">
                <h3>Расслабляющая программа</h3>
                <img src="img\pic1.jpg">
            </section>
            <section class="galereya">
                <h3>Уходовые процедуры и SPA</h3>
                <img src="img\pic4.jpg">
            </section>
            <section class="galereya">
                <h3>Антицеллюлитный массаж</h3>
                <img src="img\pic2.jpg">
            </section>
        </div>
    </div>
</main>
</body>
</html>










    
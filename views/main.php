<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>


<?php if(!empty($_SESSION['logged_in'])):?>
    <a href="http://registration/logout/logout?login=<?php echo $_SESSION['logged_in'];?>">Выход</a>
    <a href="http://registration/profile/show?login=<?php echo $_SESSION['logged_in'];?>">Профиль</a>
<?php else:?>
    <a href="http://registration/registration/show">Регистрация</a>
    <a href="http://registration/login/show">Вход</a>
<?php endif;?>

</body>
</html>

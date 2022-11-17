<?php
session_start();
include 'header.php';
if(isset($_GET['error'])){
if(strval($_GET['error']) =="emptyIput"){
    ?><div class="red"><?php
    echo "Langai negali būti tušti";
    ?></div>
    <?php 
}
if(strval($_GET['error']) =="InvalidEmail"){
    ?><div class="red"><?php
    echo "El.pastas yra neteisingas arba uzimtas";
    ?></div>
    <?php 
}
if(strval($_GET['error']) =="PasswordWrong"){
    ?><div class="red"><?php
    echo "Blogas slaptazodis";
    ?></div>
    <?php 
}
if(strval($_GET['error']) =="PasswordDontMatch"){
    ?><div class="red"><?php
    echo "Slaptažodis nesutampa";
    ?></div>
    <?php 
}
if(strval($_GET['error']) =="UserNameTaken"){
    ?><div class="red"><?php
    echo "Vartotojo vardas yra uzimtas";
    ?></div>
    <?php 
}
}
?>
<?php
if(isset($_SESSION["userid"]))
{
    header("location: ../");
}

?>
<head>
<link rel="stylesheet" href="../style/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Titillium+Web:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<section class="login_section">
    <div class="view_wrap right form long">
        <p class="title">REGISTRACIJA</p>
        <form class="register" action="includes/signup.php" method="post">
            <label>Prisijungimo vardas</label>
            <input type="text" name="uid">
            <br>
            <br>
            <label>Vardas</label>
            <input type="text" name="uin">
            <br>
            <br>
            <label>Pavardė</label>
            <input type="text" name="uiln">
            <br>
            <br>
            <label>El. paštas</label>
            <input type="email" name="email">
            <br>
            <br>
            <label>Slaptažodis</label>
            <input type="password" name="pwd" >
            <br>
            <br>
            <label>Slaptažodžio pakartojimas</label>
            <input type="password" name="pwd2">
            
            <button class="btn blue" type="submit" name="submit">Registruotis</button>
        </form>
        </div>
    </div>
</section>
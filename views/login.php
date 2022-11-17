<?php
session_start();
include 'header.php';
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
    <div class="view_wrap center form">
        <div class="login">
            <p class="title">PRISIJUNGIMAS</p>
            <form action="../includes/login.php" method="post">
                <input type="text" name="uid" placeholder="Prisijungimo vardas">
                <br>
                <br>
                <input type="password" name="pwd" placeholder="Slaptažodis">
                <br>
                <button class="btn green" type="submit" name="submit">Prisijungti</button>
                <button type="register" name="register" formaction="/register"class = "btn blue" ><i class="fa-sharp fa-solid fa-angle-right btnsign"></i>Registruotis</button>
            </form>
        </div>
    </div>
</section>
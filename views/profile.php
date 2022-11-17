<?php
session_start();
$users = require 'includes/getusers.php';
include 'header.php';
?>
<?php
if(!isset($_SESSION["userid"]))
{header("location: ../login");

}

?>
<link rel="stylesheet" href="../style/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Titillium+Web:wght@300;400;600&display=swap" rel="stylesheet">
<section class="login_section">
    <div class="view_wrap right form long">
<p class="title">Atnaujinti Duomenis</p>
            <form action="includes/update.php" method="post">
                
            <label>Prisijungimo vardas</label>
            <input type="text" name="uid" value="<?php echo $_SESSION["useruid"]?>">
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
            
            <button class="btn blue" type="submit" name="submit"><i class="fa-sharp fa-solid fa-angle-right btnsign"></i>Saugoti</button>
            </form>
        </div>
    </div>
</section>


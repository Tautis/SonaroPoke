<?php

if(isset($_POST["submit"]))
{
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

}

include "../classes/db.php";
include "../classes/login.php";
include "../classes/login_cont.php";
$login = new LoginCont($uid,$pwd);

$login->loginUser();

header("location: ../?error=none");
<?php

if(isset($_POST["submit"]))
{
    $uid = $_POST["uid"];
    $uin = $_POST["uin"];
    $uiln = $_POST["uiln"];
    $pwd = $_POST["pwd"];
    $pwd2 = $_POST["pwd2"];
    $email = $_POST["email"];
}

include "../classes/db.php";
include "../classes/signup.php";
include "../classes/signup_cont.php";
$signup = new SignupCont($uid,$uin,$uiln,$pwd,$pwd2,$email);

$signup->signupUser();

header("location: ../?error=none");
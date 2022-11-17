<?php
session_start();


include "classes/db.php";
include "classes/poke.php";
include "classes/poke_cont.php";
$uid = $_SESSION["useruid"];
$pokes = new PokeCont($uid);

return $pokes->pokes();

header("location: ../?error=none");
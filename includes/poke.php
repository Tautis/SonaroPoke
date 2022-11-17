<?php
session_start();


$q = strval($_GET['q']);


include "../classes/db.php";
include "../classes/poke.php";
include "../classes/poke_cont.php";
$poke = new PokeCont($q);

$poke->pokeUser();

?>


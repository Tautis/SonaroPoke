<?php


$username = "root";
$password = "";
$db = new PDO('mysql:host=localhost;dbname=pokedb',$username,$password);
$stmt = $db ->prepare('CREATE TABLE IF NOT EXISTS pokes (poke_date varchar(255) NOT NULL, s_uid varchar(255) NOT NULL, r_uid varchar(255));');
$stmt ->execute();




$str = file_get_contents('imports/pokes.json');
$json = json_decode($str, true);

echo '<pre>' . print_r($json['pokes']['poke1']['date'], true) . '</pre>';
foreach($json['pokes'] as $poke){
    $stmt = $db->prepare('INSERT INTO pokes (poke_date, s_uid, r_uid) VALUES (?,?,?);');
    $date = $poke['date'];
    $from = $poke['from'];
    $to = $poke['to'];
    $stmt->execute(array($date,$from,$to));
}
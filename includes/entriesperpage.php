<?php

include "../classes/db.php";
include "../classes/getusers.php";
include "../classes/getusers_cont.php";
include "../classes/poke.php";
include "../classes/poke_cont.php";
session_start();



$uid = $_SESSION["useruid"];
$perpage = 8;

if(strval($_GET['from'] == 'history'))
{
    $pokes = new PokeCont($uid,);
    $users = $pokes->pokes();
    $value = strval($_GET['q']);


}
elseif(strval($_GET['from'] == 'history_search')){
    $pokes = new PokeCont($uid,);

    
    $from = strval($_GET['fromdate']);
    $to = strval($_GET['todate']);
    $s = strval($_GET['s']);
    $q = strval($_GET['q']);
    $users = $pokes->pokesS($s,$from, $to);

    $value = $q;

}
elseif(strval($_GET['from'] == 'index_search'))
{
    $users = new GetUsersCont();
    $value = strval($_GET['q']);
    $q = strval($_GET['s']);
    $users = $users->showUser($q);


}
elseif (strval($_GET['from'] == 'notification')) {
    $pokes = new PokeCont($uid,);
    $users = $pokes->pokes();
    ?>
    <div class="arrow-up"></div>
    <ul>
    <?php if(count($users) >0)for($i = 0; $i!=7;$i++){
        ?>
        <li>Poke nuo <?php echo $users[$i]["users_name"] ?> <?php echo $users[$i]["users_lastname"];?></li>
<?php }?>
  <a class="nostyle" href="/history">VISI POKE ></a>
        
  </ul> <?php die();}
else{
    $users = new GetUsersCont();
    $users = $users->showUsers();
    $value = intval($_GET['q']);
   
}

?>
<?php
if($value == 0 || $value == 1){
    for($i = 0; $i != $perpage;$i++){?>
            <?php if (strval($_GET['from'] == 'history') || strval($_GET['from'] == 'history_search')) {?>
                <?php if(!isset($users[$i]["poke_date"])){
                return;
             }?>
                <div class="items histo left">
                    <p><?php echo $users[$i]["poke_date"];?></p>
                    <p><?php echo $users[$i]["users_name"];?> <?php echo $users[$i]["users_lastname"]?></p>
                    <p class="symbolstretch" style="width:20px;"><i class="fa-sharp fa-solid fa-angle-right"></i></p>
                    <p><?php echo $_SESSION["username"]; ?> <?php echo $_SESSION["lastname"];?></p>
                </div>

            <?php }
            else {
               if(!isset($users[$i]["users_name"])){
                    return;
                 }
                 if($_SESSION["useruid"] == $users[$i]["users_uid"]){
                    continue;
                 }?>
            <div class="items center">
                <p><?php echo $users[$i]["users_name"];?></p>
                <input hidden name="touid" value="<?php echo $users[$i]["users_name"];?>"></input>
                <p><?php echo $users[$i]["users_lastname"];?></p>
                <p> <?php echo $users[$i]["users_email"];?></p>
                <p style="text-align:center;" > <?php echo $users[$i]["pokes"];?></p>
                <button class="btn"  onclick="poke(this.value, <?php echo $value;?>)" value ="<?php echo $users[$i]["users_uid"];?>"><i class="fa-sharp fa-solid fa-angle-right btnsign"></i>Poke</button>
            </div>
           <?php }?>
<?php }
?>  
<?php 
}else{
?>
<?php

$i = ($value-1) * $perpage;
$temp = $i+$perpage;

for($i; $i < $temp; $i++){?>
<?php 
    if($i >= count($users)){
    break;
  }  
?>
<?php if (strval($_GET['from'] == 'history_search') || strval($_GET['from'] == 'history')) {?>
    <div class="items histo left">
                <p><?php echo $users[$i]["poke_date"];?></p>
                <p><?php echo $users[$i]["users_name"];?> <?php echo $users[$i]["users_lastname"]?></p>
                <p class="symbolstretch" style="width:20px;"><i class="fa-sharp fa-solid fa-angle-right"></i></p>
                
                <p><?php echo $_SESSION["username"]; ?> <?php echo $_SESSION["lastname"];?></p>
                </div>
            <?php }
            else{?>

<div class="items center">
                <p><?php echo $users[$i]["users_name"];?></p>
                <p><?php echo $users[$i]["users_lastname"];?></p>
                <input hidden name="touid" value="<?php echo $users[$i]["users_uid"];?>"></input>
                <p> <?php echo $users[$i]["users_email"];?></p>
                <p style="text-align:center;" > <?php echo $users[$i]["pokes"];?></p>
                <button class="btn"  onclick="poke(this.value, <?php echo $value;?>)" value ="<?php echo $users[$i]["users_uid"];?>"><i class="fa-sharp fa-solid fa-angle-right btnsign"></i>Poke</button>
            </div>
    <?php }?>
<?php
 }}
 ?>

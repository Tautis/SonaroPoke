<?php

include "../classes/db.php";
include "../classes/getusers.php";
include "../classes/getusers_cont.php";
include "../classes/poke.php";
include "../classes/poke_cont.php";
session_start();

$uid = $_SESSION["useruid"];
$pokes = new PokeCont($uid,);
$history = $pokes->pokes();

$usersCont = new GetUsersCont();


if(strval($_GET['from'] == 'history'))
{
    
    $usercount = count($history); //19

    $value = 0;
    $value = strval($_GET['q']);

}
elseif(strval($_GET['from'] == 'history_search')){

    $from = strval($_GET['fromdate']);
    $to = strval($_GET['todate']);
    $s = strval($_GET['s']);
    $q = intval($_GET['q']);

    
    $users = $pokes->pokesS($s,$from, $to);

    $usercount = count($users); //19
    $value = $q;

}
elseif(strval($_GET['from'] == 'index_search'))
{
    $q = strval($_GET['s']);
    $users = $usersCont->showUser($q);
    $value = intval($_GET['q']);
    $usercount = count($users);
}
elseif(strval($_GET['from'] == 'index'))
{
    $users = $usersCont->showUsers();
    $value = intval($_GET['q']);
    $usercount = count($users); //19

}


$firstpage = 1;
$lastpage = $usercount;
$usersperpage = 8;
$paginationnr = [];




if($value<6){
    for($i = 0; $i < ceil(($usercount)/($usersperpage)); $i++){
        
  
        $paginationnr[$i] = $i +1;

        if($i == 6)
        {
            $paginationnr[6] = "...";
            $paginationnr[7] = ceil($usercount/$usersperpage);
            break;
        }
        
    }
}
elseif($value > ceil($usercount/$usersperpage) - 4 ){

    $paginationnr[0] = 1;
    $paginationnr[1] = "...";
    $paginationnr[2] = ceil($usercount/$usersperpage)-5;
    $paginationnr[3] = ceil($usercount/$usersperpage)-4;
    $paginationnr[4] = ceil($usercount/$usersperpage)-3;
    $paginationnr[5] = ceil($usercount/$usersperpage)-2;
    $paginationnr[6] = ceil($usercount/$usersperpage)-1;
    $paginationnr[7] = ceil($usercount/$usersperpage);
}
else{
    $paginationnr[0] = 1;
    $paginationnr[1] = "...";
    $paginationnr[2] = $value-2;
    $paginationnr[3] = $value-1;
    $paginationnr[4] = $value;
    $paginationnr[5] = $value+1;
    $paginationnr[6] = $value+2;
    $paginationnr[7] = "...";
    $paginationnr[8] = ceil($usercount/$usersperpage);
}

?>
<ul>

<?php
if($value == 0)
    $value = 1;
if(strval($_GET['from'] == 'index')){
   ?> <div class="pagination">
<?php foreach($paginationnr as $pagenr){
    if($pagenr == $value){?>
        <li class="nr selected" onclick="paginate(this.value,'index')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
        <?php }else{?>
            <li class="nr" onclick="paginate(this.value, 'index')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>


<?php }}}?>
</div>
<?php if(strval($_GET['from'] == 'index_search')){
   ?> <div class="pagination">
<?php foreach($paginationnr as $pagenr){
    if($pagenr == $value){?>
        <li class="nr selected" onclick="paginate(this.value,'index_search')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
        <?php }else{?>
            <li class="nr" onclick="paginate(this.value,'index_search')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>


<?php }}}?>
</div>
<?php
if(strval($_GET['from'] == 'history')){
    ?><div class="pagination">
<?php foreach($paginationnr as $pagenr){
    if($pagenr == $value){?>
        <li class="nr selected" onclick="paginate(this.value,'history')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
<?php }
    else{?>
        <li class="nr" onclick="paginate(this.value,'history')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
<?php }}}?>
    </div>
<?php
if(strval($_GET['from'] == 'history_search')){
    ?><div class="pagination">
<?php foreach($paginationnr as $pagenr){  
    if($pagenr == $value){?>
        <li class="nr selected" onclick="paginate(this.value,'history_search')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
<?php }
else{?>
        <li class="nr" onclick="paginate(this.value,'history_search')" value="<?php echo $pagenr;?>" ><?php echo $pagenr;?></li>
<?php }}}?>
</div>




</ul>
<?php 


?>
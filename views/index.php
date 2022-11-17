<?php
session_start();
$users = require 'includes/getusers.php';
include 'header.php';
?>
<?php
if(isset($_SESSION["userid"]))
{
?>
<?php
}
else{
    header("location: ../login");
}
?>
<head>
<link rel="stylesheet" href="../style/style.css">
</head>

<body onload="paginate(0,'index')">

<section class="login_section index">
    <div class="view_wrap">
        <div class="login">
            <p class="title">VARTOTOJAI</p>
            <div class="searchicon">
                <input id="searchkey" class="searchfield" placeholder="Ieškoti pagal vardą" onkeyup="search(this.value)">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="table">
                <div class="items first center">
                <p>Vardas</p>
                <p>Pavardė</p>
                <p>El.paštas</p>
                <p style="text-align: center;">Poke skaičius</p>
                <p  ></p>
                </div>
                <div id="response"></div>
                <div id="users_on_load">
            </div>
            <div id="response_user">
  
                        </div>
                <div id="paginator"></div>
            </div>
        </div>
    </div>
    <div id="test"></div>
</section>
</body>
<script>



function poke(value,page){
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("test").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET","../includes/poke.php?q="+value,true);

        xmlhttp.send();

        paginate(page,'index');
        search("");

}




function search(value){
    document.getElementById("response").style.display = "block";
    document.getElementById("users_on_load").style.display = "none";
    if(value == "")
    {
    document.getElementById("users_on_load").style.display = "block";
    document.getElementById("response").style.display = "none";
    console.log("b");
    paginate(0,'search');
    return;
    }
        
    paginate(0,"search");

}

function paginate(value,str){

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("paginator").innerHTML = this.responseText;
            }
        };
        if(str == 'index'){
        xmlhttp.open("GET","../includes/pagination.php?q="+value + "&from=" + "index",true);
        xmlhttp.send();

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response_user").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET","../includes/entriesperpage.php?q="+value + "&from=" + "index",true);
        xmlhttp.send();
    }
    else{
        xmlhttp.open("GET","../includes/pagination.php?q="+value + "&from=" + "index_search" + "&s=" + document.getElementById("searchkey").value,true);
        xmlhttp.send();

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response_user").innerHTML = this.responseText;
            }
        };
        console.log(value);
        xmlhttp.open("GET","../includes/entriesperpage.php?q="+value + "&from=" + "index_search" + "&s=" + document.getElementById("searchkey").value,true);
        xmlhttp.send();
    }

}


</script>

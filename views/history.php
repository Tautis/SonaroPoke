<?php

$pokes = require 'includes/history.php';
$include_options = 'history';
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
<body onload="paginate(0,'history')">
<section class="login_section history">

<div class="view_wrap">
        <div class="login">
            <p class="title">POKE ISTORIJA</p>
            <div class="searchicon histor">
                <input id="searchkey" class="searchfield small" placeholder="Ieškoti pagal vardą" onkeyup="search(this.value)">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="date" onchange="search('')" type="date" id="start" name="trip-start" value="2022-10-10">
                <input class="date" onchange="search('')" type="date" id="end" name="trip-start" value="2023-11-13">
            </div>
            
            <div class="table">
                <div class="items histo first textleft">
                <p>Data</p>
                <p>Siuntėjas</p>
                <p style="width:20px;"></p>
                <p>Gavėjas</p>
                </div>
            <div id="response"></div>
            <div id="users_on_load"></div>
            <div id="response_user"></div>

        </div>
</div>
        <div id="paginator"></div>
    </div>
</section>
</body>

<script>
    


function search(value){
    console.log( document.getElementById("start").value);
    document.getElementById("response").style.display = "block";
    document.getElementById("users_on_load").style.display = "none";
    paginate(0,'search');
}

function paginate(value,str){
    
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("paginator").innerHTML = this.responseText;
            }
        };
        if(str == 'history'){
            xmlhttp.open("GET","../includes/pagination.php?q="+value + "&from=" + "history",true);
            console.log("HISTORY");
            xmlhttp.send();

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response_user").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET","../includes/entriesperpage.php?q="+value + "&from=" + "history",true);
        xmlhttp.send();
        }
            else{
            xmlhttp.open("GET","../includes/pagination.php?q="+value + "&from=" + "history_search"  + "&fromdate=" + document.getElementById("start").value + "&todate=" + document.getElementById("end").value + "&s=" + document.getElementById("searchkey").value ,true);

             xmlhttp.send();
            

            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response_user").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET","../includes/entriesperpage.php?q="+value + "&from=" + "history_search"   + "&fromdate=" + document.getElementById("start").value + "&todate=" + document.getElementById("end").value + "&s=" + document.getElementById("searchkey").value,true);
        xmlhttp.send();
        }

    //document.getElementById("users_on_load").style.display = "none";
       
}


</script>
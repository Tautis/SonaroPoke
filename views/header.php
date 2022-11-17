

<head>
<link rel="stylesheet" href="../style/style.css">
</head>
<script src="https://kit.fontawesome.com/a3c9cbcb2e.js" crossorigin="anonymous"></script>
<body>
<div class="header_wrap">
<ul class="horizontalList headerLi">
    <li><a href="includes/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
    <li><a href="/profile" ><i class="fa-sharp fa-solid fa-circle-user"></i></a></li>
    <li><i onclick="showhide()" class="fa-solid fa-hand-point-right"></i></li>

    
    <li><a class="nostyle" href="/" >BAKSNUOTOJAS 2000</a></li>
</ul>
<div class="notification_wrap" id="notification" style="display: none;" >

    <div class="notification" id="showhere">
    
        
        
        
    </div>

      
</div>
</div>
</body>
<script>
    function showhide(){
        var x = document.getElementById("notification");
        if (x.style.display === "none") {
            show();
            x.style.display = "block";

        } else {
            x.style.display = "none";
        }
    }
    function show(){
        <?php if($_SESSION['useruid']=="")
        {?>
            return 0;
        <?php }?>

        var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("showhere").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET","../includes/entriesperpage.php?from=" + "notification",true);
        xmlhttp.send();
    }
  
</script>
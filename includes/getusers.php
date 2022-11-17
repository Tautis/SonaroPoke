<?php

include "classes/db.php";
include "classes/getusers.php";
include "classes/getusers_cont.php";

$users = new GetUsersCont();

return $users->showUsers();
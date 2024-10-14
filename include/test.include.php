<?php

include "../classes/GetUserData.php";
$users = new GetUserData();
$users->getUserAsJson();

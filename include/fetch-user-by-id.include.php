<?php

include "classes/GetUserData.php";

$fetch_data = new GetUserData();
$fetch_data->getUserByIdAsJson();

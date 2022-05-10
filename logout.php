<?php
session_start();
require_once "utility/include.php";

clear_login_session();

header("Location: index.php");
exit;
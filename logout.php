<?php
require "model/login.php";

$_SESSION = [];
session_unset();
session_destroy();
header("Location: index.php");

<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['company']);
session_destroy();

header('location: page-login.php');

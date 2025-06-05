<?php
session_start();
include 'db.php';
include 'functions.php';

if (isset($_SESSION['user'])) {
    logActivity($conn, $_SESSION['user']['id'], 'Logout', 'User logged out');
}

session_destroy();
header("Location: index.php");
exit;



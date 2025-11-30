<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: login.php');
    exit();
}
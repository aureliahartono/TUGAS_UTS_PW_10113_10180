<?php
// clear all the session variables and redirect to index

session_unset();
session_write_close();
$url = "https://projectpaw.000webhostapp.com//index.php";
header("Location: $url");

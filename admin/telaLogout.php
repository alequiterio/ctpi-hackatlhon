<?php
session_start();
if (isset($_SESSION['nome'])) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    unset($_SESSION['power']);
} else {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    unset($_SESSION['power']);
}
header("location: index.php");
?>
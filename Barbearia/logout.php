<?php
session_start();
session_destroy(); // Encerra a sessão
header("Location: login.php"); // Redireciona para a tela de login
exit();
?>
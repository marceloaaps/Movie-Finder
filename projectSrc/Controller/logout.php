<?php
require_once '../DAO/UsuarioDAO.php'; // Caminho do seu DAO
require_once '../Controller/auth_check.php'; // Caminho correto para Auth.php


session_destroy();

// Redireciona para a página de login após o logout
header('Location: ../View/login.php');
exit();
?>

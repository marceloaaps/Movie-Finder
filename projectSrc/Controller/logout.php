<?php
require_once '../DAO/UsuarioDAO.php'; 
require_once '../Controller/auth_check.php';


session_destroy();

// Redireciona para a página de login após o logout
header('Location: ../login.php');
exit();
?>

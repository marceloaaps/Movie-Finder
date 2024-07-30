<?php
// Incluir o arquivo de conexão com o banco de dados ou com as funções de autenticação, se necessário
require_once '../DAO/db_connect.php';

// Verificar se a sessão está iniciada e se a variável de sessão indicando o login do usuário existe
session_start();

if (!isset($_SESSION['email'])) {
    // Se não estiver logado, redirecionar para a página de login
    header('Location: login.php');
    exit; // Encerra o script após redirecionar
}


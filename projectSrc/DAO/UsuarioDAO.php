<?php

// Definição da classe UsuarioDAO que gerencia as operações de dados para a entidade Usuario.

class UsuarioDAO {
    private $conn;

    // Construtor da classe que recebe a conexão com o banco de dados e a atribui à variável de instância $conn.
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para salvar um novo usuário no banco de dados.
    public function salvar(Usuario $usuario) {
        // Declaração SQL para inserir um novo registro na tabela USUARIOS.
        $sql = "INSERT INTO USUARIOS (NOME, EMAIL, TELEFONE, SENHA, PLANO, DATA_NASCIMENTO, CIDADE, ESTADO, ENDERECO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparação da declaração SQL.
        $stmt = $this->conn->prepare($sql);
        
        // Verifica se a preparação da declaração falhou.
        if (!$stmt) {
            // Exibe uma mensagem de erro e retorna false se a preparação falhar.
            echo "Erro na preparação da declaração: " . $this->conn->error;
            return false;
        }

        // Associação dos parâmetros da declaração SQL com os atributos do objeto Usuario.
        $stmt->bind_param("sssssssss",
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getTelefone(),
            $usuario->getSenha(),
            $usuario->getPlano(),
            $usuario->getDataNascimento(),
            $usuario->getCidade(),
            $usuario->getEstado(),
            $usuario->getEndereco()
        );

        // Execução da declaração SQL.
        if ($stmt->execute()) {
            // Retorna true se a execução for bem-sucedida.
            return true;
        } else {
            // Exibe uma mensagem de erro e retorna false se a execução falhar.
            echo "Erro na execução: " . $stmt->error;
            return false;
        }
    }

    // Método para autenticar um usuário com base no email e senha fornecidos.
    public function autenticar($email, $senha) {
        // Declaração SQL para selecionar a senha do usuário com o email fornecido.
        $sql = "SELECT SENHA FROM USUARIOS WHERE EMAIL = ?";
        
        // Preparação da declaração SQL.
        $stmt = $this->conn->prepare($sql);
        
        // Verifica se a preparação da declaração falhou.
        if (!$stmt) {
            // Exibe uma mensagem de erro e retorna false se a preparação falhar.
            echo "Erro na preparação da declaração: " . $this->conn->error;
            return false;
        }

        // Associação do parâmetro da declaração SQL com o email fornecido.
        $stmt->bind_param("s", $email);
        
        // Execução da declaração SQL.
        $stmt->execute();
        
        // Obtém o resultado da execução.
        $result = $stmt->get_result();
        
        // Verifica se o resultado contém alguma linha.
        if ($result->num_rows > 0) {
            // Obtém a linha do resultado.
            $row = $result->fetch_assoc();
            // Obtém a senha hash da linha.
            $hash = $row['SENHA'];

            // Verifica se a senha fornecida corresponde à senha hash armazenada.
            if (password_verify($senha, $hash)) {
                // Retorna true se a senha for válida.
                return true;
            } else {
                // Retorna false se a senha não for válida.
                return false;
            }
        } else {
            // Retorna false se nenhum usuário com o email fornecido for encontrado.
            return false;
        }
    }

    // Método para verificar se um e-mail já está cadastrado no banco de dados.
    public function emailExiste($email) {
        // Declaração SQL para selecionar o id do usuário com o email fornecido.
        $sql = "SELECT ID_USUARIO FROM USUARIOS WHERE EMAIL = ?";
        
        // Preparação da declaração SQL.
        $stmt = $this->conn->prepare($sql);
        
        // Verifica se a preparação da declaração falhou.
        if (!$stmt) {
            // Exibe uma mensagem de erro e retorna false se a preparação falhar.
            echo "Erro na preparação da declaração: " . $this->conn->error;
            return false;
        }

        // Associação do parâmetro da declaração SQL com o email fornecido.
        $stmt->bind_param("s", $email);
        
        // Execução da declaração SQL.
        $stmt->execute();
        
        // Armazena o resultado.
        $stmt->store_result();
        
        // Retorna true se houver alguma linha no resultado, indicando que o email já está cadastrado
        return $stmt->num_rows > 0;
    }

    public function dadosUsuario($email) {
        $nome = '';
    
        // Preparar e executar a consulta SQL usando $this->conn
        $sql = "SELECT NOME FROM USUARIOS WHERE EMAIL = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email); // "s" indica que $email é uma string
        $stmt->execute();
    
        // Vincular resultado da consulta
        $stmt->bind_result($nome);
    
        // Fetch resultado
        $stmt->fetch();
    
        // Verificar se $nome foi definido (ou seja, se a consulta retornou resultados)
        if (!empty($nome)) {
            return $nome;
        } else {
            return false; // Retorna falso se o usuário não foi encontrado
        }
    }    

}
?>

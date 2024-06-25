<?php
require_once '../DAO/database/db_connect.php';

class FilmeController {
    public function detalhes($id) {
        global $conn;
        $sql = "SELECT * FROM VW_FILMES_GENEROS WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            echo "Filme não encontrado!";
            exit;
        }

        $stmt->close();
    }
}
?>

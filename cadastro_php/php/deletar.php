<?php 
// Processa a exclusão de um aluno
require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados

// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$db = 'cadastro_escola'; // Nome do banco de dados
$user = 'beatriz'; // Nome do usuário do banco de dados
$pass = '123456'; // Senha do banco de dados
$port = 3307; // Porta do MySQL

// Cria uma instância da classe Database e conecta ao banco
$database = new Database($host, $db, $user, $pass, $port);
$database->connect(); // Estabelece a conexão com o banco
$pdo = $database->getConnection(); // Obtém a instância PDO para realizar operações

// Verifica se o ID do aluno foi passado pela URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte o ID para um inteiro
    
    // Prepara a consulta SQL para excluir o aluno com o ID fornecido
    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->bindParam(':id', $id); // Vincula o parâmetro ID à consulta
    
    // Executa a consulta e verifica se a exclusão foi bem-sucedida
    if ($stmt->execute()) {
        echo "Aluno excluído com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao excluir aluno."; // Mensagem de erro
    }
} else {
    echo "ID não fornecido."; // Mensagem caso o ID não seja fornecido
}
?>

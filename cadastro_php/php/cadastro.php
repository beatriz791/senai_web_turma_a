<?php
// Processa o cadastro de alunos
require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados

// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$db = 'cadastro_escola'; // Nome do banco de dados
$user = 'beatriz'; // Nome do usuário do banco de dados
$pass = '123456'; // Senha do banco de dados
$port = 3307; // Porta padrão do MySQL

// Cria uma instância da classe Database
$database = new Database($host, $db, $user, $pass, $port);
$database->connect(); // Estabelece a conexão com o banco de dados
$pdo = $database->getConnection(); // Obtém a instância PDO para realizar operações no banco

// Processa os dados do formulário quando o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário e os sanitiza para evitar XSS
    $nome = htmlspecialchars($_POST['nome']);
    $idade = htmlspecialchars($_POST['idade']);
    $email = htmlspecialchars($_POST['email']);
    $curso = htmlspecialchars($_POST['curso']);
    
    // Prepara a consulta SQL para inserir os dados no banco de dados
    $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, idade, curso) VALUES (:nome, :email, :idade, :curso)");
    
    // Vincula os parâmetros à consulta
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':curso', $curso);
    
    // Executa a consulta e verifica se a inserção foi bem-sucedida
    if ($stmt->execute()) {
        echo "Aluno cadastrado com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao cadastrar aluno."; // Mensagem de erro
    }
}
?>

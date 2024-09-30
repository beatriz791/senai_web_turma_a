<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="../css/style.css"> 
    
    <?php 
        require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados

        // Configurações do banco de dados
        $host = 'localhost'; // Endereço do servidor MySQL
        $db = 'cadastro_escola'; // Nome do banco de dados
        $user = 'beatriz'; // Nome do usuário do banco de dados
        $pass = '12345'; // Senha do banco de dados
        $port = 3307; // Porta do MySQL

        // Cria uma instância da classe Database e conecta ao banco
        $database = new Database($host, $db, $user, $pass, $port);
        $database->connect(); // Estabelece a conexão com o banco
        $pdo = $database->getConnection(); // Obtém a instância PDO para realizar operações
    ?>
</head>
<body>
    <?php
    // Verifica se os dados foram enviados via GET
    if (isset($_GET['nome'], $_GET['email'], $_GET['idade'], $_GET['curso'])) {
        // Captura e sanitiza os dados recebidos
        $nome = htmlspecialchars($_GET['nome']);
        $email = htmlspecialchars($_GET['email']);
        $idade = htmlspecialchars($_GET['idade']);
        $curso = htmlspecialchars($_GET['curso']);

        // Exibe as informações recebidas
        echo "<h2>Informações Recebidas:</h2>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Idade:</strong> $idade</p>";
        echo "<p><strong>Curso:</strong> $curso</p>";

        // Verifica se a conexão PDO foi estabelecida
        if ($pdo) {
            // Prepara a consulta SQL para inserir os dados no banco
            $stmt = $pdo->prepare("INSERT INTO formulario (nome, email, idade, curso) VALUES (:nome, :email, :idade, :curso)");
            // Vincula os parâmetros à consulta
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':idade', $idade);
            $stmt->bindParam(':curso', $curso);

            // Executa a consulta e verifica se a inserção foi bem-sucedida
            if ($stmt->execute()) {
                echo "<p>Dados cadastrados com sucesso!</p>"; // Mensagem de sucesso
            } else {
                echo "<p>Erro ao cadastrar os dados.</p>"; // Mensagem de erro
            }
        }
    } else {
        echo "<p>Nenhum dado foi enviado.</p>"; // Mensagem caso nenhum dado seja recebido
    }
    ?>
</body>
</html>

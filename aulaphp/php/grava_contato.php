<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        $host = 'localhost';
        $db = 'senai_ta_cadastro';
        $user = 'beatriz';
        $pass = '123456';
        $port = 3307; // Porta MySQL correta
        // Inclui o arquivo da classe Database que criamos para conectar dentro da pasta php
        require_once 'connection.php';
        // Cria uma instância da classe Database
        $database = new Database($host, $db, $user, $pass, $port);
        // Chama o método connect para estabelecer a conexão
        $database->connect();
        // Obtém a instância PDO para realizar consultas
        $pdo = $database->getConnection();
    ?>
</head>
<body>
<?php
    // Verifica se os dados foram enviados via GET 
    if(isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['numero']) && isset($_GET['cidade']) && isset($_GET['idade'])) {
        //captura os dados enviados pelo formulário
        $nome = htmlspecialchars($_GET['nome']);
        $email = htmlspecialchars($_GET['email']);
        $senha = htmlspecialchars($_GET['senha']);
        $numero = htmlspecialchars($_GET['numero']);
        $cidade = htmlspecialchars($_GET['cidade']);
        $idade = htmlspecialchars($_GET['idade']);

    // exibe os dados capturados 
    echo "<h2>Informações Recebidas:</h2>";
    echo "<p><strong>Nome:</strong>" . $nome . "<p>";
    echo "<p><strong>E-mail:</strong>" . $email . "<p>";
    echo "<p><strong>Senha:</strong>" . $senha . "<p>";
    echo "<p><strong>Número:</strong>" . $numero . "<p>";
    echo "<p><strong>Cidade:</strong>" . $cidade . "<p>";
    echo "<p><strong>Idade:</strong>" . $idade . "<p>";
    //verifica se a variável $pdo, que deve ser uma instância de PDO,está definida e é válida 
    //prepara uma consulta SQL para selecionar as colunas 'id' e 'nome' da tabela 'usuario'
    $stmt = $pdo->prepare("insert into <senai_ta_aulaphp.formulario(nome, email, senha, numero, cidade, idade) values ('$nome', '$email', '$senha', '$numero', '$cidade', '$idade');")
    //exeuta a consulta preparada
    $stmt->execute();

    } else{
        echo "Nenhum dado foi enviado.";
    }
    
?>
</body>
</html>
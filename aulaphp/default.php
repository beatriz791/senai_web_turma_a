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
        require_once 'php/connection.php';
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
    // Verifica se a variável $pdo, que deve ser uma instância de PDO, está definida e é válida
    if ($pdo) {
        try {
            // Prepara uma consulta SQL para selecionar as colunas 'id' e 'nome' da tabela 'usuario'
            $stmt = $pdo->prepare("SELECT id, nome FROM usuario");
            
            // Executa a consulta preparada
            $stmt->execute();
            
            // Busca todos os resultados da consulta em um array associativo
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Verifica se há algum resultado na consulta
            if ($resultados) {
                // Itera sobre cada linha de resultado
                foreach ($resultados as $row) {
                    // Exibe o valor da coluna 'id' do registro
                    echo "ID: " . $row['id'] . " =  Nome:  ". $row['nome'] . "<br>";
                    
                    // Exibe o valor da coluna 'nome' do registro
                  
                }
            } else {
                // Caso não haja resultados, exibe uma mensagem indicando que nenhum registro foi encontrado
                echo "Nenhum registro encontrado.<br>";
            }
        } catch (PDOException $e) {
            // Captura e exibe qualquer exceção (erro) que possa ocorrer durante a consulta ao banco de dados
            echo "Erro ao consultar o banco de dados: " . $e->getMessage() . "<br>";
        }
    }
?>
</body>
</html>
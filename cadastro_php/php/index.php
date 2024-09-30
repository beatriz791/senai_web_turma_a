<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title> <!-- Título da página -->
    <link rel="stylesheet" href="../style.css"> <!-- Caminho para o arquivo CSS para estilização -->
</head>
<body>
<header>
        <!-- Cabeçalho da página -->
        <nav>
            <!-- Seção de navegação -->
            <div class="logo">
            $tudents
            </div>
            <div id="menu_principal">
                <!-- Div para o menu principal -->
                <ul>
                    <!-- Lista não ordenada para os itens do menu -->
                    <li>
                        
                        <a href="#">
                            Home
                            <!-- Link para a página inicial -->
                        </a>
                    </li>
                    <li>
                        
                        <a href="#">
                            Perfil
                            <!-- Link para a página de trabalhos -->
                        </a>
                    </li>
                    <li>
                        
                        <a href="#">
                            Sobre
                            <!-- Link para a página sobre (atualmente sem URL definida) -->
                        </a>
                    </li>
                    <li>
                      
                        <a href="#">
                            Contatos
                            <!-- Link para a página de contatos (atualmente sem URL definida) -->
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
   
    
    <form action="cadastro.php" method="post"> <!-- Formulário para cadastro de alunos -->
    <h1>Cadastro</h1> <!-- Cabeçalho principal da página -->
        <input type="text" name="nome" placeholder="Nome" required> <!-- Campo para nome, obrigatório -->
        <input type="email" name="email" placeholder="E-mail" required> <!-- Campo para e-mail, obrigatório -->
        <input type="text" name="idade" placeholder="Idade" required> <!-- Campo para idade, obrigatório -->
        <input type="text" name="curso" placeholder="Curso" required> <!-- Campo para curso, obrigatório -->
        <button type="submit">Cadastrar</button> <!-- Botão para enviar o formulário -->
    </form>
    
    <h2>Alunos Cadastrados</h2> <!-- Cabeçalho para a lista de alunos cadastrados -->
    
    <?php
    require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados

    // Configurações do banco de dados
    $host = 'localhost'; // Endereço do servidor MySQL
    $db = 'cadastro_escola'; // Nome do banco de dados
    $user = 'beatriz'; // Nome do usuário do banco de dados
    $pass = '123456'; // Senha do banco de dados
    $port = 3307; // Porta do MySQL

    // Cria uma instância da classe Database e conecta ao banco
    $database = new Database($host, $db, $user, $pass, $port);
    $database->connect();
    $pdo = $database->getConnection(); // Obtém a instância PDO

    // Realiza uma consulta para selecionar todos os alunos
    $stmt = $pdo->query("SELECT * FROM alunos");
    
    // Exibe cada aluno cadastrado na página
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>{$row['nome']} - <a href='deletar.php?id={$row['id']}'>Excluir</a></p>"; // Nome do aluno e link para excluir
    }
    ?>
</body>
</html>

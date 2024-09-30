<?php 
class Database {
    private $pdo;   // Instância PDO para conexão com o banco de dados
    private $host;  // Host do banco de dados
    private $db;    // Nome do banco de dados
    private $user;  // Usuário do banco de dados
    private $pass;  // Senha do banco de dados
    private $port;  // Porta do banco de dados

    // Construtor para definir as configurações do banco de dados
    public function __construct($host, $db, $user, $pass, $port = 3307) { // Mudando para 3307 como padrão
        $this->host = $host;   // Atribui o host
        $this->db = $db;       // Atribui o nome do banco
        $this->user = $user;   // Atribui o usuário
        $this->pass = $pass;   // Atribui a senha
        $this->port = $port;   // Atribui a porta
    }

    // Método para conectar ao banco de dados
    public function connect() {
        try {
            // Cria uma nova instância de PDO para MySQL
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            // Define o modo de erro do PDO para exceções
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Mensagem de sucesso na conexão
            echo "Conexão com o banco de dados MySQL realizada com sucesso!<br>";
        } catch (PDOException $e) {
            // Exibe a mensagem de erro caso a conexão falhe
            echo "Erro na conexão com o banco de dados MySQL: " . $e->getMessage() . "<br>";
        }
    }

    // Método para retornar a instância PDO
    public function getConnection() {
        return $this->pdo; // Retorna a instância PDO
    }
}



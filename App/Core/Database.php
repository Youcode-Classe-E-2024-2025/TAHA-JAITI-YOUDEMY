<?php
class Database
{
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->port = DB_PORT;
        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASS;
        $this->initDatabase();
    }

    public function __call($method, $args){
        if ($this->pdo === null){
            $this->connect();
        }

        if (method_exists($this->pdo, $method)){
            return call_user_func_array([$this->pdo, $method], $args);
        }
    }

    public function initDatabase(): void
    {
        $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port;

        try {
            $tempPDO = new PDO($dsn, $this->user, $this->password);
            $tempPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $tempPDO->prepare("SELECT 1 FROM pg_database WHERE datname = :dbname");
            $stmt->execute(['dbname' => $this->dbname]);
            $exists = $stmt->fetchColumn();

            if (!$exists) {
                $tempPDO->exec("CREATE DATABASE " . $this->dbname);
            }

            $tempPDO = null;

            $this->connect();
            $this->initTables();
        } catch (PDOException $e) {
            throw new Exception("Database initialization failed: " . $e->getMessage());
        }
    }

    public function connect(): void
    {
        $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname;
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connected';
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function initTables(): void
    {
        try {
            $stmt = $this->pdo->prepare("SELECT to_regclass('public.users')");
            $stmt->execute();
            $usersExist = $stmt->fetchColumn();

            if (!$usersExist) {
                $sql = DB_SQL;
                $this->pdo->exec($sql);
            }
        } catch (PDOException $e) {
            throw new Exception("Table initialization failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $this->connect();
        }
        return $this->pdo;
    }

    public function closeConnection(): void
    {
        $this->pdo = null;
    }
}
<?php
class Database
{
    private static $instance = null;
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

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function initDatabase(): void
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
            Session::redirectErr();
        }
    }

    private function connect(): void
    {
        $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname;
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Session::redirectErr();
        }
    }

    private function initTables(): void
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
            Session::redirectErr();
        }
    }

    public function prepareExecute(string $sql, array $params = []): ?PDOStatement
    {
        if ($this->pdo === null) {
            $this->connect();
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            Session::redirectErr();
        }
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->prepareExecute($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(string $sql, array $params = [])
    {
        $stmt = $this->prepareExecute($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function fetchCol(string $sql, array $params = [])
    {
        $stmt = $this->prepareExecute($sql, $params);
        return $stmt->fetchColumn();
    }

    public function execute(string $sql, array $params = []): int
    {
        $stmt = $this->prepareExecute($sql, $params);
        return $stmt->rowCount();
    }

    public function lastInsertId(): int
    {
        if ($this->pdo === null) {
            $this->connect();
        }
        return intval($this->pdo->lastInsertId());
    }
}

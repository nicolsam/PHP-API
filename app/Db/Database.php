<?php

namespace App\Db;

use \PDO;
use \PDOExpection;

class Database {

    /**
     * TIpo de drive utilizado na conexão
     *
     * @var [type]
     */
    private $DRIVE;

    /**
     * Host de conexão com o banco de dados
     *
     * @var string
     */
    private $HOST;

    /**
     * Nome do banco de dados
     *
     * @var string
     */
    private $NAME;

    /**
     * Usuário do banco
     *
     * @var string
     */
    private $USERNAME;

    /**
     * Senha de acesso ao banco de dados
     *
     * @var string
     */
    private $PASSWORD;

    /**
     * Nome da tabela a ser manipulada
     *
     * @var string
     */
    private $table;

    /**
     * Instância de conexão com o banco de dados
     *
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexão
     *
     * @param  string  $table
     *
     */

    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection() {
        try {
            $this->setEnvironmentVariables();

            $this->connection = new PDO($this->DRIVE . ':host=' . $this->HOST . ';dbname=' . $this->NAME, $this->USERNAME, $this->PASSWORD);

            // Mostrar erros PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(Expection $error) {
            echo 'Erro genérico: ' . $error->getMessage();
        } catch(PDOExpection $error) {
            echo 'Erro no Banco de dados: ' . $error->getMessage(); exit;
        }
    }

    private function setEnvironmentVariables() {
        $this->DRIVE    = getenv('DB_DRIVE');
        $this->HOST     = getenv('DB_HOST');
        $this->NAME     = getenv('DB_NAME');
        $this->USERNAME = getenv('DB_USER');
        $this->PASSWORD = getenv('DB_PASSWORD');

        echo $this->PASSWORD;
    }

    private function execute($query) {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();

            return $statement;

        } catch(Exception $error) {
            echo 'Erro genérico: ' . $error->getMessage();
        } catch(PDOException $error) {
            echo 'Erro no Banco de dados: ' . $error->getMessage();
        }
    }

    public function select($where = null) {
        // Dados da query
        $where = strlen($where) ? 'WHERE id = '. $where : '';

        $query = 'SELECT * FROM '. $this->table . ' ' . $where;

        return $this->execute($query);
    }

}
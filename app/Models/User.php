<?php

namespace App\Models;

use \App\Db\Database;
use \PDO;

class User {
    private static $userId;

    private static $table = 'users';

    /**
     * Seleciona um usuário especifico do Banco de dados
     *
     * @param integer $id
     *
     * @return Database
     */
    public static function selectUser($id) {
        return (new Database(self::$table))->select($id)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Seleciona todos os usuários que estão presentes no Banco de dados
     *
     * @return Database
     */
    public static function selectAllUsers() {
        return (new Database(self::$table))->selectAll()->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    
    /**
     * Insere no Banco de dados o usuário requisitado (email/password/name)
     *
     * @param POST $data
     * @return Database
     */
    public static function insert($data) {
        $obDatabase = new Database(self::$table);

        self::$userId = $obDatabase->insert($data);

        return true;
    }
}
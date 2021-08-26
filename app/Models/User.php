<?php

namespace App\Models;

use \App\Db\Database;
use \PDO;

class User {
    private static $table = 'users';

    public static function selectUser($id) {
        return (new Database(self::$table))->select($id)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function selectAllUsers() {
        return (new Database(self::$table))->selectAll()->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
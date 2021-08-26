<?php

namespace App\Models;

use \App\Db\Database;
use \PDO;

class User {
    private static $table = 'users';

    public static function get($id) {
        // $obDatabase = new Database(self::$table);

        // $obDatabase->select('WHERE id =');

        return (new Database(self::$table))->select($id)->fetchAll(PDO::FETCH_CLASS, self::class);
   }
}
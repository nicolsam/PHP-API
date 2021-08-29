<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function get($id = null) {
        if(!$id) {
            User::selectAllUsers();
        }

        return User::selectUser($id);
    }

    public function post() {
        $data = $_POST;
        return User::insert($data);
    }

    public function update() {
        
    }

    public function delete() {
        
    }
}
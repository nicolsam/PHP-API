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
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }
}
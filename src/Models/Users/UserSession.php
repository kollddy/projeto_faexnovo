<?php

namespace Regivaldo\Videos\Models\Users;

use CoffeeCode\Router\Router;


class UserSession
{
    public function handle(Router $router) {
        if ($this->getSession() == null) {
            $router->redirect('/login');
        }

        return true;
    }

    public function create($id, $name, $email)
    {
        $_SESSION['user'] = [
            "id" => $id,
            "name" => $name,
            "email" => $email
        ];
    }

    public function getSession()
    {
        // if (isset($_SESSION['user'])){
        //     return $_SESSION['user'];
        // } else {
        //     return null;
        // };

        // return isset($_SESSION['user']) ? $_SESSION['user'] : null;
        
        return $_SESSION['user'] ?? null;
    }

    public function destroy()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            return true;
        }

        return false;
    }
}

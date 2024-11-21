<?php

namespace Regivaldo\Videos\Routers\Panel\Videos;

use CoffeeCode\Router\Router;
use Regivaldo\Videos\Models\Users\UserSession;

class VideosRouters
{
    private Router $router;

    public function __construct(Router $router) 
    {
        $this->router = $router;
    }

    public function execute()
    {
        $this->router->namespace('Regivaldo\Videos\Controllers\Panel\Videos');
                                                                                           
        $this->router->get("/panel/videos/", 'Videos:execute');

        $this->router->get("/panel/videos/create", 'Create:execute');

        $this->router->get("/panel/videos/edit", 'Edit:execute');
    }

}
<?php

namespace Regivaldo\Videos\Routers;

use CoffeeCode\Router\Router;
use Regivaldo\Videos\Routers\User\UserRouters;
use Regivaldo\Videos\Routers\Panel\Videos\VideosRouters;

class Loader
{
    private Router $router;

    private UserRouters $userRouter;

    private VideosRouters $videosRouter;

    public function __construct() {
        $this->router = new Router("http://localhost");
        $this->userRouter = new UserRouters($this->router);
        $this->videosRouter = new VideosRouters($this->router);
    }

    public function execute() 
    {
        $this->userRouter->execute();  
        $this->videosRouter->execute();
        $this->router->dispatch();
        
        if ($this->router->error()) {
            echo "404";
        }
    }
}

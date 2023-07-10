<?php

namespace Routes;

use App\Controllers\TodoController;

class Web
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function init()
    {
        $this->router->get('/', [TodoController::class, 'index']);
        $this->router->post('/store', [TodoController::class, 'store']);
        $this->router->get('/edit/{id}', [TodoController::class, 'edit']);
        $this->router->put('/update/{id}', [TodoController::class, 'update']);
        $this->router->delete('/delete/{id}', [TodoController::class, 'destroy']);
    }
}
<?php

namespace Routes;

use App\Requests\Request;

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function put($uri, $action)
    {
        $this->routes['PUT'][$uri] = $action;
    }

    public function delete($uri, $action)
    {
        $this->routes['DELETE'][$uri] = $action;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $request = new Request(); // Criação do objeto Request
    
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $action) {
                $pattern = preg_replace('/\\\{id\\\}/', '(\d+)', preg_quote($route, '/'));
        
                if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                    // $matches[1] contém o valor de {id}
                    $id = $matches[1] ?? null;
        
                    if (is_callable($action)) {
                        call_user_func($action, $id, $request);
                    } elseif (is_array($action) && class_exists($action[0]) && method_exists($action[0], $action[1])) {
                        $reflection = new \ReflectionMethod($action[0], $action[1]);
        
                        // Verificamos se o método espera parâmetros
                        if ($reflection->getNumberOfParameters() > 0) {
                            $content = call_user_func([new $action[0], $action[1]], $request, $id);
                        } else {
                            $content = call_user_func([new $action[0], $action[1]]);
                        }
                        
                        include __DIR__ . "/../app/Views/layout.php";
                    }
        
                    return;
                }
            }
        }
        
        http_response_code(404);
        echo '404 Not Found';
    }   
          
}

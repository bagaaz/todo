<?php

namespace App\Controllers;

abstract class Controller
{
    public function render($view, $params = [])
    {
        extract($params);
        $viewPath = __DIR__ . "/../Views/{$view}.php";
    
        if (!file_exists($viewPath)) {
            die("View file not found: {$viewPath}");
        }
            
        if (!ob_start()) {
            die("Failed to start output buffering");
        }
        
        include $viewPath;
        $content = ob_get_clean();
    
        if ($content === false) {
            die("Failed to capture view output");
        }
    
        return $content;
    }

    public function redirect($url = '')
    {
        if ($url === 'home') {
            $url = '';
        }

        header("Location: /{$url}");
        exit;
    }
}
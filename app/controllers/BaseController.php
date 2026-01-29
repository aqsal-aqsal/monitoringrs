<?php
namespace App\Controllers;

class BaseController
{
    protected string $layout = 'base';

    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layouts/' . $this->layout . '.php';
        
        if (is_file($viewFile) && is_file($layoutFile)) {
            $content = function () use ($viewFile, $data) {
                extract($data, EXTR_SKIP);
                require $viewFile;
            };
            require $layoutFile;
        } else {
            http_response_code(404);
            echo 'View or Layout not found';
        }
    }
}

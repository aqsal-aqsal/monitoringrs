<?php
namespace App\Controllers;

class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layout = __DIR__ . '/../views/layouts/base.php';
        if (is_file($viewFile) && is_file($layout)) {
            $content = function () use ($viewFile, $data) {
                extract($data, EXTR_SKIP);
                require $viewFile;
            };
            require $layout;
        } else {
            http_response_code(404);
            echo 'View not found';
        }
    }
}

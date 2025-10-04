<?php

namespace App\core;

class Controller
{
    /**
     * Rend une vue avec des variables
     */
    protected function render(string $view, array $params = []): string
    {
        extract($params);

        $viewFile   = VIEWS_PATH . $view . '.php';
        $layoutFile = VIEWS_PATH . 'layout.php';

        if (!file_exists($viewFile) || !file_exists($layoutFile)) {
            throw new \Exception("Vue non trouvée : $viewFile ou $layoutFile");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        ob_start();
        require $layoutFile;
        return ob_get_clean();
    }

    /**
     * Redirige vers une route nommée
     */
    protected function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}

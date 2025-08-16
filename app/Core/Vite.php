<?php

namespace App\Core;

class Vite
{
    private $manifest;
    private $isDev;
    private $devServerUrl = 'http://localhost:5173';

    public function __construct()
    {
        
        $this->isDev = $this->isViteDevServerRunning();

        if (!$this->isDev) {
            $manifestPath = __DIR__ . '/../../public/build/manifest.json';
            if (!file_exists($manifestPath)) {
                throw new \Exception('El archivo manifest.json de Vite no se encuentra. Por favor, ejecuta "npm run build".');
            }
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        }
    }

    
    private function isViteDevServerRunning(): bool
    {
        $connection = @fsockopen('localhost', 5173);

        if (is_resource($connection)) {
            fclose($connection);
            return true;
        }

        return false;
    }

    
    public function assets(): string
    {
        if ($this->isDev) {
            return '<script type="module" src="' . $this->devServerUrl . '/@vite/client"></script>' .
                   '<script type="module" src="' . $this->devServerUrl . '/resources/js/app.js"></script>';
        }

        $cssFile = $this->manifest['resources/js/app.js']['css'][0] ?? null;
        $jsFile = $this->manifest['resources/js/app.js']['file'];

        $html = '<script type="module" src="/build/' . $jsFile . '"></script>';
        if ($cssFile) {
            $html = '<link rel="stylesheet" href="/build/' . $cssFile . '">' . $html;
        }

        return $html;
    }
}
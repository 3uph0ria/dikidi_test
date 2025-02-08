<?php

class FileManager {
    private $basePath;

    public function __construct($basePath) {
        $realPath = realpath($basePath);
        if ($realPath === false) {
            throw new Exception("Базовая папка не найдена.");
        }
        $this->basePath = $realPath;
    }

    public function listFiles($relativePath = '') {
        $currentPath = realpath($this->basePath . DIRECTORY_SEPARATOR . $relativePath);

        if ($currentPath === false || strpos($currentPath, $this->basePath) !== 0) {
            throw new Exception("Некорректный путь.");
        }

        $items = scandir($currentPath);
        $result = [];
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            $fullPath = $currentPath . DIRECTORY_SEPARATOR . $item;
            if (is_dir($fullPath)) {
                $result[] = [
                    'type' => 'dir',
                    'name' => $item,
                    'path' => ltrim($relativePath . DIRECTORY_SEPARATOR . $item, DIRECTORY_SEPARATOR)
                ];
            } else {
                $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $result[] = [
                        'type' => 'image',
                        'name' => $item,
                        'path' => ltrim($relativePath . DIRECTORY_SEPARATOR . $item, DIRECTORY_SEPARATOR)
                    ];
                }
            }
        }

        return $result;
    }
}

<?php

spl_autoload_register(function ($className) {
    $fileName = sprintf("%s%ssrc%s%s.php", ROOT_PATH, SLASH, SLASH, $className);
    $fileName = realpath($fileName);
    
    if (file_exists($fileName)) {
        require_once($fileName);
    } else {
        echo "file not found {$fileName}";
    }
});
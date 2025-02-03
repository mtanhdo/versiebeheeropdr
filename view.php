<?php
$file = isset($_GET['file']) ? $_GET['file'] : '';

if (file_exists($file)) {
    header('Content-Type: ' . mime_content_type($file));
    header('Content-Length: ' . filesize($file));
    readfile($file);
} else {
    echo "File not found.";
}
?>

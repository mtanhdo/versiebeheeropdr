<?php
// Get the base directory and the requested file
$base_dir = realpath(dirname(__FILE__));
$file_path = isset($_GET['file']) ? realpath($base_dir . '/' . $_GET['file']) : '';

if (strpos($file_path, $base_dir) !== 0 || mime_content_type($file_path) !== 'text/plain') {
    die('Invalid file');
}

// Handle form submission to save file content
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents($file_path, $_POST['content']);
    header('Location: index.php?dir=' . urlencode(dirname($_GET['file'])));
    exit;
}

$content = file_get_contents($file_path);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bestand Bewerken</title>
</head>
<body>
<h1>Bestand Bewerken: <?php echo basename($file_path); ?></h1>
<form method="post">
    <textarea name="content" rows="20" cols="100"><?php echo htmlspecialchars($content); ?></textarea><br>
    <button type="submit">Opslaan</button>
</form>
</body>
</html>
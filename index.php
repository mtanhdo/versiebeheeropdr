<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>File Browser</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; }
        .container { display: flex; }
        .sidebar { width: 200px; background: #e0e0e0; padding: 10px; }
        .content { flex: 1; padding: 10px; background-color: #fff; margin-left: 10px; }
        .file { margin-bottom: 5px; }
        h1, h2 { color: #333; }
        a { text-decoration: none; color: #333; }
        a:hover { text-decoration: underline; }
        ul { list-style-type: none; padding-left: 0; }
        li { margin-bottom: 5px; }
        .file-info { background: #d4ffd4; padding: 10px; margin-top: 10px; }
        .breadcrumbs { margin-bottom: 10px; font-size: 14px; }
        textarea { width: 100%; height: 400px; }
        input[type="submit"] { margin-top: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>File Browser</h2>
        <ul>
            <?php
            // Huidige directory instellen
            $base_dir = __DIR__;
            $current_dir = isset($_GET['dir']) ? realpath($base_dir . '/' . $_GET['dir']) : $base_dir;
            if ($current_dir === false || strpos($current_dir, $base_dir) !== 0) {
                $current_dir = $base_dir;
            }
            $files = scandir($current_dir);

            // Toon de inhoud van de directory
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir("$current_dir/$file")) {
                    echo "<li><a href=\"?dir=" . urlencode(isset($_GET['dir']) ? trim($_GET['dir'] . "/$file", '/') : $file) . "\">$file</a></li>";
                } elseif (is_file("$current_dir/$file")) {
                    echo "<li><a href=\"?dir=" . urlencode(isset($_GET['dir']) ? $_GET['dir'] : '') . "&file=" . urlencode($file) . "\">$file</a></li>";
                }
            }
            ?>
        </ul>
    </div>
    <div class="content">
        <div class="breadcrumbs">
            <?php echo create_breadcrumbs($current_dir, $base_dir); ?>
        </div>
        <h2>Inhoud</h2>
        <?php
        // Selecteer een bestand als het is aangegeven
        $selected_file = $_GET['file'] ?? null;

        // Verwerking van het opslaan van de bestandsinhoud
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $selected_file) {
            $file_path = realpath("$current_dir/$selected_file");
            if ($file_path && strpos($file_path, $base_dir) === 0 && is_file($file_path) && is_writable($file_path)) {
                file_put_contents($file_path, $_POST['file_content']);
                echo "<p>Bestand opgeslagen.</p>";
            } else {
                echo "<p>Kan bestand niet opslaan.</p>";
            }
        }

        // Toon bestandsdetails als een bestand is geselecteerd
        if ($selected_file) {
            $file_path = realpath("$current_dir/$selected_file");
            if ($file_path && strpos($file_path, $base_dir) === 0 && is_file($file_path)) {
                $size = human_filesize(filesize($file_path));
                $writable = is_writable($file_path) ? 'Ja' : 'Nee';
                $last_modified = date('d F Y - H:i:s', filemtime($file_path));
                echo "<div class=\"file-info\">";
                echo "<strong>Bestand:</strong> $selected_file<br>";
                echo "<strong>Grootte:</strong> $size<br>";
                echo "<strong>Schrijfbaar:</strong> $writable<br>";
                echo "<strong>Laatst aangepast:</strong> $last_modified<br>";
                echo "</div>";

                // MIME type controle
                $mime_type = mime_content_type($file_path);
                if ($mime_type === 'text/plain' || $mime_type === 'application/x-httpd-php' || $mime_type === 'text/x-php' || $mime_type ==='text/html') {
                    $file_content = htmlspecialchars(file_get_contents($file_path));
                    echo "<form method=\"post\">";
                    echo "<textarea name=\"file_content\">$file_content</textarea><br>";
                    echo "<input type=\"submit\" value=\"Opslaan\">";
                    echo "</form>";
                } elseif (preg_match('/image\/(jpeg|png|gif)/', $mime_type)) {
                    // Afbeelding voorbeeld voor afbeeldingen
                    echo "<img src=\"" . htmlspecialchars(isset($_GET['dir']) ? $_GET['dir'] . "/$selected_file" : $selected_file) . "\" style=\"max-width:200px;\"><br>";
                }
            }
        } else {
            echo "Selecteer een bestand om de details te bekijken.";
        }

        // Functie om de bestandsmaat in menselijke leesbare vorm te tonen
        function human_filesize($size, $precision = 2): string
        {
            if ($size >= 1024 * 1024 * 1024) {
                return round($size / (1024 * 1024 * 1024), $precision) . ' GB';
            } else {
                return round($size / (1024 * 1024), $precision) . ' MB';
            }
        }

        // Functie om breadcrumbs te maken
        function create_breadcrumbs($current_dir, $base_dir): string
        {
            $relative_path = str_replace($base_dir, '', $current_dir);
            $parts = array_filter(explode(DIRECTORY_SEPARATOR, $relative_path));
            $breadcrumbs = array('<a href="?dir=">Home</a>');
            $path = '';
            foreach ($parts as $part) {
                $path .= DIRECTORY_SEPARATOR . $part;
                $breadcrumbs[] = '<a href="?dir=' . urlencode(trim($path, DIRECTORY_SEPARATOR)) . '">' . $part . '</a>';
            }
            return implode(' > ', $breadcrumbs);
        }
        ?>
    </div>
</div>
</body>
</html>

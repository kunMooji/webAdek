<?php
require_once 'config.php';

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = $_GET['type'];
    
    $column = ($type === 'hero') ? 'hero_image' : 'about_image';
    $query = "SELECT $column FROM landing_content WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image && $image[$column]) {
        header("Content-Type: image/jpeg");     
        echo $image[$column];
        exit;
    }
}

$placeholder_path = __DIR__ . "/gambar/placeholder.png"; 
if (file_exists($placeholder_path)) {
    header("Content-Type: image/png");
    readfile($placeholder_path);
} else {
    header("Content-Type: image/png");
    echo base64_decode("iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=");
}
?>
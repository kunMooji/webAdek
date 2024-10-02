<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    $id = 1; // Assuming we're always editing the first (and only) row
    $hero_title = $_POST['hero_title'];
    $hero_cta = $_POST['hero_cta'];
    $about_title = $_POST['about_title'];
    $about_description = $_POST['about_description'];
    $android_download = $_POST['android_download'];
    $ios_download = $_POST['ios_download'];

    // Handle file uploads
    $hero_image = handleFileUpload('hero_image');
    $about_image = handleFileUpload('about_image');

    $update_query = "UPDATE landing_content SET 
                     hero_title = ?, 
                     hero_cta = ?, 
                     about_title = ?, 
                     about_description = ?,
                     android_download = ?,
                     ios_download = ?";
    
    $params = [$hero_title, $hero_cta, $about_title, $about_description, $android_download, $ios_download];

    if ($hero_image !== null) {
        $update_query .= ", hero_image = ?";
        $params[] = $hero_image;
    }

    if ($about_image !== null) {
        $update_query .= ", about_image = ?";
        $params[] = $about_image;
    }

    $update_query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($update_query);
    if ($stmt->execute($params)) {
        $message = "Content updated successfully!";
    } else {
        $message = "Error updating content: " . $stmt->errorInfo()[2];
    }
}

// Function to handle file upload
function handleFileUpload($field_name) {
    if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES[$field_name]['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            return file_get_contents($_FILES[$field_name]['tmp_name']);
        }
    }
    return null;
}

// Fetch current content
$query = "SELECT * FROM landing_content WHERE id = 1";
$stmt = $pdo->query($query);
$content = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landing Page Content</title>
</head>
<body>
    <h1>Edit Landing Page Content</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Hero Section</h2>
        <label for="hero_title">Hero Title:</label><br>
        <input type="text" id="hero_title" name="hero_title" value="<?php echo htmlspecialchars($content['hero_title']); ?>"><br>
        
        <label for="hero_cta">Hero CTA:</label><br>
        <input type="text" id="hero_cta" name="hero_cta" value="<?php echo htmlspecialchars($content['hero_cta']); ?>"><br>
        
        <label for="hero_image">Hero Image:</label><br>
        <input type="file" id="hero_image" name="hero_image"><br>
        <?php if ($content['hero_image']): ?>
            <img src="display_image.php?id=1&type=hero" alt="Current Hero Image" style="max-width: 200px;"><br>
        <?php endif; ?>
        
        <h2>About Section</h2>
        <label for="about_title">About Title:</label><br>
        <input type="text" id="about_title" name="about_title" value="<?php echo htmlspecialchars($content['about_title']); ?>"><br>
        
        <label for="about_image">About Image:</label><br>
        <input type="file" id="about_image" name="about_image"><br>
        <?php if ($content['about_image']): ?>
            <img src="display_image.php?id=1&type=about" alt="Current About Image" style="max-width: 200px;"><br>
        <?php endif; ?>
        
        <label for="about_description">About Description:</label><br>
        <textarea id="about_description" name="about_description" rows="4" cols="50"><?php echo htmlspecialchars($content['about_description']); ?></textarea><br>
        
        <label for="android_download">Android Download URL:</label><br>
        <input type="text" id="android_download" name="android_download" value="<?php echo htmlspecialchars($content['android_download']); ?>"><br>
        
        <label for="ios_download">iOS Download URL:</label><br>
        <input type="text" id="ios_download" name="ios_download" value="<?php echo htmlspecialchars($content['ios_download']); ?>"><br>
            
        <input type="submit" name="update" value="Update Content">
    </form>
</body>
</html>
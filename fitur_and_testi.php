<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    $id = 1; 
    $hero_title = $_POST['hero_title'];
    $hero_cta = $_POST['hero_cta'];
    
    $desc_subhero1 = $_POST['desc_subhero1'];
    $desc_subhero2 = $_POST['desc_subhero2'];
    $desc_subhero3 = $_POST['desc_subhero3'];
    $desc_subhero4 = $_POST['desc_subhero4'];
    
    $testimoni1_desc = $_POST['testimoni1_desc'];
    $testimoni2_desc = $_POST['testimoni2_desc'];
    $testimoni3_desc = $_POST['testimoni3_desc'];
    $testimoni4_desc = $_POST['testimoni4_desc'];
    
    $testimoni1_name = $_POST['testimoni1_name'];
    $testimoni2_name = $_POST['testimoni2_name'];
    $testimoni3_name = $_POST['testimoni3_name'];
    $testimoni4_name = $_POST['testimoni4_name'];

    $hero_image = handleFileUpload('hero_image');
    $subhero1_img = handleFileUpload('subhero1_img');
    $subhero2_img = handleFileUpload('subhero2_img');
    $subhero3_img = handleFileUpload('subhero3_img');
    $subhero4_img = handleFileUpload('subhero4_img');
    $testimoni1_img = handleFileUpload('testimoni1_img');
    $testimoni2_img = handleFileUpload('testimoni2_img');
    $testimoni3_img = handleFileUpload('testimoni3_img');
    $testimoni4_img = handleFileUpload('testimoni4_img');

    $update_query = "UPDATE fitur_and_testi SET 
                     hero_title = ?, 
                     hero_cta = ?, 
                     desc_subhero1 = ?, 
                     desc_subhero2 = ?,
                     desc_subhero3 = ?,
                     desc_subhero4 = ?,
                     testimoni1_desc = ?,
                     testimoni2_desc = ?,
                     testimoni3_desc = ?,
                     testimoni4_desc = ?,
                     testimoni1_name = ?,
                     testimoni2_name = ?,
                     testimoni3_name = ?,
                     testimoni4_name = ?";

    $params = [$hero_title, $hero_cta, $desc_subhero1, $desc_subhero2, $desc_subhero3, $desc_subhero4,
                $testimoni1_desc, $testimoni2_desc, $testimoni3_desc, $testimoni4_desc,
                $testimoni1_name, $testimoni2_name, $testimoni3_name, $testimoni4_name];

    if ($hero_image !== null) {
        $update_query .= ", hero_image = ?";
        $params[] = $hero_image;
    }

    if ($subhero1_img !== null) {
        $update_query .= ", subhero1_img = ?";
        $params[] = $subhero1_img;
    }

    if ($subhero2_img !== null) {
        $update_query .= ", subhero2_img = ?";
        $params[] = $subhero2_img;
    }

    if ($subhero3_img !== null) {
        $update_query .= ", subhero3_img = ?";
        $params[] = $subhero3_img;
    }

    if ($subhero4_img !== null) {
        $update_query .= ", subhero4_img = ?";
        $params[] = $subhero4_img;
    }

    if ($testimoni1_img !== null) {
        $update_query .= ", testimoni1_img = ?";
        $params[] = $testimoni1_img;
    }

    if ($testimoni2_img !== null) {
        $update_query .= ", testimoni2_img = ?";
        $params[] = $testimoni2_img;
    }

    if ($testimoni3_img !== null) {
        $update_query .= ", testimoni3_img = ?";
        $params[] = $testimoni3_img;
    }

    if ($testimoni4_img !== null) {
        $update_query .= ", testimoni4_img = ?";
        $params[] = $testimoni4_img;
    }

    $update_query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($update_query);
    if ($stmt->execute($params)) {
        $message = "konten sudah berhasil di update!";
    } else {
        $message = "kesalahan dalam update konten: " . $stmt->errorInfo()[2];
    }
}

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

// ngambil konten yang sekarang
$query = "SELECT * FROM fitur_and_testi WHERE id = 1";
$stmt = $pdo->query($query);
$content = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landing Page Content</title>
    <link rel="stylesheet" href="css/edit.css">
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
        <?php if (!empty($content['hero_image'])): ?>
            <img src="display_image.php?id=1&type=hero" alt="Current Hero Image" style="max-width: 200px;"><br>
        <?php endif; ?>
        
        <h2>Sub-hero Sections</h2>
        <?php
        for ($i = 1; $i <= 4; $i++) {
            echo "<h3>Sub-hero $i</h3>";
            echo "<label for='subhero{$i}_img'>Sub-hero $i Image:</label><br>";
            echo "<input type='file' id='subhero{$i}_img' name='subhero{$i}_img'><br>";
            if (!empty($content["subhero{$i}_img"])) {
                echo "<img src='display_image.php?id=1&type=subhero$i' alt='Current Sub-hero $i Image' style='max-width: 200px;'><br>";
            }
            echo "<label for='desc_subhero$i'>Sub-hero $i Description:</label><br>";
            echo "<textarea id='desc_subhero$i' name='desc_subhero$i' rows='4' cols='50'>" . htmlspecialchars($content["desc_subhero$i"] ?? '') . "</textarea><br>";
        }
        ?>
        
        <h2>Testimonials</h2>
        <?php
        for ($i = 1; $i <= 4; $i++) {
            echo "<h3>Testimonial $i</h3>";
            echo "<label for='testimoni{$i}_img'>Testimonial $i Image:</label><br>";
            echo "<input type='file' id='testimoni{$i}_img' name='testimoni{$i}_img'><br>";
            if (!empty($content["testimoni{$i}_img"])) {
                echo "<img src='display_image.php?id=1&type=testimoni$i' alt='Current Testimonial $i Image' style='max-width: 200px;'><br>";
            }
            echo "<label for='testimoni{$i}_desc'>Testimonial $i Description:</label><br>";
            echo "<textarea id='testimoni{$i}_desc' name='testimoni{$i}_desc' rows='4' cols='50'>" . htmlspecialchars($content["testimoni{$i}_desc"] ?? '') . "</textarea><br>";
            echo "<label for='testimoni{$i}_name'>Testimonial $i Name:</label><br>";
            echo "<input type='text' id='testimoni{$i}_name' name='testimoni{$i}_name' value='" . htmlspecialchars($content["testimoni{$i}_name"] ?? '') . "'><br>";
        }
        ?>
        
        <input type="submit" name="update" value="Update Content">
    </form>
</body>
</html>

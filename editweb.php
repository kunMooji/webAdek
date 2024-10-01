<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adekweb</title>
</head>
<body>
    <h1>adekweb_admin</h1>

    <?php
    require_once 'config.php';

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM landing_page WHERE id=?";
        $stmt = $pdo->prepare($delete_query);
        if ($stmt->execute([$delete_id])) {
            echo "Data berhasil dihapus!";
        } else {
            echo "Error menghapus data: " . $stmt->errorInfo()[2];
        }
    }

    if (isset($_POST['update_id'])) {
        $update_id = $_POST['update_id'];
        $section_name = $_POST['section_name'];
        $deskripsi = $_POST['deskripsi'];

        $update_query = "UPDATE landing_page SET section_name=?, deskripsi=? WHERE id=?";
        $stmt = $pdo->prepare($update_query);
        if ($stmt->execute([$section_name, $deskripsi, $update_id])) {
            echo "Data berhasil diupdate!";
        } else {
            echo "Error mengupdate data: " . $stmt->errorInfo()[2];
        }
    }

    if (isset($_POST['insert'])) {
        $section_name = $_POST['section_name'];
        $tentang_adek = $_POST['tentang_adek'];
        $deskripsi = $_POST['deskripsi'];

        $insert_query = "INSERT INTO landing_page (section_name, tentang_adek, deskripsi) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($insert_query);
        if ($stmt->execute([$section_name, $tentang_adek, $deskripsi])) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error menambahkan data: " . $stmt->errorInfo()[2];
        }
    }
    ?>

    <h2>Tambah Data Baru</h2>
    <form method="POST" action="editweb.php">
        Section Name: <input type="text" name="section_name" required><br>
        tentang adek: <input type="text" name="tentang_adek" required><br>
        Deskripsi: <input type="text" name="deskripsi" required><br>
        <button type="submit" name="insert">Tambah</button>
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Section Name</th>
            <th>tentang adek</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $data = mysqli_query($config, "SELECT * FROM landing_page");

        while ($hasil = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $hasil['section_name']; ?></td>
                <td><?php echo $hasil['tentang_adek']; ?></td>
                <td><?php echo $hasil['deskripsi']; ?></td>
                <td>

                    <a href="editweb.php?delete_id=<?php echo $hasil['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>

                    <button onclick="document.getElementById('editForm<?php echo $hasil['id']; ?>').style.display='block'">Ubah</button>

    
                    <div id="editForm<?php echo $hasil['id']; ?>" style="display:none;">
                        <form method="POST" action="editweb.php">
                            <input type="hidden" name="update_id" value="<?php echo $hasil['id']; ?>">
                            Section Name: <input type="text" name="section_name" value="<?php echo $hasil['section_name']; ?>"><br>
                            Deskripsi: <input type="text" name="deskripsi" value="<?php echo $hasil['deskripsi']; ?>"><br>
                            <button type="submit">Simpan</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>

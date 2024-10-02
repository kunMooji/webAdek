<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adek Web</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/teks.css">
    <link rel="stylesheet" href="js/script.js">
  </head>

  <body>
    <?php
    require_once 'config.php';
    
    $query = "SELECT * FROM landing_content LIMIT 1";
    $stmt = $pdo->query($query);
    $content = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo htmlspecialchars($content['judul']); ?></title>
    
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet"
        />
        <script src="https://unpkg.com/feather-icons"></script>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/teks.css">
        <link rel="stylesheet" href="js/script.js">
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar">
          <a href="#" class="navbar-logo">ADEK <span>(Ayo Diet Efektif Konsisten)</span></a>
          <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#features">Fitur Kami</a>
            <a href="#contact">Kontak</a>
          </div>
          <div class="navbar-extra">
            <a href="login.php">LOGIN</a>
            <a href="#">EN</a>
            <a href="#" class="learn-more-btn">Learn More</a>
          </div>
        </nav>
    
        <section class="hero">
          <div class="content">
            <h1><?php echo htmlspecialchars($content['hero_title']); ?></h1>
            <a href="#features" class="cta"><?php echo htmlspecialchars($content['hero_cta']); ?></a>
          </div>
          <div class="hero-image">
            <!-- <img src="<?php echo htmlspecialchars($content['gambar_landing_page']); ?>"> -->
          </div>
        </section>
    
        <!-- About Section Start -->
        <section id="about" class="about">
          <h2><?php echo htmlspecialchars($content['about_title']); ?></h2>
          <div class="row">
          <div class="about-img">
              <img src="display_image.php?id=1" alt="Tentang ADEK" class="menu-card-img"/>
          </div>
            <div class="content">
              <h3>Kenapa Pilih ADEK?</h3>
              <p><?php echo nl2br(htmlspecialchars($content['about_description'])); ?></p>
              
              <div class="content">
                <h3>Download Sekarang !</h3>
              </div>
              <!-- Tambahkan tombol download aplikasi di sini -->
              <div class="download-buttons">
              <a href="<?php echo htmlspecialchars($content['android_download']); ?>" class="btn btn-primary">Download Android</a>
              <a href="<?php echo htmlspecialchars($content['ios_download']); ?>" class="btn btn-secondary">Download untuk iOS</a>
              </div>
            </div>
          </div>
        </section>
        <!-- About Section End -->

  
<!-- Fitur Kami Section Start (Previously Menu) -->
<section class="meanu" id="features">
  <h2>Capai target kesehatanmu dengan fitur yang lengkap</h2>
  <p>Deskripsi singkat tentang fitur-fitur yang tersedia.</p>
  <div class="row">
    <div class="menu-card-img3">
          <img src="../adekweb/gambar/hape_fitur350.png" class="menu-card-img" />
      </div>
      <div class="row">
          <div class="menu-card img ">
              <img src="../adekweb/gambar/bmi_ic.png" alt="Icon Aktivitas"class="menu-card-img"  />
              <div class="feature-description">
                  <h3>Catat dan lihat Aktivitasmu setiap hari</h3>
                  <p>Catat asupan, kalori terbakar, langkah, dan aktivitas lainnya</p>
              </div>
          </div>
          <div class="menu-card img ">
              <img src="../adekweb/gambar/articleIcon.png" alt="Icon Program"class="menu-card-img" />
              <div class="feature-description">
                  <h3>Berbagai Program Kesehatan Untuk Anda</h3>
                  <p>Ikuti program yang sesuai dengan target kesehatanmu</p>
              </div>
          </div>
          <div class=" menu-card img ">
              <img src="../adekweb/gambar/ic_survey.png" alt="Icon Reward"class="menu-card-img" />
              <div class="feature-description">
                  <h3>Poin & Voucher</h3>
                  <p>Isi tugas harianmu untuk dapatkan poin & voucher belanja!</p>
              </div>
          </div>
          <div class="menu-card img ">
              <img src="../adekweb/gambar/ic_makanan.png" alt="Icon Level"class="menu-card-img" />
              <div class="feature-description">
                  <h3>Level & Peringkat</h3>
                  <p>Kumpulkan poin dan capai peringkat tertinggi!</p>
              </div>
          </div>
      </div>
  </div>
</section>  

<section class="meanu" id="features">
  <h2>Apa Kata Pengguna Kami?</h2>
  <div class="testimoni-slider">
    <div class="testimoni-item">
      <img src="gambar/orang1.jpeg" alt="User Photo 1" />
      <p>"ADEK membantu saya menjaga pola makan dan menurunkan berat badan. Saya merasa lebih sehat!"</p>
      <h4>- Ahmad Rizky</h4>
    </div>
    <div class="testimoni-item">
      <img src="gambar/orang3.jpeg" alt="User Photo 2" />
      <p>"Fitur-fitur dalam ADEK sangat berguna dan mudah diakses. Saya sangat merekomendasikan!"</p>
      <h4>- Siti Nur Azizah</h4>
    </div>
    <div class="testimoni-item">
      <img src="gambar/orang4.jpeg" alt="User Photo 3" />
      <p>"Fitur-fitur dalam ADEK sangat berguna dan mudah diakses. Saya sangat merekomendasikan!"</p>
      <h4>- Fajar Conang</h4>
    </div>
    <div class="testimoni-item">
      <img src="gambar/orang2.jpeg" alt="User Photo " />
      <p>"Fitur-fitur dalam ADEK sangat berguna dan mudah diakses. Saya sangat merekomendasikan!"</p>
      <h4>- Nabila Aulia</h4>
    </div>
  </div>
</section>
    <!-- Contact Section start -->
    <section id="contact" class="contact">
      <h2>Kontak Kami</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id.</p>
      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d698.165785623914!2d113.72290865114873!3d-8.160158515152116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b617d8f623%3A0xf6c4437632474338!2sPoliteknik%20Negeri%20Jember!5e0!3m2!1sid!2ssg!4v1727077570555!5m2!1sid!2ssg"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="maps"
        ></iframe>
        <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="nama" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="email" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="nomor hp" />
          </div>
          <button type="submit" class="btn">Kirim Pesan</button>
        </form>
      </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Start -->
    <footer>
      <div class="socials">
        <a
          href="https://www.instagram.com/"
          ><i data-feather="instagram"></i
        ></a>
        <a href="https://wa.me/qr/XTOYMK4MV3YSO1"
          ><i data-feather="phone"></i
        ></a>
        <a href="https://youtube.com/@jessichaalvina4143?si=NDwDkQlCOm1vkRLz"
          ><i data-feather="youtube"></i
        ></a>
      </div>
      <div class="links">
        <a href="#home"> Home</a>
        <a href="#about"> Tentang Kami</a>
        <a href="#meanu"> Menu</a>
        <a href="#contact"> Kontak</a>
      </div>
      <div class="credit">
        <p>
          Created by
          <a
            href="https://www.linkedin.com/in/jessicha-alvina-68bb2120b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
            >Jessicha Dwi Alvina</a
          >. | &copy; 2024.
        </p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- My Javascript -->
    <script src="js/script.js"></script>
    <!-- Feather Icon -->
    <script>
      feather.replace();
    </script>
  </body>
</html>
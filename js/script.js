window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 100) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });const images = document.querySelectorAll('.menu-card-img');
  const buttons = document.querySelectorAll('.btn');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show'); // Menampilkan gambar atau button
      } else {
        entry.target.classList.remove('show'); // Menghilangkan gambar atau button ketika tidak terlihat
      }
    });
  }, {
    threshold: 0.5 // Trigger animasi saat 50% elemen terlihat
  });
  
  // Mengamati semua gambar
  images.forEach(img => {
    observer.observe(img);
  });
  
  // Mengamati semua button
  buttons.forEach(btn => {
    observer.observe(btn);
  });

  

  
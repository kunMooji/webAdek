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
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  }, {
    threshold: 0.5 
  });

  images.forEach(img => {
    observer.observe(img);
  });
  
  buttons.forEach(btn => {
    observer.observe(btn);
  });

  

  
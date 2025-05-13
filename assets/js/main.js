document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector(".menu-toggle");
    const nav = document.querySelector(".main-nav");

    if (menuToggle && nav) {
        menuToggle.addEventListener("click", function() {
            nav.classList.toggle("open");
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const scrollLinks = document.querySelectorAll(".scroll-to");

    scrollLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 50, // Houdt rekening met een vaste header
                    behavior: "smooth"
                });
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector(".site-header");

    if (!header) {
        console.log("❌ Header niet gevonden!");
        return;
    }

    function updateHeader() {
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    }

    // Check meteen bij laden
    updateHeader();
    // Check bij scrollen
    window.addEventListener("scroll", updateHeader);
});

document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger-menu");
    const mobileNav = document.querySelector(".mobile-nav");

    hamburger.addEventListener("click", function () {
        this.classList.toggle("active");
        mobileNav.classList.toggle("active");
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const vragen = document.querySelectorAll(".faq-vraag");
    vragen.forEach((vraag) => {
      vraag.addEventListener("click", function () {
        const item = this.closest(".faq-item");
        item.classList.toggle("open");
      });
    });
  });
  
  document.addEventListener("DOMContentLoaded", function () {

    // ✅ Fancybox activeren
    Fancybox.bind("[data-fancybox='gallery']", {
      Thumbs: false,
      Toolbar: false
    });
  });
  

  document.addEventListener("DOMContentLoaded", function () {
    const wrappers = document.querySelectorAll(".gallery-wrapper");
  
    wrappers.forEach(wrapper => {
      const grid = wrapper.querySelector(".masonry-grid");
      const prev = wrapper.querySelector(".gallery-arrow.prev");
      const next = wrapper.querySelector(".gallery-arrow.next");
  
      if (!grid) return;
  
      // Bereken de breedte van 1 item met gap
      const getItemScrollAmount = () => {
        const item = grid.querySelector("a");
        const gap = parseInt(getComputedStyle(grid).gap) || 0;
        return item.offsetWidth + gap;
      };
  
      // Pijltjes
      prev?.addEventListener("click", () => {
        grid.scrollBy({ left: -getItemScrollAmount(), behavior: "smooth" });
      });
  
      next?.addEventListener("click", () => {
        grid.scrollBy({ left: getItemScrollAmount(), behavior: "smooth" });
      });
  
      // Drag scroll
      let isDragging = false;
      let startX = 0;
      let scrollStart = 0;
  
      const startDrag = (e) => {
        if (e.button !== 0) return; // Alleen linkermuisknop
        isDragging = true;
        grid.classList.add("dragging");
        startX = e.pageX;
        scrollStart = grid.scrollLeft;
      };
  
      const endDrag = () => {
        isDragging = false;
        grid.classList.remove("dragging");
      };
  
      const handleMove = (e) => {
        if (!isDragging) return;
        const x = e.pageX;
        const distance = x - startX;
        grid.scrollLeft = scrollStart - distance;
      };
  
      grid.addEventListener("mousedown", startDrag);
      window.addEventListener("mouseup", endDrag);
      window.addEventListener("mouseleave", endDrag);
      window.addEventListener("mousemove", handleMove);
  
      // Touch events voor mobiel scrollen
      let startTouch = 0;
  
      grid.addEventListener('touchstart', (e) => {
        startTouch = e.touches[0].clientX;
      });
  
      grid.addEventListener('touchmove', (e) => {
        if (!startTouch) return;
        const moveTouch = e.touches[0].clientX;
        const diff = startTouch - moveTouch;
  
        if (Math.abs(diff) > 50) {
          if (diff > 0) {
            grid.scrollBy({ left: getItemScrollAmount(), behavior: 'smooth' });
          } else {
            grid.scrollBy({ left: -getItemScrollAmount(), behavior: 'smooth' });
          }
          startTouch = 0; // Reset de touch
        }
      });
    });
  });
  
  document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.querySelector('.scroll-indicator');
    
    if (scrollBtn) {
      scrollBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const hero = document.querySelector('.hero');
        if (hero) {
          const heroHeight = hero.offsetHeight;
          window.scrollTo({
            top: heroHeight,
            behavior: 'smooth'
          });
        }
      });
    }
  });
  
document.addEventListener("DOMContentLoaded", function () {
  const masonry = document.querySelector(".masonry");
  const left = document.querySelector(".masonry-arrow.left");
  const right = document.querySelector(".masonry-arrow.right");

  if (left && right && masonry) {
    left.addEventListener("click", () => {
      masonry.scrollBy({ left: -300, behavior: 'smooth' });
    });

    right.addEventListener("click", () => {
      masonry.scrollBy({ left: 300, behavior: 'smooth' });
    });

let isDown = false;
let startX;
let scrollLeft;

masonry.addEventListener('mousedown', (e) => {
  if (e.target.tagName === 'IMG' || e.target.closest('a')) return;
  isDown = true;
  masonry.classList.add('active');
  startX = e.pageX - masonry.offsetLeft;
  scrollLeft = masonry.scrollLeft;
});

masonry.addEventListener('mouseleave', () => {
  isDown = false;
  masonry.classList.remove('active');
});

masonry.addEventListener('mouseup', () => {
  isDown = false;
  masonry.classList.remove('active');
});

masonry.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - masonry.offsetLeft;
  const walk = (x - startX) * 1.5;
  masonry.scrollLeft = scrollLeft - walk;
});
  }
});

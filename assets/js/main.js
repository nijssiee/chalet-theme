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

if (hamburger && mobileNav) {
  ["click", "touchstart"].forEach(event => {
    hamburger.addEventListener(event, function (e) {
      e.preventDefault();
      this.classList.toggle("active");
      mobileNav.classList.toggle("active");
    });
  });
}
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

document.addEventListener("DOMContentLoaded", function () {
  const prijsOutput = document.getElementById('prijs');
  const stappen = document.querySelectorAll('.prijs-calculator .stap');
  const btnVorige = document.getElementById('btn-vorige');
  const btnVolgende = document.querySelector('#stap-buttons-container button:nth-child(2)');
  const afwerkingContainer = document.getElementById('afwerking-dak');

  const basisPrijs = 70000;

  function berekenPrijs() {
    let totaal = basisPrijs;
    const inputs = document.querySelectorAll('.prijs-calculator input[type="radio"], .prijs-calculator input[type="checkbox"]');

    inputs.forEach((input) => {
      const label = input.closest('label');
      const prijs = parseFloat(input.value) || 0;

      if ((input.type === 'checkbox' && input.checked) || (input.type === 'radio' && input.checked)) {
        label.classList.add('checked');
        totaal += prijs;
      } else {
        label.classList.remove('checked');
      }
    });

    prijsOutput.textContent = 'Vanaf prijs: € ' + totaal.toLocaleString('nl-NL');
  }

  function updateAfwerkingDak(dakKeuze) {
    let opties = '';
    if (dakKeuze === '0') {
      opties += '<label><input type="radio" name="afwerking_dak" value="0"> Bitumen (platdak)</label>';
      opties += '<label><input type="radio" name="afwerking_dak" value="2000"> EPDM (+ €2000,-)</label>';
    } else if (dakKeuze === '2000') {
      opties += '<label><input type="radio" name="afwerking_dak" value="0"> Bitumen (lessenaardak)</label>';
      opties += '<label><input type="radio" name="afwerking_dak" value="2500"> Metalen flensdak (+ €2500,-)</label>';
      opties += '<label><input type="radio" name="afwerking_dak" value="2700"> Metalen dakpannendak (+ €2700,-)</label>';
    } else if (dakKeuze === '5000') {
      opties += '<label><input type="radio" name="afwerking_dak" value="2900"> Metalen flensdak (+ €2900,-)</label>';
      opties += '<label><input type="radio" name="afwerking_dak" value="3100"> Metalen dakpannendak (+ €3100,-)</label>';
    }
    afwerkingContainer.innerHTML = opties;
    afwerkingContainer.querySelectorAll('input').forEach(input => {
      input.addEventListener('change', () => {
        berekenPrijs();
        const currentIndex = [...stappen].findIndex(s => s.classList.contains('active'));
        updateNavigatie(currentIndex);
      });
    });
  }

  function updateNavigatie(index) {
    if (index === 0) {
      btnVorige.style.display = 'none';
      btnVolgende.parentElement.style.justifyContent = 'flex-end';
    } else {
      btnVorige.style.display = 'inline-flex';
      btnVolgende.parentElement.style.justifyContent = 'space-between';
    }

    btnVolgende.style.display = index === stappen.length - 1 ? 'none' : 'inline-flex';

    const currentStep = stappen[index];
    const keuzes = currentStep.querySelectorAll('input[type="radio"], input[type="checkbox"]');
    const ietsGekozen = Array.from(keuzes).some(i => i.checked);

    btnVolgende.disabled = keuzes.length > 0 && !ietsGekozen;

    updateProgress(index);
  }

  function volgendeStap() {
    let index = [...stappen].findIndex(s => s.classList.contains('active'));
    const currentInputs = stappen[index].querySelectorAll('input[type="radio"], input[type="checkbox"]');
    const ietsGekozen = Array.from(currentInputs).some(i => i.checked);
    if (currentInputs.length > 0 && !ietsGekozen) {
      alert('Maak eerst een keuze voordat je doorgaat.');
      return;
    }

    if (index !== -1 && index < stappen.length - 1) {
      stappen[index].classList.remove('active');
      stappen[index + 1].classList.add('active');
      updateNavigatie(index + 1);
      updateProgress(index + 1);
    }
  }

  function vorigeStap() {
    let index = [...stappen].findIndex(s => s.classList.contains('active'));
    if (index > 0) {
      stappen[index].classList.remove('active');
      stappen[index - 1].classList.add('active');
      updateNavigatie(index - 1);
    }
  }

  function updateProgress(index) {
    const steps = document.querySelectorAll('.progress-steps li');
    const progressBar = document.querySelector('.progress-bar');

    steps.forEach((step, i) => {
      step.classList.remove('active', 'completed');
      if (i < index) step.classList.add('completed');
      if (i === index) step.classList.add('active');
    });

    const progress = ((index) / (steps.length - 1)) * 100;
    progressBar.style.width = `${progress}%`;
  }

  window.volgendeStap = volgendeStap;
  window.vorigeStap = vorigeStap;

  document.querySelectorAll('.prijs-calculator input[type="radio"], .prijs-calculator input[type="checkbox"]').forEach(input => {
    input.addEventListener('change', () => {
      berekenPrijs();
      if (input.name === 'dak') updateAfwerkingDak(input.value);
      const currentIndex = [...stappen].findIndex(s => s.classList.contains('active'));
      updateNavigatie(currentIndex);
    });
  });

  berekenPrijs();
  updateNavigatie(0);

  const gekozenDak = document.querySelector('input[name="dak"]:checked');
  if (gekozenDak) updateAfwerkingDak(gekozenDak.value);
});

document.getElementById("calculator-form").addEventListener("submit", function(e) {
  e.preventDefault();

  const keuzesPerStap = {};
  const stappen = document.querySelectorAll('.prijs-calculator .stap');

  stappen.forEach(stap => {
    const stapNaam = stap.querySelector('h2').textContent.trim(); // Stap titel
    const gekozenInput = stap.querySelector('input[type="radio"]:checked, input[type="checkbox"]:checked');
    if (gekozenInput) {
      // Kies label tekst, zonder staptitel (anders dubbele info)
      const labelTekst = gekozenInput.closest('label').textContent.trim();
      keuzesPerStap[stapNaam] = labelTekst;
    }
  });

  // Bouw querystring met stappen en keuzes
  const queryParams = Object.entries(keuzesPerStap)
    .map(([stap, keuze]) => encodeURIComponent(stap) + '=' + encodeURIComponent(keuze))
    .join('&');

window.location.href = window.location.origin + '/offerte-aanvraag/?' + queryParams;
});

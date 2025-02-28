document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded!");

    const menuButton = document.getElementById("menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const dropdownButton = document.querySelector(".group > button");
    const dropdownMenu = document.getElementById("dropdown-menu");

    if (menuButton) {
        menuButton.addEventListener("click", function () {
            console.log("Menu button clicked!");
            mobileMenu.classList.toggle("hidden");
        });
    }

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener("mouseenter", function () {
            console.log("Mouse enter Resources");
            dropdownMenu.classList.remove("hidden");
        });

        dropdownMenu.addEventListener("mouseleave", function () {
            console.log("Mouse leave dropdown");
            dropdownMenu.classList.add("hidden");
        });
    }
});

document.addEventListener("click", function (event) {
    if (mobileMenu && !mobileMenu.classList.contains("hidden") && !menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
        mobileMenu.classList.add("hidden");
    }
});


function toggleAnswer(id) {
    const answer = document.getElementById(id);
    const icon = document.getElementById('icon' + id.charAt(id.length - 1));

    answer.classList.toggle('hidden');
    answer.classList.toggle('opacity-100');
    icon.classList.toggle('rotate-180');
  }

  const speedDialBtn = document.getElementById('speedDialBtn');
  const speedDialMenu = document.getElementById('speedDialMenu');
  const speedDialIcon = document.getElementById('speedDialIcon');
  const contacts = speedDialMenu.querySelectorAll("a");

  speedDialBtn.addEventListener('click', function(event) {
      const isHidden = speedDialMenu.classList.contains('hidden');
      
      if (isHidden) {
          speedDialMenu.classList.remove('hidden');
          contacts.forEach((contact, index) => {
              setTimeout(() => {
                  contact.classList.add('scale-show');
              }, index * 100);
          });
      } else {
          contacts.forEach((contact, index) => {
              setTimeout(() => {
                  contact.classList.remove('scale-show');
              }, index * 100);
          });
          setTimeout(() => {
              speedDialMenu.classList.add('hidden');
          }, contacts.length * 100);
      }

      // หมุนปุ่มและทำให้กระเด้ง
      speedDialIcon.classList.toggle('rotate-45');
      speedDialBtn.classList.add('scale-90');
      setTimeout(() => speedDialBtn.classList.remove('scale-90'), 200);

      // สร้างเอฟเฟกต์ ripple
      const ripple = document.createElement('span');
      ripple.classList.add('ripple');
      ripple.style.width = ripple.style.height = `${speedDialBtn.clientWidth * 2}px`;
      ripple.style.left = `${event.clientX - speedDialBtn.getBoundingClientRect().left - speedDialBtn.clientWidth}px`;
      ripple.style.top = `${event.clientY - speedDialBtn.getBoundingClientRect().top - speedDialBtn.clientHeight}px`;
      speedDialBtn.appendChild(ripple);

      setTimeout(() => {
          ripple.remove();
      }, 500);
  });

    // Select all anchor links that point to sections within the page
    const links = document.querySelectorAll('a[href^="#"]');
  
    // Loop through each link and add event listener
    links.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default anchor link behavior
        const target = document.querySelector(this.getAttribute('href')); // Get the target section
        target.scrollIntoView({
          behavior: 'smooth', // Enable smooth scrolling
          block: 'start' // Scroll to the top of the target element
        });
      });
    });


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
    
          const target = document.querySelector(this.getAttribute('href'));
          
          window.scrollTo({
            top: target.offsetTop,
            behavior: 'smooth' // ทำให้การเลื่อนสมูท
          });
        });
      });

      
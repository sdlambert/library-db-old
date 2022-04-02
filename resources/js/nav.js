const smoothscroll = require('smoothscroll-polyfill');

smoothscroll.polyfill();

(function () {
  // Code by Jan Czizikow
  // https://codepen.io/hollow3d/pen/ENgvvX
  //
  // This code has been converted to vanilla Javascript by me :)

  // NAVIGATION LOGO
  document.querySelectorAll('.logo').forEach(function (el) {
    el.addEventListener('click', function (e) {
      document.querySelector('.nav-toggle').classList.remove('open');
      document.querySelector('.menu-left').classList.remove('collapse');
    });
  });

  // LINKS TO ANCHORS
  document.querySelectorAll('a[href^="#"]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      let target = document.querySelector(e.target.getAttribute('href'));
      if (target) {
        e.preventDefault();
        let targetEl = document.querySelector(target).scrollIntoView({behavior: 'smooth'});
      }
    });
  });

  // TOGGLE HAMBURGER & COLLAPSE NAV
  document.querySelectorAll('.nav-toggle').forEach(function (el) {
    el.addEventListener('click', function (e) {
      el.classList.toggle('open');
      document.querySelectorAll('.menu-left').forEach(function (el) {
        el.classList.toggle('collapse');
      });
    });
  });

  // REMOVE X & COLLAPSE NAV ON ON CLICK
  document.querySelectorAll('.menu-left a').forEach(function (el) {
    el.addEventListener('click', function (e) {
      document.querySelectorAll('.nav-toggle').forEach(function (el) {
        el.classList.remove('open');
      });
      document.querySelectorAll('.menu-left').forEach(function (el) {
        el.classList.remove('collapse');
      });
    });
  });

  // SCROLL TO TOP

  // SHOW/HIDE NAV

  // Hide Header on on scroll down
  let didScroll;
  let lastScrollTop = 0;
  let delta = 5;
  let header = document.querySelector('body > header');
  let scrollToTopButton = document.querySelector('#scroll-to-top');
  let navbarHeight = header.offsetHeight;

  window.addEventListener('scroll', e => {
    didScroll = true;
  })

  scrollToTopButton.addEventListener('click', e => {
    window.scroll({top: 0, left: 0, behavior: 'smooth'});
  });

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250, null);

  function hasScrolled() {
    var st = window.scrollY;

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
      return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down

      header.classList.remove('show-nav');
      header.classList.add('hide-nav');
      document.querySelectorAll('.nav-toggle').forEach(function (el) {
        el.classList.remove('open');
      });
      document.querySelectorAll('.menu-left').forEach(function (el) {
        el.classList.remove('collapse');
      });
      scrollToTopButton.classList.remove('is-hidden');

    } else {
      // Scroll Up
      if (st + window.innerHeight < document.body.clientHeight) {
        header.classList.remove('hide-nav');
        header.classList.add('show-nav');
        scrollToTopButton.classList.add('is-hidden');

      }
    }

    lastScrollTop = st;
  }
})();

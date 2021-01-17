import smoothscroll from 'smoothscroll-polyfill';

smoothscroll.polyfill();

(function () {
  // Code by Jan Czizikow
  // https://codepen.io/hollow3d/pen/ENgvvX
  //
  // This code has been converted to vanilla Javascript by me :)

  // NAVIGATION LOGO SCROLL TOP
  document.querySelectorAll('.logo').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector('.nav-toggle').classList.remove('open');
      document.querySelector('.menu-left').classList.remove('collapse');
      window.scroll({top: 0, left: 0, behavior: 'smooth'});
    });
  });

  // LINKS TO ANCHORS
  document.querySelectorAll('a[href^="#"]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      let target = e.target.getAttribute('href');
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

  // SHOW/HIDE NAV

  // Hide Header on on scroll down
  let didScroll;
  let lastScrollTop = 0;
  let delta = 5;
  let header = document.querySelectorAll('header')[0]
  let navbarHeight = header.offsetHeight;

  // $(window).scroll(function(event){
  //   didScroll = true;
  // });

  window.addEventListener('scroll', function (e) {
    didScroll = true;
  })

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

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
    } else {
      console.log({st, window: window.innerHeight, document: document.body.clientHeight});
      // Scroll Up
      if (st + window.innerHeight < document.body.clientHeight) {
        header.classList.remove('hide-nav');
        header.classList.add('show-nav');
      }
    }

    lastScrollTop = st;
  }
})();

require('datalist-polyfill');

(function() {

  /**
   * Finds all input elements and listens for errors, scrolling to the first
   * one it finds
   */
  function initScrollToError() {
    // Scroll to first error
    let invalidEventFound = false;
    const submitBookForm = document.querySelector('button[type="submit"]'),
          formInputs = document.querySelectorAll('input');

    if(submitBookForm) {
      formInputs.forEach(function (input) {
        input.addEventListener('bouncerShowError', function (e) {
          if (!invalidEventFound) {
            window.setTimeout(function () {
              window.scroll({
                top: e.target.offsetTop - 90,
                left: 0,
                behavior: 'smooth'
              });
            }, 10);
            invalidEventFound = true;
          }
        });
      });

      submitBookForm.addEventListener('click', function () {
        invalidEventFound = false;
      });
    }
  }

  document.addEventListener('DOMContentLoaded', initScrollToError)
})();


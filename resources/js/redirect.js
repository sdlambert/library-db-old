
(function () {
  document.addEventListener('DOMContentLoaded', function() {
    let el           = document.getElementById('seconds');
    let total        = el.innerHTML;
    let timeInterval = setInterval(countDown, 1000);

    function countDown () {
      total = --total;
      el.textContent = total;
      if (total <= 0) {
        clearInterval(timeInterval);
        window.location = "/";
      }
    }
  });
})();
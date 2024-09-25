document.addEventListener("DOMContentLoaded", function() {
  let loaderSection = document.querySelector('.loader-section');
  if (loaderSection) {
      loaderSection.classList.add('loaded');
  } else {
      console.error("No se encontró el elemento '.loader-section'");
  }
});
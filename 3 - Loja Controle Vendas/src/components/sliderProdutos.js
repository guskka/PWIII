document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("sliderContainer");
  const prevBtn = document.getElementById("btnPrev");
  const nextBtn = document.getElementById("btnNext");
  let currentIndex = 0;

  function updateSlider() {
    container.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
    } else {
      currentIndex = totalSlides - 1; // Vai para o último se estiver no primeiro
    }
    updateSlider();
  });

  nextBtn.addEventListener("click", () => {
    if (currentIndex < totalSlides - 1) {
      currentIndex++;
    } else {
      currentIndex = 0; // Volta para o primeiro se chegar no fim
    }
    updateSlider();
  });
});

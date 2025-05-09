(function () {
  function mettreAJourCheckbox() {
    const burgerBtn = document.querySelector(".entete__burger");
    const checkbox = document.querySelector("#chk__menu");

    if (burgerBtn && checkbox) {
      // Vérifie si le bouton burger est visible
      const style = window.getComputedStyle(burgerBtn);
      const isVisible = style.display !== "none";

      // Si le bouton est masqué (donc en mode desktop), décocher la case
      if (!isVisible) {
        checkbox.checked = false;
      }
    }
  }

  // Exécuter au chargement
  window.addEventListener("load", mettreAJourCheckbox);

  // Exécuter à chaque redimensionnement
  window.addEventListener("resize", mettreAJourCheckbox);
})();

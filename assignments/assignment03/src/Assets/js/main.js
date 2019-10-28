/**
 * Toggle opening of mobile menu.
 */
function toggleMobileMenu(e) {
  e.preventDefault();

  const mobileMenu = document.querySelector(
    '[data-behaviour="mobile-nav--content"]'
  );
  mobileMenu.classList.toggle('hidden');
}

/**
 * Main script will run after content has loaded.
 */
function main() {
  /**
   * Toggle Mobile Menu
   */
  const mobileMenuBtn = document.querySelector(
    '[data-behaviour="mobile-nav--btn"]'
  );
  mobileMenuBtn.addEventListener('click', toggleMobileMenu);
}

window.addEventListener('DOMContentLoaded', event => {
  main();
});

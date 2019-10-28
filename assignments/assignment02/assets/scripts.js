/**
 * Disable submit buttons and show progress spinner when forms are submitted.
 *
 * To use add <form ... data-behaviour="disable-submit" ...> to the form element and
 * <button type="submit" ... data-behaviour="disable-on-submit" ...> to the submit button.
 */
$(document).ready(function () {
  $('[data-behaviour="disable-submit"]').submit((_) => {
    const submitButton = $('[data-behaviour="disable-submit"] [data-behaviour="disable-on-submit"]');
    submitButton.attr('disabled', 'true');
    submitButton[0].innerHTML = '<i class="fas fa-spinner fa-spin"></i>'
  });
});

/**
 * Use custom Bootstrap plugin for File Upload input.
 *
 * https://github.com/Johann-S/bs-custom-file-input
 */
$(document).ready(function () {
  bsCustomFileInput.init()
});

/**
 * Add the display code querystring to the current URL.
 */
function showCodeLink() {
  const link = document.getElementById('display-code-link');
  if (link) {
    link.addEventListener('click', (e) => {
      e.preventDefault();

      if (window.location.search) {
        window.location.href += '&display-code=true';
      } else {
        window.location.href += '?display-code=true';
      }
    })
  }
}

showCodeLink();

/**
 * Check checkbox if <tr> element is clicked.
 */
$(document).ready(function () {
  $('[data-behaviour="check-box-checked"]').click(function () {
    const checkbox = $(this).find('[data-behaviour="checkbox"]');
    checkbox.prop('checked', !checkbox.prop('checked'));
  });
});

/**
 * Submit form if input is changed.
 */
$(document).ready(function () {
  $('[data-behaviour="submit-on-change"]').change(function () {
    this.form.submit();
  });
});

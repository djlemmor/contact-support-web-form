// Client-side validation logic
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Perform client-side validation
    if (validateForm()) {
      form.submit();
    }
  });

  function validateForm() {
    // Get the reCAPTCHA response value
    var captchaResponse = grecaptcha.getResponse();

    if (captchaResponse.length === 0) {
      // Show error message
      document.getElementById("captcha-error").textContent = "Please complete the reCAPTCHA";

      // Prevent form submission
      return false;
    }

    // Clear error message
    document.getElementById("captcha-error").textContent = "";

    // Allow form submission
    return true;
  }
});

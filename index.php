<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Contact Support Form</title>
</head>
<body>
  <body>
    <main class="contact">
      <div class="contact__container">
        <h1 class="contact__title">Contact Support</h1>
        <form action="includes/submit.php" method="post" class="contact__form">
          <div class="contact__field">
            <label for="fullname" class="contact__label">Full Name:</label>
            <input type="text" id="fullname" name="fullname" class="contact__input" required />
          </div>

          <div class="contact__field">
            <label for="email" class="contact__label">Email Address:</label>
            <input type="email" id="email" name="email" class="contact__input" required />
          </div>

          <div class="contact__field">
            <label for="mobile" class="contact__label">Mobile Number:</label>
            <input type="tel" id="mobile" name="mobile" class="contact__input" required />
          </div>

          <div class="contact__field">
            <label for="subject" class="contact__label">Subject:</label>
            <input type="text" id="subject" name="subject" class="contact__input" required />
          </div>

          <div class="contact__field">
            <label for="body" class="contact__label">Body:</label>
            <textarea id="body" name="body" class="contact__input" required></textarea>
          </div>

          <div class="contact__field">
            <div class="g-recaptcha contact__captcha" data-sitekey="6LfYmAMmAAAAAEIBmyM0V9d7-JxLyIyHCV1Pt4FP"></div>
            <span id="captcha-error" class="contact-form__error"></span>
          </div>

          <input type="submit" value="Submit" class="contact__submit" />
        </form>
         <?php
          if (isset($_GET['message']) && $_GET['message'] === 'success') {
            echo '<p class="success-message">Ticket submitted successfully!</p>';
          } else if (isset($_GET['message']) && $_GET['message'] === 'error') {
            echo '<p class="error-message">Something went wrong, Please try again later!</p>';
          }

          // Start the session
          session_start();

          // Check if there are any error messages in the session
          if (isset($_SESSION['errors'])) {
              // Display the error messages
              foreach ($_SESSION['errors'] as $error) {
                  echo '<p class="error-message">'.$error.'</p>';
              }
              
              // Clear the error messages from the session
              unset($_SESSION['errors']);
          }
        ?>
      </div>
    </main>
   

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/script.js"></script>
  </body>
</body>
</html>
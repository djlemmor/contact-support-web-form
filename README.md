# Contact Support Web Form

This is a simple contact support web form implemented using HTML, CSS, PHP, and JavaScript. It allows users to submit inquiries or concerns through a web form, which are then saved to a MySQL database for record-keeping and sent to an admin email address.

## Features

- User-friendly web form to submit inquiries or concerns.
- Google reCAPTCHA integration to prevent spam submissions.
- Input validation to ensure data integrity.
- Submitted tickets are saved to a MySQL database for record-keeping.
- Submitted tickets are sent to the admin email address for further processing.

## Installation

1. Clone the repository to your local machine.
2. Set up a MySQL database and import the provided SQL file to create the necessary table.
3. Update the database credentials in `submit.php` file to match your database configuration.
4. Obtain reCAPTCHA site key and secret key from the [reCAPTCHA website](https://www.google.com/recaptcha) and update the `data-sitekey` attribute in `index.php` file.
5. Upload the files to your web server or run a local development server.

## Usage

1. Access the contact form by opening `index.php` in a web browser.
2. Fill in the required fields (Full Name, Email Address, Mobile Number, Subject, Body).
3. Complete the reCAPTCHA verification.
4. Click the "Submit" button to submit the form.
5. Upon successful submission, the ticket will be saved to the database and sent to the admin email address.

## Credits

This project was created by DJ Lemmor Nuique.

## Contact

If you have any questions or need further assistance, please contact lemmornuique@gmail.com.

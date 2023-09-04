// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
  // Get the form element
  const form = document.querySelector(".php-email-form");

  // Attach the submit event listener to the form
  form.addEventListener("submit", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Form validation logic
    let isValid = true;

    // Get the input elements
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const subject = document.getElementById("subject");
    const message = document.querySelector("textarea[name='message']");

    // Get the error-message element
    const errorMessage = document.querySelector(".error-message");

    // Validation rules
    if (!name.value.trim()) {
      isValid = false;
      errorMessage.innerHTML = "Name is required.";
    } else if (!email.value.trim()) {
      isValid = false;
      errorMessage.innerHTML = "Email is required.";
    } else if (!validateEmail(email.value)) {
      isValid = false;
      errorMessage.innerHTML = "Enter a valid email address.";
    } else if (!subject.value.trim()) {
      isValid = false;
      errorMessage.innerHTML = "Subject is required.";
    } else if (!message.value.trim()) {
      isValid = false;
      errorMessage.innerHTML = "Message is required.";
    }

    // If the form is valid, submit it
    if (isValid) {
      form.submit();
    }
  });

  // Helper function to validate email address
  function validateEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(String(email).toLowerCase());
  }
});

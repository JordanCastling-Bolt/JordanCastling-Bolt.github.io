document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector(".php-email-form");

  form.addEventListener("submit", async function(event) {
    event.preventDefault();

    // Create an object to hold the form data
    const formObject = {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      subject: document.getElementById("subject").value,
      message: document.querySelector("textarea[name='message']").value,
    };

    try {
      // Send the POST request to the PHP script
      const response = await fetch('forms/contact.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formObject)
      });

      // Parse the JSON response from the PHP script
      const data = await response.json();

      // Check the status field in the response
      if (data.status === 'success') {
        alert('Message sent successfully');
      } else {
        alert('Failed to send message');
      }
    } catch (error) {
      console.error('Error:', error);
      alert('An error occurred');
    }
  });
});

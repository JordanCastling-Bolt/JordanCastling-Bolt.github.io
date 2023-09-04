document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector(".php-email-form");

  form.addEventListener("submit", async function(event) {
    event.preventDefault();

    const formData = new FormData(form);
    const formObject = {};

    formData.forEach((value, key) => formObject[key] = value);

    try {
      const response = await fetch('forms/contact.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formObject)
      });

      const data = await response.json();

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

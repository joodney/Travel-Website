function submitFeedback(event) {
  event.preventDefault();

  const form = document.forms["feedbackForm"];

  const data = {
    name: form.name.value,
    email: form.email.value,
    rating: form.rating.value,
    services: Array.from(form.querySelectorAll('input[name="services[]"]:checked')).map(cb => cb.value),
    preference: form.preference.value,
    message: form.message.value
  };

  fetch("/api/feedback.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(response => {
      alert(response.message);
    })
    .catch(err => {
      alert("Something went wrong.");
      console.error(err);
    });

  return false;
}

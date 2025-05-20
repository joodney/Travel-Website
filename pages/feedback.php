<?php include('../includes/header.php'); ?>

<main>
  <section class="feedback-section gradient-section">
    <h2>How was your experience?</h2>
    <p>We'd love to hear your thoughts.</p>

    <form id="feedbackForm" class="feedback-form" name="feedbackForm" onsubmit="return submitFeedback(event)">
      <fieldset>
        <legend>Personal Info</legend>

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />
      </fieldset>

      <fieldset>
        <legend>Experience & Preferences</legend>

        <label>How was your overall experience?</label>
        <div class="rating-options">
          <label><input type="radio" name="rating" value="Good" required /> Good</label>
          <label><input type="radio" name="rating" value="Average" /> Average</label>
          <label><input type="radio" name="rating" value="Poor" /> Poor</label>
        </div>

        <label>Which services did you use?</label>
        <div class="checkbox-options">
          <label><input type="checkbox" name="services[]" value="Custom Travel Plans" /> Custom Travel Plans</label>
          <label><input type="checkbox" name="services[]" value="Guided Tours" /> Guided Tours</label>
          <label><input type="checkbox" name="services[]" value="Hotel Booking" /> Hotel & Flight Booking</label>
          <label><input type="checkbox" name="services[]" value="Local Experiences" /> Local Experiences</label>
        </div>

        <label for="preference">What type of trip do you enjoy the most?</label>
        <select id="preference" name="preference" required>
          <option value="" disabled selected>Select your preference</option>
          <option value="Beach">Relaxing on a Beach</option>
          <option value="Adventure">Adventure & Exploration</option>
          <option value="City">City Sightseeing</option>
          <option value="Cultural">Cultural & Historical Tours</option>
          <option value="Nature">Nature & Scenic Trips</option>
        </select>

        <label for="message">Additional comments or suggestions:</label>
        <textarea id="message" name="message" rows="5" placeholder="We’d love to hear your thoughts!"></textarea>
      </fieldset>

      <button type="submit">Send Feedback</button>
    </form>
  </section>
</main>

<?php include('../includes/footer.php'); ?>

<!-- Scripts -->
<script src="../validation.js"></script>
<script>
  async function submitFeedback(event) {
    event.preventDefault();

    if (!validateForm()) {
      return false; // من ملف validation.js
    }

    const form = document.getElementById("feedbackForm");
    const formData = new FormData(form);
    const services = formData.getAll("services[]");

    const data = {
      name: formData.get("name"),
      email: formData.get("email"),
      rating: formData.get("rating"),
      services: services,
      preference: formData.get("preference"),
      message: formData.get("message")
    };

    try {
      const response = await fetch("../api/feedbackapi.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (result.status === "success") {
        alert("Thank you! Your feedback was submitted successfully.");
        form.reset();
      } else {
        alert("Error: " + result.message);
      }
    } catch (error) {
      console.error(error);
      alert("Something went wrong while submitting your feedback.");
    }

    return false;
  }
</script>

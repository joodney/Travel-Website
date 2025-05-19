<?php include('includes/header.php'); ?>

<main>
  <section class="feedback-section gradient-section">
    <h2>How was your experience?</h2>
    <p>We'd love to hear your thoughts.</p>

    <form class="feedback-form" name="feedbackForm" onsubmit="return submitFeedback(event)">
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

<script>
  async function submitFeedback(event) {
    event.preventDefault();

    const form = document.forms["feedbackForm"];
    const name = form["name"].value;
    const email = form["email"].value;
    const rating = form["rating"].value;
    const preference = form["preference"].value;
    const message = form["message"].value;

    const services = Array.from(form.querySelectorAll('input[name="services[]"]:checked'))
                          .map(cb => cb.value);

    const data = { name, email, rating, services, preference, message };

    try {
      const res = await fetch("/api/feedback.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });

      const result = await res.json();
      if (result.status === "success") {
        alert("Thank you! Your feedback was submitted.");
        form.reset();
      } else {
        alert("Error: " + result.message);
      }
    } catch (err) {
      alert("Something went wrong. Try again later.");
      console.error(err);
    }

    return false;
  }
</script>

<script src="../validation.js"></script>
<?php include('includes/footer.php'); ?>

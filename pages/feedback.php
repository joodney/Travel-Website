<?php include('includes/header.php'); ?>

<main>
  <section class="feedback-section gradient-section">
    <h2>How was your experience?</h2>
    <p>We'd love to hear your thoughts.</p>

    <form class="feedback-form" name="feedbackForm" onsubmit="return submitFeedback(event)">
      <fieldset>
        <legend>Personal Info</legend>

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required />
      </fieldset>

      <fieldset>
        <legend>Experience & Preferences</legend>

        <label>How was your overall experience?</label>
        <div>
          <label><input type="radio" name="rating" value="Good" required /> Good</label>
          <label><input type="radio" name="rating" value="Average" /> Average</label>
          <label><input type="radio" name="rating" value="Poor" /> Poor</label>
        </div>

        <label>Which services did you use?</label>
        <div>
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
        <textarea id="message" name="message" rows="5"></textarea>
      </fieldset>

      <button type="submit">Send Feedback</button>
    </form>

    <div id="responseMessage" style="margin-top: 20px; font-weight: bold;"></div>
  </section>
</main>

<script>
  function submitFeedback(event) {
    event.preventDefault();

    const form = document.forms["feedbackForm"];
    const name = form["name"].value;
    const email = form["email"].value;
    const rating = form["rating"].value;
    const preference = form["preference"].value;
    const message = form["message"].value;

    // Get all checked services
    const services = [];
    form.querySelectorAll('input[name="services[]"]:checked').forEach((checkbox) => {
      services.push(checkbox.value);
    });

    const data = {
      name,
      email,
      rating,
      preference,
      message,
      services
    };

    fetch("/api/feedback.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    })
    .then((res) => res.json())
    .then((res) => {
      const msg = document.getElementById("responseMessage");
      if (res.status === "success") {
        msg.style.color = "green";
        msg.textContent = "✅ " + res.message;
        form.reset(); // clear form
      } else {
        msg.style.color = "red";
        msg.textContent = "❌ " + res.message;
      }
    })
    .catch((err) => {
      document.getElementById("responseMessage").textContent = "An error occurred.";
      console.error(err);
    });

    return false; // prevent default form submit
  }
</script>

<?php include('includes/footer.php'); ?>

<?php include('../includes/header.php'); ?>

<main>

  <!-- What They Say About Us -->
  <section class="testimonials-section gradient-section">
    <div class="container">
      <h2>What they say about us</h2>
      <div id="testimonialList" class="testimonial-grid">
        <!-- Feedback cards will appear here -->
      </div>
    </div>
  </section>

  <script>
    async function loadHomeFeedback() {
      const container = document.getElementById("testimonialList");
      try {
        const res = await fetch("/api/feedback.php");
        const data = await res.json();

        if (data.length === 0) {
          container.innerHTML = "<p>No feedback yet.</p>";
          return;
        }

        const latest = data.slice(0, 3);
        const html = latest.map(entry => `
          <div class="testimonial-card">
            <strong>${entry.name}</strong>
            <small>${entry.rating} – ${entry.preference}</small>
            <p>"${entry.comments}"</p>
          </div>
        `).join("");

        container.innerHTML = html;
      } catch (err) {
        container.innerHTML = "<p style='color:red;'>❌ Failed to load feedback.</p>";
        console.error(err);
      }
    }

    window.onload = loadHomeFeedback;
  </script>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h2>Explore the Saudi Arabia with Confidence</h2>
      <p>Discover Saudi Arabia, get insider tips, and plan your next journey.</p>
      <a href="services.php" class="btn hero-btn">Start Exploring</a>
    </div>
  </section>

  <!-- Featured Destinations Section -->
  <section class="destinations">
    <h2>Featured Destinations In Saudi Arabia</h2>
    <div class="destinations-grid">

      <a href="video.php" class="destination-link">
        <article class="destination-card">
          <img src="../joodImages/Riyadh.jpeg" alt="Riyadh" />
          <h3>Riyadh</h3>
          <p>Discover the capital, brimming with elegance and sophistication.</p>
        </article>
      </a>

      <a href="video.php" class="destination-link">
        <article class="destination-card">
          <img src="../joodImages/Dammam.jpg" alt="Dammam" />
          <h3>Dammam</h3>
          <p>Discover the capital, brimming with elegance and sophistication.</p>
        </article>
      </a>

      <a href="video.php" class="destination-link">
        <article class="destination-card">
          <img src="../joodImages/Jeddah.jpg" alt="Jeddah" />
          <h3>Jeddah</h3>
          <p>Come for the beaches, stay for the vibrant nightlife and cultural fusion.</p>
        </article>
      </a>

    </div>
  </section>

  <!-- About / Info Section -->
  <section class="about">
    <div class="about-content">
      <h2>About Our Travel Guide</h2>
      <p>
        We’re dedicated to helping you plan unforgettable trips in Saudi Arabia. From hidden gems 
        to top-rated destinations, our experts bring you the best travel advice so 
        you can experience the beauty of Saudi Arabia to the fullest!
      </p>
    </div>
  </section>

</main>

<?php include('../includes/footer.php'); ?>

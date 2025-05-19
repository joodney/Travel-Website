<?php include('../includes/header.php'); ?>

<main>
  <section class="gradient-section" style="padding: 4rem 2rem;">
    <h2 style="text-align: center; margin-bottom: 30px;">Travel Packages</h2>
    <p style="text-align: center; margin-bottom: 40px;">
      Explore our curated travel packages, each crafted to provide a unique and unforgettable experience.
    </p>

    <div style="overflow-x:auto;">
      <table style="width:100%; border-collapse: collapse; background-color: #fff;">
        <thead style="background-color: var(--color1); color: #fff;">
          <tr>
            <th style="padding: 12px; border: 1px solid #ccc;">Package Name</th>
            <th style="padding: 12px; border: 1px solid #ccc;">City</th>
            <th style="padding: 12px; border: 1px solid #ccc;">Duration</th>
            <th style="padding: 12px; border: 1px solid #ccc;">Activities</th>
            <th style="padding: 12px; border: 1px solid #ccc;">VIP Price (SAR)</th>
            <th style="padding: 12px; border: 1px solid #ccc;">Standard Price (SAR)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // الاتصال بقاعدة البيانات باستخدام environment variables
          $host = getenv("MYSQL_ADDON_HOST");
          $db = getenv("MYSQL_ADDON_DB");
          $user = getenv("MYSQL_ADDON_USER");
          $pass = getenv("MYSQL_ADDON_PASSWORD");

          $conn = new mysqli($host, $user, $pass, $db);
          if ($conn->connect_error) {
              echo "<tr><td colspan='6'>❌ Failed to connect to database.</td></tr>";
              exit();
          }

          $query = "
            SELECT 
              p.package_name,
              c.city_name,
              p.duration,
              p.activities,
              p.price_vip,
              p.price_standard
            FROM packages p
            JOIN cities c ON p.city_id = c.city_id
            ORDER BY p.package_id DESC
          ";

          $result = $conn->query($query);
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . htmlspecialchars($row['package_name']) . "</td>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . htmlspecialchars($row['city_name']) . "</td>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . htmlspecialchars($row['duration']) . "</td>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . htmlspecialchars($row['activities']) . "</td>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>SAR " . number_format($row['price_vip'], 2) . "</td>";
                  echo "<td style='padding: 10px; border: 1px solid #ccc;'>SAR " . number_format($row['price_standard'], 2) . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No travel packages found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<?php include('../includes/footer.php'); ?>

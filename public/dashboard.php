<?php
// Include the database connection file
include '../src/config/db_connection.php';

// Fetch customers
$customers = [];
$result = $conn->query("SELECT * FROM customers");
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $customers[] = $row;
  }
}

// Fetch events
$events = [];
$result = $conn->query("SELECT * FROM events");
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $events[] = $row;
  }
}

// Fetch reviews
$reviews = [];
$result = $conn->query("SELECT * FROM reviews");
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
  }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
  .circle-progress {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 100px;
  }

  .circle-progress svg {
    transform: rotate(-90deg);
  }

  .circle-progress circle {
    fill: none;
    stroke-width: 10;
  }

  .circle-progress circle.track {
    stroke: #e2e8f0;
    /* Gray 200 */
  }

  .circle-progress circle.fill {
    stroke: #fbbf24;
    /* Amber 400 */
    stroke-dasharray: 314;
    /* 2πr, where r = 50 - stroke-width/2 */
    stroke-dashoffset: calc(314 - (314 * var(--progress)) / 100);
    transition: stroke-dashoffset 0.5s;
  }

  .circle-progress .percentage {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.25rem;
    font-weight: bold;
  }
</style>

<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-gray-800 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#" class="text-lg font-bold">Event Extravaganza Dashboard</a>
      <div class="flex space-x-4">
        <a href="#" class="hover:text-yellow-400">Home</a>
        <a href="#customers" class="hover:text-yellow-400">Customers</a>
        <a href="#events" class="hover:text-yellow-400">Events</a>
        <a href="#reviews" class="hover:text-yellow-400">Reviews</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mx-auto mt-8 space-y-8 px-12">
    <!-- Customers Table -->
    <div>
      <h2 class="text-xl font-bold text-gray-700 mb-4" id="customers">Customers</h2>
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="table-auto w-full text-left border-collapse">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 border">ID</th>
              <th class="px-4 py-2 border">Name</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Phone</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $customer): ?>
              <tr class="border-t">
                <td class="px-4 py-2 border"><?= htmlspecialchars($customer['customer_id']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($customer['name']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($customer['email']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($customer['phone_number']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Events Table -->
    <div>
      <h2 class="text-xl font-bold text-gray-700 mb-4" id="events">Events</h2>
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="table-auto w-full text-left border-collapse">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 border">Event ID</th>
              <th class="px-4 py-2 border">Customer ID</th>
              <th class="px-4 py-2 border">Event Type</th>
              <th class="px-4 py-2 border">Event Date</th>
              <th class="px-4 py-2 border">Guests</th>
              <th class="px-4 py-2 border">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($events as $event): ?>
              <tr class="border-t">
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['event_id']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['customer_id']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['event_type']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['event_date']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['guest_count']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($event['event_location']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Reviews Table -->
    <div>
      <h1 class="text-2xl font-bold text-gray-700 mb-6" id="reviews">Customer Reviews</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($reviews as $review): ?>
          <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
            <div class="circle-progress mb-4" style="--progress: <?= htmlspecialchars($review['rating']) * 20 ?>;">
              <svg width="100" height="100">
                <circle class="track" cx="50" cy="50" r="45"></circle>
                <circle class="fill" cx="50" cy="50" r="45"></circle>
              </svg>
              <div class="percentage"><?= htmlspecialchars($review['rating']) ?> / 5</div>
            </div>
            <h2 class="text-lg font-semibold text-gray-700"><?= htmlspecialchars($review['name']) ?></h2>
            <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($review['email']) ?></p>
            <p class="text-gray-600 text-center"><?= htmlspecialchars($review['review']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>



  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center p-4 mt-8">
    &copy; 2024 Event Extravaganza. All rights reserved.
  </footer>

</body>

</html>
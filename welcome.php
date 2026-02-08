<?php
// 1. SESSION PERSISTENCE (30 Days) - Must be at the very top
ini_set('session.cookie_lifetime', 2592000); 
ini_set('session.gc_maxlifetime', 2592000);   
session_start();

// 2. NO-CACHE HEADERS
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// 3. AUTHENTICATION CHECK
// If the session isn't set, send them back to index.html
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - Medical Prescription App</title>
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#0d6efd">
  <style>
    body { font-family: 'Times New Roman', Times, serif; margin: 20px; background-color: #f9f9f9; }
    .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; }
    h1, h2 { text-align: center; }
    .welcome-message { font-size: 1.1em; color: green; text-align: center; margin-bottom: 20px; }
    button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer; margin-bottom: 10px; font-size: 16px; border-radius: 4px; }
    button:hover { background-color: #218838; }
    .logout-button { background-color: #dc3545; }
    .logout-button:hover { background-color: #c82333; }
  </style>
</head>
<body>

<div class="container">
  <h1>Medical Prescription App</h1>

  <div class="welcome-message">
    <?php
      // Using 'username' since it's common across our files, 
      // or change back to 'name' if that's what your DB stores.
      $displayName = isset($_SESSION['name']) ? $_SESSION['name'] : 'User';
      echo "Glad to see you again, " . htmlspecialchars($displayName) . "!";
    ?>
  </div>

  <button onclick="location.href='ptdrug.php'">
    Write a prescription
  </button>

  <button class="logout-button" onclick="logoutSafely()">
    Logout
  </button>
</div>

<script>
function logoutSafely() {
  // 1. Unregister Service Workers
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(registrations => {
      for(let registration of registrations) {
        registration.unregister();
      }
    });
  }

  // 2. Clear Caches
  if ('caches' in window) {
    caches.keys().then(keys => {
      keys.forEach(key => caches.delete(key));
    });
  }

  // 3. Clear Storage
  localStorage.clear();
  sessionStorage.clear();

  // 4. Final Redirect to logout script
  setTimeout(() => {
    window.location.href = 'logout.php';
  }, 500);
}

// Keep Service Worker v7 active
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function () {
    navigator.serviceWorker.register('/service-worker.js')
      .then(reg => console.log('v7 ready'))
      .catch(err => console.log('SW fail', err));
  });
}
</script>

</body>
</html>

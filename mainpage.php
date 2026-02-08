<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page - Al-Kawaz Clinic</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      width: 100%;
      max-width: 400px;
      background: #fff;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      text-align: center;
      /* Responsive fix for rotation */
      max-height: 90vh;
      overflow-y: auto;
    }

    h1 {
      color: #333;
      font-size: 1.5rem;
      margin-bottom: 25px;
      border-bottom: 2px solid #6698fd;
      padding-bottom: 10px;
    }

    /* Menu Button Styling */
    .menu-btn {
      width: 100%;
      padding: 15px;
      margin-bottom: 12px;
      background-color: #6698fd;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      font-size: 16px;
      transition: background 0.3s, transform 0.2s;
      display: block;
      text-decoration: none; /* In case you use <a> tags */
    }

    .menu-btn:hover {
      background-color: #3376fe;
      transform: translateY(-2px);
    }

    /* Logout Style (Red) */
    .logout-btn {
      background-color: #ff4d4d;
      margin-top: 15px;
    }

    .logout-btn:hover {
      background-color: #e60000;
    }

    /* Landscape Mode optimization */
    @media (max-height: 500px) and (orientation: landscape) {
      .container {
        max-width: 500px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
      }
      h1 { grid-column: span 2; }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Main Page</h1>

    <button class="menu-btn" onclick="location.href='new_patient.php'">New Patient</button>
    
    <button class="menu-btn" onclick="location.href='new_visit.php'">New visit for registered Patient</button>
    
    <button class="menu-btn" onclick="location.href='edit_patient.php'">Edit Patient information</button>
    
    <button class="menu-btn" onclick="location.href='appointments.php'">Give Appointment</button>
    
    <button class="menu-btn" onclick="location.href='recall_today.php'">Recall Todays Appointments</button>

    <button class="menu-btn logout-btn" onclick="logoutUser()">Logout</button>
  </div>

  <script>
    // Security check: If not logged in, redirect to login page
    if (!localStorage.getItem('loggedInUser')) {
      window.location.href = "login.html";
    }

    function logoutUser() {
      localStorage.removeItem('loggedInUser');
      window.location.href = "index.html";
    }
  </script>

</body>
</html>

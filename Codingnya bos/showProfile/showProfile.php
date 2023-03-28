<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>User Profile</h1>
      <div class="profile">
        <?php
          // Connect to the database
          $conn = mysqli_connect('localhost', 'username', 'password', 'smarthopeprofile');
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Get the user's information from the database
          $user_id = 1; // Replace with the user's ID
          $sql = "SELECT * FROM users WHERE id = $user_id";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          // Display the user's information
          echo "<img src='".$row['profile_pic']."' alt='Profile Picture'>";
          echo "<h2>".$row['name']."</h2>";
          echo "<p>".$row['email']."</p>";
          echo "<p>".$row['bio']."</p>";

          // Close the database connection
          mysqli_close($conn);
        ?>
      </div>
    </div>
  </body>
</html>

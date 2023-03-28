<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SmartHopeProfile";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];

// Update user's profile information
$sql = "UPDATE users SET password='$password', fullname='$fullname', email='$email' WHERE username='$username'";
if (mysqli_query($conn, $sql)) {
  echo "Profile updated successfully";
} else {
  echo "Error updating profile: " . mysqli_error($conn);
}

// Upload profile picture
if ($_FILES['profile_picture']['name'] != "") {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check if image file is a actual image or fake image
  if(getimagesize($_FILES['profile_picture']['tmp_name']) !== false) {
    if (in_array($imageFileType,$extensions_arr)) {
      if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
        // Update user's profile picture
        $profile_picture = $target_file;
        $sql = "UPDATE users SET profile_picture='$profile_picture' WHERE username='$username'";
        if (mysqli_query($conn, $sql)) {
          echo "Profile picture updated successfully";
        } else {
          echo "Error updating profile picture: " . mysqli_error($conn);
        }
      } else {
        echo "Error uploading file";
      }
    } else
?>

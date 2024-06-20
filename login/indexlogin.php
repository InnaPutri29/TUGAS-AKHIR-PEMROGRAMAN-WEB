<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="stylelogin.css" />
</head>

<body>
  <div class="login-header">
    <h2>Login Game</h2>
  </div>
  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
      <div class="username">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" />
        <span class="error" id="usernameError"></span>
      </div>
      <div class="password">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <span class="error" id="passwordError"></span>
      </div>
      <div class="btn-submit">
        <input type="submit" value="Login" />
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var usernameError = document.getElementById("usernameError");
      var passwordError = document.getElementById("passwordError");
      var valid = true;

      // Validasi field tidak boleh kosong
      if (username.trim().length === 0) {
        usernameError.textContent = "Username harus diisi";
        valid = false;
      } else {
        usernameError.textContent = "";
      }

      if (password.trim().length === 0) {
        passwordError.textContent = "Password harus diisi";
        valid = false;
      } else {
        passwordError.textContent = "";
      }

      // Validasi hanya huruf untuk username dan password
      var letters = /^[A-Za-z]+$/;
      if (!username.match(letters)) {
        usernameError.textContent = "Username hanya boleh berisi huruf";
        valid = false;
      }

      if (!password.match(letters)) {
        passwordError.textContent = "Password hanya boleh berisi huruf";
        valid = false;
      }

      return valid;
    }
  </script>

  <?php

  // Koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "pemrograman_web");
  $query = "SELECT * FROM user";
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
  }


  // Validasi sisi server
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // nama
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      $valid_password = $row['password'];

      if ($password === $valid_password) {
        // Set session
        session_start();
        $_SESSION['login'] = true;
        echo "<script>
            alert('Selamat datang, $username!');
          </script>";

        // Redirect ke halaman lain
        header("Location: game.php");
      }
    }

    echo "<script>
          alert('Login gagal, Silakan masukkan username dan password yang benar');
        </script>";
  }
  ?>

</body>

</html>
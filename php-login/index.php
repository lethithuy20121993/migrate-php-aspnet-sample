<?php
// Start output buffering
ob_start();

// Path to user storage file
$usersFile = 'users.json';
include 'popup.html';



// Read data from json file
function getUsers() {
    global $usersFile;
    if (file_exists($usersFile)) {
        return json_decode(file_get_contents($usersFile), true);
    }
    return [];
}

// save user info into json file
function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

// check login action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    // for login action
    if ($_POST['action'] == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // get users list from json file
        $users = getUsers();

        // check login info
        $found = false;
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $found = true;
                header('Location: success.php');
                exit;
            }
        }

        if (!$found) {
          echo "<script>showPopup('Login failed. Please try again.');</script>";
        }
    } elseif ($_POST['action'] == 'signup') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // check email is exist
        $users = getUsers();
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                echo "<script>showPopup('Email already exists.');</script>";
                exit;
            }
        }

        // Add new user into list
        $users[] = ['email' => $email, 'username' => $username, 'password' => $password];

        // Save into json file
        saveUsers($users);

        echo "<script>showPopup('Sign up successful!');</script>";
    } else {
      echo "<script>showPopup('No action');</script>";
    }
}

// End output buffering and flush
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Signup</title>
  <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
  <div class="container">
    <div class="side-1">
      <div class="header">
        <h2 class="h-main">Welcome Back!</h2>
        <p class="h-sec">Please log in with your username and password</p>
        <button class="toggle-log">SIGN UP</button>
      </div>
    </div>
    <div class="side-2">
      <div class="header">
        <h2 class="h-main">Hey there!</h2>
        <p class="h-sec">Enter your personal details and start today!</p>
        <button class="toggle-log">SIGN IN</button>
      </div>
    </div>
    <div class="forms">
      <div class="sign-up">
        <div class="form">
          <fieldset class="block">
            <h2 class="form-h">Sign up</h2>
            <div class="log-buttons"><a class="log-btn log-fb" href="#"></a><a class="log-btn log-gp" href="#"></a><a class="log-btn log-li" href="#"></a></div>
            <form method="POST" action="/">
              <input type="hidden" name="action" value="signup" />
              <input class="input-text" placeholder="Email" name="email" type="email" />
              <input class="input-text" placeholder="Username" type="text" name="username" />
              <input class="input-text" placeholder="Password" name="password" type="password" />
              <input class="input-submit" type="submit" value="SIGN UP" />
            </form>
          </fieldset>
        </div>
      </div>
      <div class="sign-in">
        <div class="form">
          <fieldset>
            <h2 class="form-h">Sign in</h2>
            <div class="log-buttons"><a class="log-btn log-fb" href="#"></a><a class="log-btn log-gp" href="#"></a><a class="log-btn log-li" href="#"></a></div>
            <form method="POST" action="/">
              <input type="hidden" name="action" value="login" />
              <input class="input-text" placeholder="Email" type="email" name="email" required />
              <input class="input-text" placeholder="Password" type="password" name="password" required/><a class="forgot" href="#">Forgot your password?</a>
              <input class="input-submit" type="submit" value="SIGN IN" />
            </form>
          </fieldset>
        </div>
      </div>
    </div>
  </div>

  <!-- Include your JavaScript -->
  <script src="js/index.js"></script>
</body>
</html>
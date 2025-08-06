<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #563a5aff; 
      padding: 20px;
    }

    .container {
      background: #fff;
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      border: 2px solid #0c59a7ff; 
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .error {
      color: red;
      font-size: 0.9em;
    }

    .input-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #58890aff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #aa1917ff;
    }

    .output {
      margin-top: 20px;
      background: #e3f2fd;
      padding: 15px;
      border-left: 5px solid #845b14ff;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Contact Form</h2>

  <?php
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data) {
      return htmlspecialchars(stripslashes(trim($data)));
    }

    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (!empty($_POST["website"])) {
      $website = test_input($_POST["website"]);
      if (!preg_match("/\b(?:https?|ftp):\/\/\S+/i", $website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (!empty($_POST["comment"])) {
      $comment = test_input($_POST["comment"]);
    }

    if (!empty($_POST["gender"])) {
      $gender = test_input($_POST["gender"]);
    } else {
      $genderErr = "Gender is required";
    }
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="input-group">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo $name;?>">
      <span class="error"><?php echo $nameErr;?></span>
    </div>

    <div class="input-group">
      <label>Email:</label>
      <input type="text" name="email" value="<?php echo $email;?>">
      <span class="error"><?php echo $emailErr;?></span>
    </div>

    <div class="input-group">
      <label>Website:</label>
      <input type="text" name="website" value="<?php echo $website;?>">
      <span class="error"><?php echo $websiteErr;?></span>
    </div>

    <div class="input-group">
      <label>Comment:</label>
      <textarea name="comment" rows="5"><?php echo $comment;?></textarea>
    </div>

    <div class="input-group">
      <label>Gender:</label>
      <input type="radio" name="gender" value="female" <?php if ($gender=="female") echo "checked";?>> Female
      <input type="radio" name="gender" value="male" <?php if ($gender=="male") echo "checked";?>> Male
      <input type="radio" name="gender" value="other" <?php if ($gender=="other") echo "checked";?>> Other
      <span class="error"><?php echo $genderErr;?></span>
    </div>

    <input type="submit" name="submit" value="Submit">
  </form>

  <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameErr && !$emailErr && !$genderErr && !$websiteErr): ?>
    <div class="output">
      <h3>Your Input:</h3>
      <p><strong>Name:</strong> <?php echo $name;?></p>
      <p><strong>Email:</strong> <?php echo $email;?></p>
      <p><strong>Website:</strong> <?php echo $website;?></p>
      <p><strong>Comment:</strong> <?php echo $comment;?></p>
      <p><strong>Gender:</strong> <?php echo $gender;?></p>
    </div>
  <?php endif; ?>
</div>

</body>
</html>

<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper wrapper_login">
    <section class="form login">
      <div class="login_form">
        <!-- <header>Advocate Chat App</header> -->
        <div class="login-logo">
          <a href="https://app.youradvocate.ae/admin/">
            <img src="https://app.youradvocate.ae/images/your_advocates_logo.png" alt="Logo">
            Your Advocate 
          </a>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
          <div class="field input">
            <label>Username</label>
            <input type="text" name="email" class="form-control login_input" placeholder="Enter your email" required>
          </div>
          <div class="field input">
            <label>Password</label>
            <input type="password" name="password" class="form-control login_input" placeholder="Enter your password" required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" name="submit" class="sign_in_btn" value="Sign In">
          </div>
        </form>
      </div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>

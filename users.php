<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper wrapper_users">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM kn_users WHERE id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="<?php echo getUserImagePath($row) ?>" alt="">
          <div class="details">
            <span><?php echo $row['name'] ?></span>
            <p><?php echo $row['chat_status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search active_chat"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>
  <div class="wrapper wrapper_chats">
    <?php if(isset($_GET['user_id'])){ ?>
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM kn_users WHERE id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo getUserImagePath($row) ?>" alt="">
        <div class="details">
          <span><?php echo $row['name'] ?></span>
          <p><?php echo $row['chat_status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area position-relative">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="file" class="attachment" id="attachment" name="attachment" value="" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <span class="attachment_clip"><i class="fas fa-paperclip"></i></span>
        <button class="orange_background"><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
    <?php }else{ ?>
      <section class="chat-area no_chats d-flex justify-content-center align-items-center">
          <p>Welcome to chat system</p>
          <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id ?? ''; ?>" hidden>
          </form>
    </section>
    <?php } ?>
  </div>

  <script>
    let attach = document.querySelector('.attachment_clip');
    attach.addEventListener('click', function(e) {
       e.preventDefault();
       document.getElementById('attachment').click();

       
})
  </script>

  <script src="javascript/users.js"></script>
  <script src="javascript/chat.js"></script>

  

</body>
</html>

<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="../icon/4.ico"/>
    <title>ICON | Password Reset</title>
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
    <link rel="stylesheet" href="../css/block.css">
  </head>

  <body>    
    <div class="head">

      <!-- Icon -->   
      <div class="icon">
        ICON
      </div>    
    </div>

    
    <!-- this is the form box -->
    <div class="box">
      <!-- the form -->
      <div class="header">
        Reset Password
      </div>
      <div class="info">
        <form action="../php/forgettery.php" method="POST">
          <input type="text" name="login" class="field" placeholder="Username" required>
          <input type="password" name="new_password" class="field" placeholder="New Password" required>
          <input type="password" name="repeat" class="field" placeholder="Repeat Password" required>
          <input type="submit" name="submit" value="Reset" class="form">
        </form>
      </div>            
      <!-- <hr class="the-line">   -->
    </div>
    <!-- the foot -->
    <div class="foot">
      <div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
      <div class="me">@gstrauss gstrauss18@gmail.com</div>
      <div class="copyright">Copyright© 2019</div>
    </div>
  </body>
</html>
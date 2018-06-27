<header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">Quotes</h3>
      <nav class="nav nav-masthead justify-content-center">
      <?php
        if(isset($_SESSION['current_user_id'])){
          echo '<a class="nav-link" href="../controllers/GetQuotes.php">Quotes</a>';
          echo '<a class="nav-link" href="../controllers/Logout.php">Logout</a>';
         } else{
          echo '<a class="nav-link" href="./Register.php">Register</a>';
          echo '<a class="nav-link" href="./Login.php">Login</a>';
        }
      ?>
      </nav>
    </div>
</header>
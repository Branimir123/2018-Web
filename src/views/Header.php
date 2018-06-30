<link rel="stylesheet" href="../assets/css/menu.css" />
<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand"></h3>
      <nav id="nav">
        <ul>
            <?php
                if(isset($_SESSION['current_user_id'])){
                echo '<li>
                    <span class="submenu">Quotes</span>
                    <ul class="submenu">
                        <li>
                            <a class="nav-link" href="../controllers/GetAllQuotes.php">All quotes</a>
                        </li>
                        <li>
                            <a class="nav-link" href="../controllers/GetAllByDate.php">Newest</a>
                        </li>
                    </ul>
                </li>';
                echo '<li><a class="nav-link" href="../views/CreateQuote.php">Add Quote</a></li>';
                echo '<li class="right"><a class="nav-link" href="../controllers/Logout.php">Logout</a></li>';
                } else {
                echo '<li>
                    <span class="submenu">Quotes</span>
                    <ul class="submenu">
                        <li>
                            <a class="nav-link" href="../controllers/GetAllQuotes.php">All quotes</a>
                        </li>
                        <li>
                            <a class="nav-link" href="../controllers/GetAllByDate.php">Newest</a>
                        </li>
                    </ul>
                </li>';
                echo '<li class="right"><a class="nav-link" href="./Register.php">Register</a></li>';
                echo '<li class="right"><a class="nav-link" href="./Login.php">Login</a></li>';
                }
            ?>
        </ul>
      </nav>
    </div>
</header>
<script src="../assets/js/menu.js"></script>

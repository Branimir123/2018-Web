<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/form.css">

    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                        <div class="error">
                            <?php 
                                include './Header.php';
                            ?>
                        </div>
                        <section id="login-banner" class="banner">
                            <div class="form-container">
                                <form id="contact" method="post" action="../controllers/Login.php">
                                    <h3>Login</h3>
                                    <?php
                                        if(isset($_GET['message'])) {
                                            echo '<h4 class="error">' . $_GET['message'] . '</h4>';
                                        }
                                    ?>             
                               
                                    <fieldset>
                                        <input type="text" name="username" id="username" placeholder="Username" required />
                                        <div class="error">
                                            <?php if(isset($_GET['username']) && $_GET['username'] == 'false'):?>
                                                Username is required.
                                            <?php endif?>
                                        </div>
                                    </fieldset>
                                
                                    <fieldset>
                                        <input type="password" name="password" id="password" placeholder="Password" required/>
                                        <div class="error">
                                            <?php if(isset($_GET['password']) && $_GET['password'] == 'false'):?>
                                                Password is required.
                                            <?php endif?>
                                        </div>
                                    </fieldset>
                                
                                    <button type="submit"> Login </button>
                                    <span>You don't have an account? </span>
                                    <span>
                                        <a href="../views/Register.php"> Sign up</a>. It's free!
                                    </span>
                                </form>
                            </div>
                        </section>
                </div>
            </div>
        </div>

        <script src="../assets/js/main.js"></script>
    </body>
</html>
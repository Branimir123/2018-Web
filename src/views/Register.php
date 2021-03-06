<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/form.css" />

        <title>Register</title>
    </head>
    <body>
        <?php 
            include './Header.php';
        ?>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                        <section id="register-banner" class="banner">
                            <div class="form-container">
                                <form id="contact" method="post" action="../controllers/Register.php">
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
                            
                                    <fieldset>
                                        <input type="password" name="repeated_password" id="repeated-password" placeholder="Repeat Password" required/>
                                        <div class="error">
                                            <?php if(isset($_GET['repeated_password']) && $_GET['repeated_password'] == 'false'):?>
                                                Passwords do not match.
                                            <?php endif?>
                                        </div>
                                    </fieldset>
                            
                                    <fieldset>
                                        <input type="email" name="email" id="email" placeholder="Email" required/>
                                        <div class="error">
                                            <?php if(isset($_GET['email']) && $_GET['email'] == 'false'):?>
                                                Email is required and should be valid.
                                            <?php endif?>
                                        </div>
                                    </fieldset>
                            
                                    <fieldset>
                                        <input type="text" name="full_name" id="full-name" placeholder="Full Name" required/>
                                        <div class="error">
                                            <?php if(isset($_GET['full_name']) && $_GET['full_name'] == 'false'):?>
                                                Full name is required.
                                            <?php endif?>
                                        </div>
                                    </fieldset>
                            
                                    <button type="submit"> Login </button>                                    
                                    <span>Already have an account? </span>
                                    <span>
                                        <a href="../views/Login.php"> Login here</a>
                                    </span>
                                </form>
                            </div>
                        </section>
                </div>
            </div>
        </div>
    </body>
</html>
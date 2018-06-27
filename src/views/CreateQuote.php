<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Create a quote</title>
  </head>

  <body class="text-center">
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php
            session_start(); 
            include './Header.php'
        ?>
      <main role="main" class="inner cover">
        <form class="custom-form" method="post" action="../controllers/CreateQuote.php">
        <h1 class="h3 mb-3 font-weight-normal">Create a new quote</h1>
            <input type="text" id="title" name="title" class="form-control" placeholder="Title" required >
            <div class="error">
                <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                    Title is required
                <?php endif?>
            </div>

            <input type="textarea" id="quote_text" name="quote_text" class="form-control" placeholder="Text" required >
            <div class="error">
                <?php if (isset($_GET['quote_text']) && $_GET['quote_text'] == 'false'): ?>
                    Title is required
                <?php endif?>
            </div>


            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
        </form>
      </main>
    </div>
  </body>
</html>
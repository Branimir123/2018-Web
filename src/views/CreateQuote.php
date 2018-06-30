<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="../assets/css/form.css">

    <title>Create a quote</title>
  </head>

  <body class="text-center">
    <div class="container">
        <?php
            session_start(); 
            include './Header.php';
            include '../controllers/GetAllCategories.php';
        ?>
      <main role="main">
        <div class="form-container">
            <form id="contact" method="post" action="../controllers/CreateQuote.php">
                <h3>Create a new quote</h3>
                <h4>Quote your favourite author or add something yours</h4>
                <fieldset>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" required >
                    <div class="error">
                        <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                            Title is required
                        <?php endif?>
                    </div>
                </fieldset>

                <textarea id="quote_text" name="quote_text" placeholder="Quote" required></textarea>
                <div class="error">
                    <?php if (isset($_GET['quote_text']) && $_GET['quote_text'] == 'false'): ?>
                        Title is required
                    <?php endif?>
                </div>

                <fieldset>
                    <input type="text" id="real_author" name="real_author" placeholder="Author (maybe you?)" required >
                    <div class="error">
                        <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                            Title is required
                        <?php endif?>
                    </div>
                </fieldset>

                <fieldset>
                    <span>Category: </span>
                    <select name="category_id" id="category_id" required>
                        <?php
                            foreach($categories as $category)
                            {
                                echo '<option value=' . $category->getId() . '>' . $category->getCategoryName() . '</option>';
                            }
                        ?>
                    </select>
                </fieldset>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
            </form>
        </div>
      </main>
    </div>
  </body>
</html>
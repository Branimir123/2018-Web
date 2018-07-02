<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="../assets/css/form.css">

    <title>Edit quote</title>
  </head>

  <body class="text-center">
    <div class="container">
        <?php
            session_start(); 
            include './Header.php';

            if (!isset($_SESSION['current_user_id'])) {
                header('Location: ../views/Login.php?message=You have to login to create a quote');

                return;
            }

            if($_SESSION['current_user_id'] != $_GET['author_id']) {
                header('Location: ../controllers/GetQuote.php?id='. $_GET['id']);
            }

            include '../controllers/GetAllCategories.php';
        ?>
      <main role="main">
        <div class="form-container-quote">
            <form id="contact" method="post" action="../controllers/EditQuote.php">
                <h3>Edit your quote</h3>
                <h4>You did a typo? No worries!</h4>

                <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
                <input type="hidden" id="author_id" name="author_id" value="<?=$_GET['author_id']?>">

                <fieldset>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" value="<?=$_GET['title']?>" required >
                    <div class="error">
                        <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                            Title is required
                        <?php endif?>
                    </div>
                </fieldset>

                <textarea id="quote_text" name="quote_text" placeholder="Quote" required><?=$_GET['quote_text']?></textarea>
                <div class="error">
                    <?php if (isset($_GET['quote_text']) && $_GET['quote_text'] == 'false'): ?>
                        Title is required
                    <?php endif?>
                </div>

                <fieldset>
                    <input type="text" id="real_author" name="real_author" placeholder="Author (maybe you?)" value="<?=$_GET['real_author']?>" required >
                    <div class="error">
                        <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                            Title is required
                        <?php endif?>
                    </div>
                </fieldset>

                <fieldset>
                    <span>Category: </span>
                    <select name="category_id" id="category_id">
                        <?php
                            foreach($categories as $category)
                            {
                                echo '<option value=' . $category->getId() . (($category->getId() == $_GET['category_id']) ? ' selected' : '') . '>' . $category->getCategoryName() . '</option>';
                            }
                        ?>
                    </select>
                </fieldset>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Update Quote</button>
            </form>
        </div>
      </main>
    </div>
  </body>
</html>
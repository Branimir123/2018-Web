<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="../assets/css/single-card.css">

    <title><?=$quote->getTitle()?></title>
  </head>

  <body>
    <div class="container">
      <?php include '../views/Header.php'?>
      <main>       
      <div class="blog-card spring-fever">
        <div class="title-content">
          <h3><?=$quote->getTitle()?></h3>
          <hr />
          <div class="intro-author">Author: <?=$quote->getRealAuthor()?></div>
          <div class="intro">Submitted: <?=$quote->getAuthorFullName()?></div>
        </div>
        <div class="card-info"><?=$quote->getQuoteText()?></div>
        <div class="utility-info">
          <ul class="utility-list">
            <li class="comments"><?=$quote->getLikes()?></li>
            <li class="date"><?=$quote->getDateAdded()?></li>
            <?php if($quote->getAuthorId() == $_SESSION['current_user_id']) : ?>
              <li class="delete-btn"><a href="<?php echo '../controllers/DeleteQuote.php?id=' . $quote->getId()?>">Delete</a></li>
            <?php endif; ?>
          </ul>
        </div>
        <!-- overlays -->
        <div class="gradient-overlay"></div>
        <div class="color-overlay"></div>
      </div>
      </main>
    </div>
  </body>
</html>
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
          <?php if($quote->getAuthorId() == $_SESSION['current_user_id']) : ?>
            <a class="delete-btn" href="<?php echo '../controllers/DeleteQuote.php?id=' . $quote->getId()?>">
              <i class="fas fa-trash-alt"></i>
            </a>
            <a class="edit-btn" href="<?php 
                echo '../views/EditQuote.php?id=' . $quote->getId() . 
                '&title=' . $quote->getTitle() . 
                '&author_id=' . $quote->getAuthorId() .
                '&quote_text=' . $quote->getQuoteText() .
                '&real_author=' . $quote->getRealAuthor() .
                '&category_id=' . $quote->getCategoryId()
              ?>">
              <i class="far fa-edit"></i>
            </a>
          <?php endif; ?>
          <div class="intro-author">Author: <?=$quote->getRealAuthor()?></div>
          <div class="intro">Submitted: <?=$quote->getAuthorFullName()?></div>
          <div class="intro"><?=$quote->getCategoryName()?></div>
        </div>
        <div class="card-info"><?=$quote->getQuoteText()?></div>
        <div class="utility-info">
          <ul class="utility-list">
            <li class="comments">
              <a class="likes-link" href="<?php echo '../controllers/LikeQuote.php?id='.$quote->getId() ?>">
                <i class="fas fa-heart"></i>
              </a>
              <?=$quote->getLikes()?>
            </li>
            <li class="date">
              <i class="fas fa-calendar-alt"></i>
              <?=$quote->getDateAdded()?>
            </li>
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
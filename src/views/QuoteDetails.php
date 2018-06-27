<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title><?=$quote->getTitle()?></title>
  </head>

  <body>
    <div class="container">
      <?php include '../views/Header.php'?>
      <main>       
        <h1><?=$quote->getTitle()?></h1>
        <h3><?=$quote->getQuoteText()?></h3>
        <h3><?=$quote->getDateAdded()?></h3>
      </main>
    </div>
  </body>
</html>
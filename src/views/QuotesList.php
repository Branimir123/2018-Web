<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All quotes</title>

  </head>

  <body class="text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include '../views/Header.php'?>

    <main role="main" class="inner cover">
    <ul class="list-group">
        <?php
            if(count($quotes) <= 0)
            {
                echo '<li>There are no quotes.</li>';
            }
            else 
            {
                foreach($quotes as $quote)
                {
                 echo '<div class="card" style="width: 33rem;"><div class="card-body"><h5 class="card-title"><a href="./GetQuote.php?id='.$quote->getId().'">'.$quote->getTitle().'</a></h5><h6 class="card-subtitle mb-2 text-muted">'.date('l, jS \of F, Y h:i:s A', strtotime($quote->getDateAdded())).'</h6><p class="card-link">'.$quote->getQuoteText().', '.$quote->getAuthorId().'</p></div></div><br>';
                }
            }
        ?>
</ul>
      </main>
    </div>
  </body>
</html>
<?php 
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; 
        if (isset($SESSION['email'])) {
            redirect("Location: /demo/home");
        } ?>
    <div class="container">    
      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->
      <div class="container marketing">
        <div class="jumbotron my-3">
            <h1 class="display-4">Carpool CS2102</h1>
            <p class="lead">Ever needed a ride but cannot get one? Or simply wanted to try carpooling? 
            Our carpool app will help riders and drivers connect to each other.</p>
            <hr class="my-3">
            <p>Here are some of the benefits of carpooling:</p>
        </div>
        <!-- Three columns of text below the carousel -->
        <div class="row my-4">
          <div class="col-md-3 bg-light rounded">
            <img class="rounded-circle border-secondary border" src="https://banner2.kisspng.com/20180412/ooe/kisspng-natural-environment-environmental-health-sustainab-earth-vector-5acfb43b5d4509.0101054815235615313821.jpg" 
                alt="Generic placeholder image" width="140" height="140">
            <h2>Save the environment</h2>
            <p>Some fact about saving the Earth</p>
          </div><!-- /.col-lg-4 -->
          <div class="offset-md-1 col-md-3 bg-light rounded">
            <img class="rounded-circle border-secondary border" src="https://banner2.kisspng.com/20180212/vxw/kisspng-banknote-united-states-dollar-money-vector-green-money-dollar-5a8235d23e1ee1.0174562215184828982545.jpg" 
            alt="Generic placeholder image" width="140" height="140">
            <h2>Reduce your travel cost</h2>
            <p>With an open bid system, you are bound to get a lower cost for your ride.</p>
          </div><!-- /.col-lg-4 -->
          <div class="offset-md-1 col-md-3 bg-light rounded">
            <img class="rounded-circle border-secondary border" src="https://banner2.kisspng.com/20180503/qhq/kisspng-computer-icons-user-ios-7-friend-vector-5aeb81be0ef356.3241770815253836140613.jpg" 
            alt="Generic placeholder image" width="140" height="140">
            <h2>Make friends</h2>
            <p>Carpool with others and make new friends on your way to work!</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        </div>
        <br />
    </div>
    <?php include 'partials/script.php'; ?>
</body>
<?php session_start(); 
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="jumbotron my-3">
                <h1 class="display-4">Welcome to our carpool app! <i class="fas fa-car"></i></h1>
                <p class="lead">Take a look at our wide selection of car rides for you to choose from and bid for it in a 
                matter of seconds.</p>
                <hr class="my-3">
            </div>
            <div class="rounded p-3 my-3 bg-light">
                <form action="home.php" method="GET">
                    <div class="row">
                        <div class="col form-group">
                            <h4>FROM: </h4>
                            <input type="text" class="form-control" 
                                name="from">
                        </div>
                        <div class="col form-group">
                            <h4>TO: </h4>
                            <input type="text" class="form-control" 
                                name="to">
                        </div>
                    </div>
                    <br />
                    <input class="btn btn-primary" type="Submit" name="Search">   
                </form>
            </div>
            <br />
            <?php 
                include 'partials/available_list.php';
                echo"<br />";
                include 'partials/user_list.php';
            ?>
        </div>
    <?php include 'partials/script.php'; ?>
</body>
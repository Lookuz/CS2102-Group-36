<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/demo/index"><h3>Carpool CS2102</h3></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/demo/index">
                    Home
                </a>
            </li>
            <?php if (isset($_SESSION['username'])) {
                echo "<li class='nav-item'>";
                if ($_SESSION['isDriver'] == FALSE) {
                    echo "<a class='nav-link' href='/demo/driver_signup'>";
                } else {
                    echo "<a class='nav-link' href='/demo/driver'>";
                }     
                echo "Offer My Ride</a>
                    </li>";
            } ?>    
        </ul>
        <?php if(!isset($_SESSION['username'])) { ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/demo/login">
                    <button class="btn btn-dark">Login</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/demo/signup">
                    <button class="btn btn-dark">Signup</button>
                </a>
            </li>
        </ul>
        <?php } else {
            echo "<ul class='navbar-nav ml-auto'>
                <li class='nav-item'>
                    <a class='nav-link active' href='/demo/actions/logout.php'>
                        <button class='btn btn-dark'>Logout</button>
                    </a>
                </li>
            </ul>";
        } ?>
    </div>
</nav>
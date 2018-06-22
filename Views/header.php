<header class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="" class="navbar-brand" ><img src="../Resources/images/logo.png" alt="">
                    <span id="logo">
                        <span> Rent  </span>
                        <br>
                        <span> Dresses </span>
                    </span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li class=""><a href="index.php"> Home</a> </li>
                    <?php
                        if (isset($_SESSION['username']) ){
                            echo "<li class=\"\"><a href=\"addproduct.php\">Add dress</a> </li>";
                            echo "<li class=\"\"><a href=\"orders.php\"> Rented </a> </li>";

                        }
                        echo "<li class=\"\"><a href=\"questions_answers.php\"> Questions </a> </li>";
                        echo "<li><a href='contactUs.php'>Contact us</a></li>";

                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                            if (isset($_SESSION['username'])){
                                echo "<a href='profile.php?email={$_SESSION['email']}'>{$_SESSION['username']}</a>";
                            }else{
                                echo "<a class=\"btn\" id=\"login\" href=\"login.php\">Login</a>";
                            }

                        ?>


                    </li>
                    <li>
                        <?php
                            if (isset($_SESSION['username'])){
                                echo "<a href='../Controllers/user_route.php?logout=true'>Logout</a>";
                            }
                        ?>
                    </li>
                    <!-- logout button-->
                </ul>
            </div>
        </div>
    </nav>
</header>

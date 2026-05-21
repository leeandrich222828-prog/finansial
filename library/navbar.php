<?php
    if(isset($_SERVER['HTTPS'])){
        $protocol = "https";
    }else{
        $protocol = "http";
    }
    $host = $_SERVER['HTTP_HOST'];
    $base_url = $protocol."://".$host;
    $url = $base_url;
    // $project = "Finansial";
    // $url = $base_url."/".$project;




    echo '<nav>
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Finansial</a>
            <button class="nav-toggle" onclick="toggleNav()" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul id="navMenu">
                <li><a href="'.$url.'">Home</a></li>
                <li><a href="'.$url.'/transaksi">Transaksi</a></li>
                <li><a href="'.$url.'/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <script>
        function toggleNav(){
            document.getElementById("navMenu").classList.toggle("open");
        }
    </script>';
<?php
  include('php/config.php');
  include('php/database.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/map.css">
    <style>
      @import "node_modules/ol/ol.css";
    </style>

    <script src="https://kit.fontawesome.com/d595ff8643.js" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <title>Fairchild Wildfire Notification System</title>

</head>
<body>

    <div class="header">
        <nav>

            <div style="padding: 5px">
                <img src="../images/user.png" class="user-pic" onclick="toggleMenu()">
            </div>

            <div class="sub-menu-wrap" id="subMenu">

                <div class="exit">
                    <i class="fa-solid fa-xmark exitbutton" style="color: #3B4242" onclick="toggleMenu()"></i>
                </div>

                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../images/user.png" class="user-pic">
                        <h3 class="text1">Admin</h3>
                    </div>

                    <div class="links">
                        <a href="#" class="sub-menu-link">
                            <p>Account</p>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <p>Logout</p>
                        </a>
                    </div>

                    <a href="#">
                        <div class="button" id="save">
                            <a class="sub-menu-button" >
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <p>Save Current Map</p>
                            </a>
                        </div>
                    </a>

                    <a>
                        <div class="button" id="edit">
                            <a class="sub-menu-button">
                                <i class="fa-solid fa-gear"></i>
                                <p>Edit Map Settings</p>
                            </a>
                        </div>
                    </a>

                    <a>
                        <div class="button" id="csv">
                            <a class="sub-menu-button">
                                <i class="fa-solid fa-file-import"></i>
                                <p>Import/Export CSV</p>
                            </a>
                        </div>
                    </a>

                    <a>
                        <div class="button" id="email">
                            <a class="sub-menu-button">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Email Notification</p>
                            </a>
                        </div>
                    </a>

                    <br>
                    <p class="tracker text1">Fire Tracker</p>
                    <hr>
                    <br id="under">
                    <p class="text text1">You're currently not following any fires.</p>
                </div>
            </div>


            <div class="logo">
                <a href="#">
                    <img class="fafb"
                         title="Fairchild Air Force Base"
                         src="../images/air%20force_white.png"
                         width="40px"; height="40px";
                         alt="logo">
                </a>
            </div>

            <div class="container">
                <div>
                    <span>
                        <i id="layers" class="fa-solid fa-layer-group icon" title="Layers Menu"></i>
                    </span>
                </div>

                <div>
                    <span>
                        <i id="info" class="fa-solid fa-circle-info icon" title="Info Menu"
                            onclick="toggleInfo()"></i>

                        <div class="sub-info-wrap" id="subInfo">

                            <div class="sub-info">
                                <header>
                                    <div class="about">
                                        <h3 class="infoheader">About</h3>
                                    </div>

                                    <div class="exit">
                                        <i class="fa-solid fa-xmark exitbutton" onclick="toggleInfo()"></i>
                                    </div>

                                </header>

                                <p class="infotext" style="padding-top: 30px">

                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt
                                    sodales tellus, quis dignissim nisi scelerisque quis. Sed faucibus est dolor,
                                    sit amet luctus nibh dignissim ut. Praesent vel sem in est condimentum laoreet.
                                    Nam tempor eget nisi ut commodo. Donec pretium auctor nisl ac pulvinar. Aliquam
                                    erat volutpat. Phasellus pellentesque dolor malesuada nibh facilisis, sit amet
                                    vestibulum tellus consectetur. Donec magna velit, mollis eget facilisis malesuada,
                                    commodo volutpat nisi. Quisque suscipit viverra lorem sit amet pharetra. Donec
                                    sagittis semper magna, vitae eleifend nisi volutpat vel. Fusce sed tortor non
                                    ligula viverra viverra at a lorem. Nulla sit amet turpis erat. Praesent ac
                                    sapien in orci pulvinar semper quis nec libero. Ut eu metus quis dui eleifend
                                    mollis vel vitae elit. Maecenas a neque eget purus vulputate vulputate sed eu
                                    sapien.
                                </p>

                                <p class="infotext">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt
                                    sodales tellus, quis dignissim nisi scelerisque quis. Sed faucibus est dolor,
                                    sit amet luctus nibh dignissim ut.
                                </p>

                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </nav>
    </div>



     <!-- <div class="sidebar-left" style="float: left;">
        <div class="content">
            <div class="search">
                <input type="text" class="search__input" aria-label="search" placeholder="Search">

                <button class="search__submit" aria-label="submit search">
                    <i class="fa fa-search"></i> 
                </button>
            </div>
        </div>

        <div>
            <i id="legend" class="fa-solid fa-list" title="Legend"></i>
        </div>

        <div>
            <i id="stats" class="fa-solid fa-calculator" title="Stats" ></i>
        </div>
    </div> -->

    <div id="map">
        <div id="info"></div>
      </div>
    <script src="./javascript/map.js"></script>

    <!-- Creating the stats
    <div class="stats">
        <h2>Today's Wildfire Statistics</h2>
    </div> -->


<script>
    let subMenu = document.getElementById("subMenu");
    let subInfo = document.getElementById("subInfo");

    function toggleMenu() {
        if (subInfo.classList.contains("open-info")) {
            subInfo.classList.remove("open-info");
        }

         subMenu.classList.toggle(("open-menu"))
     }

    function toggleInfo() {
        if (subMenu.classList.contains("open-menu")) {
            subMenu.classList.remove("open-menu");
        }
        subInfo.classList.toggle(("open-info"))
    }



</script>
</body>
</html>
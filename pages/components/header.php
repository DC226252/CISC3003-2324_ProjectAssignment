<?php 
    $pages = [
        ["./index.php", "Home", NULL], 
        ["./about.php", "About Us", NULL],
        ["./rooms.php", "Rooms", NULL],  
        ["./login_sigeup.php", "Login / Signup", false], 
        ["./profile.php", "Profile", true], 
    ]
?>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <?php foreach($pages as $page) { ?>
            <li <?php 
                    if($page[1] == $pwd) echo "class=\"active\"";
                    elseif(!is_null($page[2]))
                        if($page[2] != $login) echo "class=\"hider\"";
                ?>>
                <a href="<?= $page[0]; ?>"><?= $page[1]; ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">     
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="./index.php"><h3>UM Hotel</h3></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <?php foreach($pages as $page) { ?>
                                <li <?php 
                                        if($page[1] == $pwd) echo "class=\"active\"";
                                        elseif(!is_null($page[2]))
                                            if($page[2] != $login) echo "class=\"hider\"";
                                    ?>>
                                    <a href="<?= $page[0]; ?>"><?= $page[1]; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
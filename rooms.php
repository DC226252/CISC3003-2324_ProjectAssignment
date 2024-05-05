<?php
    $root = ".";
    include realpath("./include/objects/RoomType.php");
    session_start();
    if(isset($_SESSION["customerID"])) $login = true;
    else $login = false;
    $pwd = "Rooms"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rooms</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="./css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="./css/flaticon.css" type="text/css">
        <link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="./css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="./css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="./css/style.css" type="text/css">
    </head>
    <body>
        <?php include "./pages/components/header.php"; ?>

        <!-- Breadcrumb Section Begin -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Our Rooms</h2>
                            <div class="bt-option">
                                <a href="./index.html">Home</a>
                                <span>Rooms</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- Rooms Section Begin -->
        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                    <?php
                        $EXIT_STATE = "";
                        $RoomTypeList = query_RoomType([], $EXIT_STATE);
                        foreach($RoomTypeList as $RoomType) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <img src="./images/room/room-<?= $RoomType -> type; ?>.jpg" 
                                alt="<?= ucfirst($RoomType -> format); ?> Room" />
                            <div class="ri-text">
                                <h4><?= ucfirst($RoomType -> format); ?> Room</h4>
                                <h3><?= number_format($RoomType -> price, 2); ?>$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td><?= $RoomType -> size; ?> ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max person <?= $RoomType -> capacity; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td><?= $RoomType -> bed; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td><?= $RoomType -> services; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="./room_details.php?room_type=<?= $RoomType -> type; ?> " 
                                    class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- Rooms Section End -->

        <?php include "./pages/components/footer.php"; ?>
        <!-- Js Plugins -->
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/jquery.magnific-popup.min.js"></script>
        <script src="./js/jquery.nice-select.min.js"></script>
        <script src="./js/jquery-ui.min.js"></script>
        <script src="./js/jquery.slicknav.js"></script>
        <script src="./js/owl.carousel.min.js"></script>
        <script src="./js/main.js"></script>
    </body>
</html>
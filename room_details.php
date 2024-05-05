<?php
    include realpath("./include/objects/RoomType.php");
    if(!isset($_GET["room_type"])) header("location: ./rooms.php");
    else {
        $EXIT_STATE;
        $RoomType = query_RoomType(["type" => $_GET["room_type"]], $EXIT_STATE)[0];
    }
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
        <title>Room Details</title>

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

        <!-- Room Details Section Begin -->
        <section class="room-details-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="room-details-item">
                            <img src="./images/room/room-<?= $RoomType -> type; ?>.jpg" 
                                alt="<?= ucfirst($RoomType -> format); ?> Room" />
                            <div class="rd-text">
                                <div class="rd-title">
                                    <h3><?= ucfirst($RoomType -> format); ?> Room</h3>
                                    <div class="rdt-right">
                                        <a href="#">Booking Now</a>
                                    </div>
                                </div>
                                <h2><?= number_format($RoomType -> price, 2); ?>$<span>/Pernight</span></h2>
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
                                <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
                                    advantages and disadvantages of both, so you will be confident when purchasing an RV.
                                    When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
                                    wheeler? The advantages and disadvantages of both are studied so that you can make your
                                    choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
                                    achievement of a lifetime. It can be similar to sojourning with your residence as you
                                    search the various sites of our great land, America.</p>
                                <p>The two commonly known recreational vehicle classes are the motorized and towable.
                                    Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                                    wheel has the attraction of getting towed by a pickup or a car, thus giving the
                                    adaptability of possessing transportation for you when you are parked at your campsite.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="room-booking">
                            <h3>Your Reservation</h3>
                            <form action="#" id="eco_order">
                                <div class="check-date">
                                    <label for="date-in">Check In:</label>
                                    <input type="text" class="date-input" id="date-in" readonly>
                                    <i class="icon_calendar"></i>
                                </div>
                                <div class="check-date">
                                    <label for="date-out">Check Out:</label>
                                    <input type="text" class="date-input" id="date-out" readonly>
                                    <i class="icon_calendar"></i>
                                </div>
                                <button type="submit">Check Availability</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Room Details Section End -->

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
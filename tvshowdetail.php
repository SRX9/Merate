<?php
session_start();
?>
<?php
function getrating($star)
{
    if ($star == 5) {
        ?>
        <table>
            <tr>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="50px" width="50px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
            </tr>
        </table>
    <?php
} elseif ($star == 4) {
    ?>
        <table>
            <tr>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="50px" width="50px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
            </tr>
        </table>
    <?php
} elseif ($star == 3) {
    ?>
        <table>
            <tr>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="50px" width="50px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
            </tr>
        </table>
    <?php
} elseif ($star == 2) {
    ?>
        <table>
            <tr>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="50px" width="50px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
            </tr>
        </table>
    <?php
} elseif ($star == 1) {
    ?>
        <table>
            <tr>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/color/48/000000/christmas-star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="50px" width="50px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="35px" width="35px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
                <td>
                    <img height="25px" width="25px" src="https://img.icons8.com/ios/26/000000/star.png">
                </td>
            </tr>
        </table>
    <?php
}
}
?>




<!--Data from data base-->
<?php
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $id = $_GET['id'];
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbhandler->query("select * from tvshows where TvShow_Id='$id'");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $detail = $result[0];
    $name = $detail["Title"];
    $season = $detail["Current_Season"];
    $sub = "Season " . $season;
    $trailer = $detail["Trailer"];
    $rating = $detail["Score"];
    $stars = $detail["Stars"];
    $likes = $detail["Likes"];
    if ($likes > 1000000) {
        $likes = $likes / 1000000;
        $likes = (string)(round($likes, 2)) . "M";
    } elseif ($likes > 1000) {
        $likes = $likes / 1000;
        $likes = (string)(round($likes, 2)) . "K";
    }

    $trp = $detail["TRP"];
} catch (PDOException $e) {
    echo $e;
    die();
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medate</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swiper.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,700" rel="stylesheet">
</head>

<body>
    <header class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 col-xs-12">
                    <nav>
                        <ul style="float:right;color:white;">
                            <table>
                                <tr>
                                    <td style="padding:9px;">
                                        <li><a href="index.php">
                                                <p style="color:white;">Home<p>
                                            </a></li>
                                    </td>
                                    <td style="padding:9px;">
                                        <li><a href="movie.php">
                                                <p style="color:white;">Movies<p>
                                            </a></li>
                                    </td>
                                    <td style="padding:9px;">
                                        <li><a href="movie.php">
                                                <p style="color:white;">TV Shows<p>
                                            </a></li>
                                    </td>
                                    <td style="padding:9px;">
                                        <li><a href="music.php">
                                                <p style="color:white;">Music<p>
                                            </a></li>
                                    </td>

                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        $user = $_SESSION['user'];
                                        ?>

                                        <td style="padding:9px;">
                                            <li><a href="profile.php">
                                                    <p class="auth" style="font-weight:800;color:white; border:3px solid white;padding:10px;"><?php echo $user; ?><p>
                                                </a></li>
                                        </td>
                                        <td style="padding:9px;">
                                            <li><a href="index.php">
                                                    <form method="POST" action="index.php">
                                                        <p class="auth"><button type="submit" name="logout" style="font-weight:800; color:black; padding:10px; background-color: transparent; border: 3px solid white; color: white; padding: 10px 22px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">
                                                                LogOut
                                                            </button></p>
                                                    </form>

                                                </a></li>
                                        </td>
                                    <?php
                                } else {
                                    ?>
                                        <td style="padding:9px;">
                                            <li><a href="login.php">
                                                    <p class="auth" style="color:white; border:3px solid white;padding:5px;">Login<p>
                                                </a></li>
                                        </td>
                                        <td style="padding:9px;">
                                            <li><a href="register.php">
                                                    <p class="auth" style="color:white; border:3px solid white;padding:5px;">Register<p>
                                                </a></li>
                                        </td>
                                    </tr>
                                <?php
                            } ?>
                                </tr>
                            </table>
                        </ul>
                    </nav>
                    <div class="" style="padding-top:80px;">
                        <h1 class=" " style="padding-left:50px; "><span class=""><?php echo $name ?></span><br>
                            <p style="border-bottom:0px solid white;"><?php echo $sub ?></p>
                        </h1>
                        <form method="POST" class="example" action="search.php" style="margin:auto;max-width:550px;padding-right:50px;">
                            <input style="color:black" type="text" placeholder="Search For Movies,TV Shows,Music" name="q" />
                            <button type="submit" name="search"><i class="fa fa-search"></i></button>
                        </form>
                        <style>
                            form.example input[type=text] {
                                padding: 10px;
                                font-size: 17px;
                                border: 1px solid grey;
                                float: left;
                                width: 80%;
                                background: #f1f1f1;
                                border: none;
                                border-radius: 25px 25px 25px 25px;
                            }

                            form.example button {
                                float: left;
                                width: 20%;
                                padding: 10px;
                                background: #2196F3;
                                color: white;
                                font-size: 17px;
                                border: 1px solid white;
                                border-radius: 25px 25px 25px 25px;
                                border-left: none;
                                cursor: pointer;
                            }

                            form.example button:hover {
                                background: #0b7dda;
                            }

                            form.example::after {
                                content: "";
                                clear: both;
                                display: table;
                            }
                        </style>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <section class="hero-text">
        <div class="row" style="padding-top:30px;">
            <div class="column1">
                <div class="trailer" style="">
                    <iframe style="padding-left:30px;border:none;border-radius:50px;" width="98%" height="600px" src="https://www.youtube.com/embed/<?php echo $trailer ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div>
                        <!--  SRX Rating form  -->
                        <?php
                        if (!isset($_SESSION['user'])) {
                            ?> <center>
                                <h1 class="heading blue" style="padding-top:30px;"><span class="blue">You Need to <a href="login.php" style="border:3px solid black;padding:5px;"><b>Login</b></a> To Give Review</span><br></h1>
                            </center>
                        <?php
                    } else { ?>
                            <div class="giverev" id="myDIV">
                                <h1 class="heading purple" style="padding-top:30px;padding-left:20px;"><span class="purple">Give Your</span><br>Review</h1>
                                <center>


                                    <!-- stars  -->
                                    <h1 class="heading blue"><span class=" blue">Give</span><br>Stars</h1>
                                    <div>
                                        <form class="rating">
                                            <label>
                                                <input type="radio" name="stars" value="1" />
                                                <span class="icon">&#9733;</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="stars" value="2" />
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="stars" value="3" />
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="stars" value="4" />
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="stars" value="5" />
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                                <span class="icon">&#9733;</span>
                                            </label>
                                        </form>
                                    </div>

                                    <!--  like   -->
                                    <h1 class="heading blue"><span class=" blue">Give</span><br>Like</h1>
                                    <img height="75px" width="75px" class="star" id="imageOne" onclick="liked()" src="https://png.pngtree.com/svg/20151119/72fac5878b.svg" />
                                    <h1 class="heading blue"><span class=" blue">Comment</span><br></h1>
                                    <div ng-app="myApp">
                                        <div>
                                            <textarea id="comment" name="review" placeholder="Comment   ">
                                                            </textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <form action="review.php" method="POST">
                                        <input type="hidden" name="title" id="title" />
                                        <input type="hidden" name="media" id="name" />
                                        <input type="hidden" name="id" id="id" />
                                        <input type="hidden" name="star" id="gotstar" />
                                        <input type="hidden" name="like" id="gotlike" />
                                        <input type="hidden" name="comment" id="gotcomment" />
                                        <button class="button button5" onclick="sendReview()" type="submit" name="submit1">Submit Review</button>
                                    </form>
                                    <br>
                                    <br>

                                </center>
                            </div>
                            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                            <script>
                                //Review Info
                                var gotstar = 0;
                                var likegot = 0;

                                function sendReview() {
                                    var id = "<?php echo $_GET["id"] ?>"
                                    var comment = document.getElementById("comment").value;
                                    document.getElementById("gotcomment").value = comment;
                                    document.getElementById("name").value = "tv";
                                    document.getElementById("id").value = id;
                                    document.getElementById("title").value = "<?php echo $name ?>";
                                }
                                //stars
                                $(':radio').change(function() {
                                    gotstar = this.value;
                                    document.getElementById("gotstar").value = gotstar;

                                });

                                //like
                                var image = document.getElementById("imageOne");

                                function liked() {
                                    if (likegot == 0) {
                                        image.src = "https://img.icons8.com/flat_round/64/000000/hearts.png";
                                        likegot++;
                                        document.getElementById("gotlike").value = likegot;
                                    } else {
                                        likegot--;
                                        console.log("disliked");
                                        image.src = "https://png.pngtree.com/svg/20151119/72fac5878b.svg";
                                        document.getElementById("gotlike").value = likegot;

                                    }
                                }
                            </script>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="column2">
                <center>
                    <h1 class="heading blue" style="padding-top:30px;"><span class="blue">Rating</span><br></h1>
                </center>
                <center>

                    <div class="info" style="padding-top:50px;">
                        <p class=""><b>TRP</b> <span></span><?php echo $trp  ?></p><br>
                        <h3><b>Overall Stars</b></h3>
                        <?php
                        getrating($stars)
                        ?>
                        <br>
                        <img height="55px" width="55px" src="https://img.icons8.com/flat_round/64/000000/hearts.png" />
                        <h3><b><?php echo $likes ?></b></h3>

                        <br>
                    </div>
                </center>
                <center>
                    <h1 class="heading blue" style="padding-top:30px;"><span class="blue">Comments</span><br></h1>
                </center>
                <?php
                $query = $dbhandler->query("select comment,user from comment_tvshows  where TvShow_Id='$id'");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <!--comments-->
                <div style="overflow-y:scroll;height:950px;">

                    <?php for ($i = 0; $i < count($result); $i++) { ?>
                        <div class="w3-panel w3-light-grey" style="padding-top:20px;">
                            <span style="font-size:100px;line-height:0.6em;opacity:0.2;">❝</span>
                            <p class="" style="margin-top:-40px;font-size:30px;"><i><?php echo $result[$i]["comment"] ?></i></p>
                            <h2 style="float:right;padding-right:100px;">- <?php echo $result[$i]["user"] ?></h2>
                        </div><?php } ?>
                </div>
                <style>
                    a {
                        color: #333;
                        text-decoration: none;
                    }

                    h1,
                    h2,
                    h3 {
                        font-weight: 400;
                    }

                    h1 {
                        font-size: 30px;
                    }

                    h2 {
                        font-size: 24px;
                    }

                    h3 {
                        font-size: 20px;
                    }

                    section {
                        padding: 30px 60px;
                    }
                </style>
            </div>
        </div>


    </section>
    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="row footer">
                
            </div>
            <div class="row sub-footer">
                <div class="col-md-12 text-center">
                    <p>Copyright@2019. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>


    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/swiper.jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 50px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: #000;
        }

        .rating:not(:hover) label input:checked~.icon,
        .rating:hover label:hover input~.icon {
            color: #09f;
        }

        .rating label input:focus:not(:checked)~.icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #09f;
        }
    </style>
</body>

</html>
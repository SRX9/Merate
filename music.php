<?php

session_start();


$topstream = array();
$topliked = array();
$trend = array();

try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Top stream Array Generaton
    for ($i = 0; $i < 5; $i++) {
        $query = $dbhandler->query("select Music_Id,Title,Score,Poster,Totel_Stream from musics ORDER BY Totel_Stream DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($topstream, $result[$i]);
    }


    //Most Liked Array Generaton
    for ($i = 0; $i < 5; $i++) {
        $query = $dbhandler->query("select Music_Id,Title,Likes,Poster from musics ORDER BY Likes DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($topliked, $result[$i]);
    }

    //trend Array Generation
    for ($i = 0; $i < 5; $i++) {
        $query = $dbhandler->query("select Music_Id,Title,Poster,Top from musics ORDER BY Top ASC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($trend, $result[$i]);
    }
} catch (PDOException $e) {
    echo $e;
    die();
}

function getlike($likes)
{
    if ($likes > 1000000) {
        $likes = $likes / 1000000;
        return (string)(round($likes, 2)) . "M";
    } elseif ($likes > 1000) {
        $likes = $likes / 1000;
        return (string)(round($likes, 2)) . "K";
    } else {
        return $likes;
    }
}

function getstream($streams)
{
    if ($streams > 100000000) {
        $streams = $streams / 100000000;
        return (string)(round($streams, 2)) . " B";
    } elseif ($streams > 1000000) {
        $streams = $streams / 1000000;
        return (string)(round($streams, 2)) . " M";
    } else {
        return $streams;
    }
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
                                        <li><a href="tvshow.php">
                                                <p style="color:white;">TV Shows<p>
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


                    <div class="hero-text">
                        <h1 style="border-bottom:3px solid white;">Music</h1>
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

    <section class="">
        <div class="">
            <h1 class="heading blue" style="padding-left:50px;"><span class="blue">Highest Streamed </span><br>Online</h1>
            <div style="padding:10px;">
                <div class="row">

                    <?php
                    for ($i = 0; $i < 5; $i++) { ?>

                        <a href="/med/musicdetail.php?id=<?php echo $topstream[$i]["Music_Id"] ?>">
                            <div class="column">
                                <div class="card cardo">
                                    <h2 class="heading blue"></h2>
                                    <img src=<?php echo $topstream[$i]["Poster"] ?> />
                                    <center>
                                        <h3 class=""><?php echo $topstream[$i]["Title"] ?></h3>
                                        <h3><?php
                                            $iid = $topstream[$i]["Music_Id"];
                                            $query = $dbhandler->query("select Person_Id from music_person where Music_Id='$iid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            $pid = $result[0]["Person_Id"];
                                            $query = $dbhandler->query("select Name from person where Person_Id='$pid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            echo $result[0]["Name"]
                                            ?></b></h3>
                                        <br>
                                        <h1 class="heading blue"><span class="blue"><?php echo getstream($topstream[$i]["Totel_Stream"]) ?></span><br></h1>
                                        <h3>Total Online Streams<h3>
                                                <br>
                                    </center>
                                </div>
                            </div>
                        </a>
                    <?php
                } ?>
                </div>
            </div>
        </div>
        <div class="">
            <h1 class="heading blue" style="padding-left:50px;"><span class="blue">Most</span><br>Liked</h1>
            <div style="padding:10px;">
                <div class="row">

                    <?php
                    for ($i = 0; $i < 5; $i++) { ?>

                        <a href="/med/musicdetail.php?id=<?php echo $topliked[$i]["Music_Id"] ?>">
                            <div class="column">
                                <div class="card cardo">
                                    <h2 class="heading blue"></h2>
                                    <img src=<?php echo $topliked[$i]["Poster"] ?> />
                                    <center>
                                        <h3 class=""><?php echo $topliked[$i]["Title"] ?></h3>
                                        <h3><?php
                                            $iid = $topliked[$i]["Music_Id"];
                                            $query = $dbhandler->query("select Person_Id from music_person where Music_Id='$iid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            $pid = $result[0]["Person_Id"];
                                            $query = $dbhandler->query("select Name from person where Person_Id='$pid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            echo $result[0]["Name"]
                                            ?></b></h3><br>
                                        <img height="55px" width="55px" src="https://img.icons8.com/flat_round/64/000000/hearts.png" />
                                        <br>
                                        <h3><b><?php echo getlike($topliked[$i]["Likes"]) ?></h3>
                                        <br>
                                    </center>
                                </div>
                            </div>
                        </a>
                    <?php
                } ?>
                </div>
            </div>
        </div>
        <div class="">
            <h1 class="heading blue" style="padding-left:50px;"><span class="blue">Trending</span> Songs<br>2019</h1>
            <div style="padding:10px;">
                <div class="row">

                    <?php
                    for ($i = 0; $i < 5; $i++) { ?>

                        <a href="/med/musicdetail.php?id=<?php echo $trend[$i]["Music_Id"] ?>">
                            <div class="column">
                                <div class="card cardo">
                                    <h2 class="heading blue"></h2>
                                    <img src=<?php echo $trend[$i]["Poster"] ?> />
                                    <center>
                                        <h1 class="heading blue"><span class="blue">#<?php echo $trend[$i]["Top"]  ?></span><br></h1>
                                        <h3 class=""><?php echo $trend[$i]["Title"] ?></h3>
                                        <h3><?php
                                            $iid = $trend[$i]["Music_Id"];
                                            $query = $dbhandler->query("select Person_Id from music_person where Music_Id='$iid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            $pid = $result[0]["Person_Id"];
                                            $query = $dbhandler->query("select Name from person where Person_Id='$pid'");
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            echo $result[0]["Name"]
                                            ?></b></h3><br>
                                        <br>
                                    </center>
                                </div>
                            </div>
                        </a>
                    <?php
                } ?>
                </div>
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
</body>

</html>
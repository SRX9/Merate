<?php
session_start();
//Refresh Top
function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}

function updateTop($media)
{
    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("select * from $media");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $r = $result;
        $final = array();
        if ($media == "movies") {
            for ($k = 0; $k < count($r); $k++) {
                $top =  $r[$k]['Stars'] + $r[$k]['Likes'] + $r[$k]['Gross'];
                $r[$k]["sum"] = $top;
                $final = array_push_assoc($final, $r[$k]["Movie_Id"], $top);
            }
            arsort($final);
            for ($k = 0; $k < count($final); $k++) {
                $id = array_keys($final)[$k];
                $sql = "UPDATE movies SET Top=$k+1  WHERE Movie_Id='$id'";
                $query = $dbhandler->query($sql);
            }
        } elseif ($media == "tvshows") {
            for ($k = 0; $k < count($r); $k++) {

                $top = $r[$k]['Stars'] + $r[$k]['Likes'] + $r[$k]['TRP'];
                $r[$k]["sum"] = $top;
                $final = array_push_assoc($final, $r[$k]["TvShow_Id"], $top);
            }
            arsort($final);
            for ($k = 0; $k < count($final); $k++) {
                $id = array_keys($final)[$k];
                $sql = "UPDATE tvshows SET Top=$k+1  WHERE TvShow_Id='$id'";
                $query = $dbhandler->query($sql);
            }
        } elseif ($media == "musics") {
            for ($k = 0; $k < count($r); $k++) {

                $top = $r[$k]['Score'] + $r[$k]['Totel_Stream'] + $r[$k]['Likes'] + $r[$k]['Youtub_Views'];
                $r[$k]["sum"] = $top;
                $final = array_push_assoc($final, $r[$k]["Music_Id"], $top);
            }
            arsort($final);
            for ($k = 0; $k < count($final); $k++) {
                $id = array_keys($final)[$k];
                $sql = "UPDATE musics SET Top=$k+1  WHERE Music_Id='$id'";
                $query = $dbhandler->query($sql);
            }
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
}

updateTop("musics");
updateTop("movies");
updateTop("tvshows");



//admin logout
if (isset($_POST['adminout'])) {
    unset($_SESSION['user']);
}


//Logout
if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
}

//To Print Stars Acoording to Star number
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
$totalreview;
$totalusers;
$topmovie = array();
$toptv = array();
$trend = array();
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $query = $dbhandler->query("select rid from review");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $totalreview = count($result);
        $query = $dbhandler->query("select id from user_details");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $totalusers = count($result);
    } catch (PDOException $e) {
        echo $e;
        die();
    }

    //Regiter
    if (isset($_POST['submit'])) {

        $username = $_POST['name'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        try {
            $query = $dbhandler->exec("insert into user_details (username,Email,Password) values('$username','$email','$pass')");
            $_SESSION['user'] = $username;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    //TopMOVIE  Rating Array Generaton
    for ($i = 0; $i < 5; $i++) {
        $query = $dbhandler->query("select Movie_Id,Title,Score,Stars,Poster from movies ORDER BY Top ASC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($topmovie, $result[$i]);
    }


    //TopTV SHOW Rating Array Generaton
    for ($i = 0; $i < 5; $i++) {
        $query = $dbhandler->query("select TvShow_Id,Title,Current_Season,Score,Stars,Poster from tvshows ORDER BY Top ASC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($toptv, $result[$i]);
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
    <link rel="stylesheet" href="css/main.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,700" rel="stylesheet">
</head>

<body>
    <!-- header srk-->
    <header class="hero">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 col-xs-12">
                    <nav>
                        <ul style="color:white;">
                            <table>
                                <tr>
                                    <td style="padding:9px;">
                                        <li><a href="#">
                                                <p style="color:white;">Home<p>
                                            </a></li>
                                    </td>
                                    <?php
                                    //Login AFter
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
                            </table>
                        </ul>
                    </nav>
                    <div class="hero-text">
                        <h1>Medate</h1>
                        <h3>
                            <table>
                                <td style="padding:9px;">
                                    <a href="movie.php">
                                        <p style="color:white;border-right:2px solid white;padding-right:10px;">Movies<p>
                                    </a>
                                </td>
                                <td style="">
                                    <a href="tvshow.php">
                                        <p style="color:white;border-right:2px solid white;padding-right:10px;">TV Shows<p>
                                    </a>
                                </td>
                                <td style="padding:9px;">
                                    <a href="music.php">
                                        <p style="color:white;padding:3px;">Music<p>
                                    </a>
                                </td>
                            </table>
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

                        </h3>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- main srk-->
    <section class="case-study">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Top</span><br>Movies</h1>
                    <!-- Swiper -->
                    <div class="swiper-container client-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <a href="/med/moviedetail.php?id=<?php echo $topmovie[$i]["Movie_Id"] ?>">
                                    <div class="swiper-slide client-box" style="width:50%;opacity:unset;" id=<?php echo "3" ?>>
                                        <h2 class="heading blue"><?php echo $i + 1 ?></h2>
                                        <img style="width:auto;height:auto;opacity:unset;" src=<?php echo $topmovie[$i]["Poster"] ?> />
                                        <center>
                                            <h3 class=" title"><?php echo $topmovie[$i]["Title"] ?></h3>
                                            <?php getrating($topmovie[$i]["Stars"]) ?>
                                            <p class="text-left"><a href="#"></a></p>
                                        </center>
                                    </div>
                                </a>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Top</span><br>TV Shows</h1>
                    <!-- Swiper -->
                    <?php
                    //trending tvshow
                    $tid = 7;
                    ?>
                    <div class="swiper-container client-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <a href="/med/tvshowdetail.php?id=<?php echo $toptv[$i]["TvShow_Id"] ?>">
                                    <div class="swiper-slide client-box" style="width:50%">
                                        <h2 class="heading blue"><?php echo $i + 1 ?></h2>
                                        <img style="width:auto;height:auto" src=<?php echo $toptv[$i]["Poster"] ?> />
                                        <center>
                                            <h3 class=" title"><?php echo $toptv[$i]["Title"] ?></h3>
                                            <h3 class=" title"><b>Season </b><?php echo $toptv[$i]["Current_Season"] ?></h3>
                                            <?php getrating($toptv[$i]["Stars"]) ?>
                                            <p class="text-left"><a href="#"></a></p>
                                        </center>
                                    </div>
                                </a>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Top</span><br>Music</h1>
                    <!-- Swiper -->
                    <div class="swiper-container client-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <a href="/med/musicdetail.php?id=<?php echo $trend[$i]["Music_Id"] ?>">
                                    <div class="swiper-slide client-box" style="width:50%">
                                        <img style="width:auto;height:auto" src=<?php echo $trend[$i]["Poster"] ?> />
                                        <center>
                                            <h3 class=" title"><?php echo $trend[$i]["Title"] ?></h3>
                                            <h3 class=" title"><?php
                                                                $iid = $trend[$i]["Music_Id"];
                                                                $query = $dbhandler->query("select Person_Id from music_person where Music_Id='$iid'");
                                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                                $pid = $result[0]["Person_Id"];
                                                                $query = $dbhandler->query("select Name from person where Person_Id='$pid'");
                                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                                echo $result[0]["Name"]
                                                                ?></h3>
                                            <h1 class="heading blue" style="padding-left:20px;"><span class="blue">#<?php echo $i + 1 ?></span><br></h1>
                                            <p class="text-left"><a href="#"></a></p>
                                        </center>
                                    </div>
                                </a>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
    </section>

    <!-- statistics srk -->
    <section class="stats">
        <div class="container">
            <div class="row" style="padding-left:290px;">
                <center>
                    <div class="col-md-4 text-center stat-box">
                        <h1 class="purple"><span class="counter"><?php echo $totalusers ?></span></h1>
                        <h3>Total Users</h3>
                    </div>
                    <div class="col-md-4 text-center stat-box">
                        <h1 class="blue counter"><?php echo $totalreview ?></h1>
                        <h3>Reviews Given</h3>
                    </div>
            </div>
            </center>
        </div>
    </section>
    <!-- footer srk -->
    <footer>
        <div class="container-fluid">

            <div class="row sub-footer">
                <div class="col-md-12 text-center">
                    <p>Copyright@2019. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/swiper.jquery.min.js"></script>
    <script>
        var swiper1 = new Swiper('.client-swiper', {
            slidesPerView: 3,
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 30,
            // Responsive breakpoints
            breakpoints: {
                // when window width is <= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: '.swiper-pagination'
                },
                // when window width is <= 480px
                480: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                // when window width is <= 640px
                640: {
                    slidesPerView: 1,
                    spaceBetween: 30
                }
            }
        });
    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
</body>

</html>
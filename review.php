<?php
//Rating Generation Code
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

function avgstar($avg)
{
    if ($avg >= 4.5) {
        return 5;
    } elseif ($avg > 4) {
        return 4;
    } elseif ($avg > 3.5) {
        return 4;
    } elseif ($avg > 3) {
        return 3;
    } elseif ($avg > 2.5) {
        return 3;
    }
}
session_start();
$user;
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    $mediaid = $_POST["id"];
    $media = $_POST["media"];
    $comment = $_POST["comment"];
    $query = $dbhandler->exec("insert into review (user,media,mediaid) values('$user','$media','$mediaid')");
    if ($media == "movie") {
        $star = $_POST['star'];
        $query = $dbhandler->query("select Stars,Likes from movies where Movie_Id='$mediaid'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $finalstar = $result[0]["Stars"];
        if ($finalstar == 0) {
            $finalstar = $star;
        } else {
            $avg = ($finalstar + $star) / 2.0;
            $finalstar = avgstar($avg);
        }
        $like = $_POST['like'] + $result[0]["Likes"];
        $reaction = $_POST['reaction'];
        $query = $dbhandler->exec("UPDATE movies SET Stars='$finalstar',Likes='$like',Reaction='$reaction'  WHERE Movie_Id='$mediaid'");
        $query = $dbhandler->exec("insert into comment_movie (Movie_Id,user,comment) values('$mediaid','$user','$comment')");
    } elseif ($media == "tv") {
        $star = $_POST['star'];
        $query = $dbhandler->query("select Stars,Likes from tvshows where TvShow_Id='$mediaid'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $finalstar = $result[0]["Stars"];
        if ($finalstar == 0) {
            $avg = $star;
        } else {
            $avg = ($finalstar + $star) / 2.0;
            $finalstar = avgstar($avg);
        }
        $like = $_POST['like'] + $result[0]["Likes"];
        $query = $dbhandler->exec("UPDATE tvshows SET Stars='$star',Likes='$like'  WHERE TvShow_Id='$mediaid'");
        $query = $dbhandler->exec("insert into comment_tvshows (TvShow_Id,user,comment) values('$mediaid','$user','$comment')");
    } elseif ($media == "music") {
        $query = $dbhandler->query("select Likes from musics where Music_Id='$mediaid'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $like = $_POST['like'] + $result[0]["Likes"];;
        $query = $dbhandler->exec("UPDATE musics SET Likes='$like'  WHERE Music_Id='$mediaid'");
        $query = $dbhandler->exec("insert into commet_music (Music_Id,user,comment) values('$mediaid','$user','$comment')");
    }
} catch (PDOException $e) {
    echo $e;
    die();
}



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


<?php
function getreaction($react)
{
    if ($react == "c") {
        ?>
        <h3>Comedy</h3>
        <div class="emoji  emoji--haha" id="funny">
            <div class="emoji__face">
                <div class="emoji__eyes"></div>
                <div class="emoji__mouth">
                    <div class="emoji__tongue"></div>
                </div>
            </div>
        </div>
    <?php
} elseif ($react == "s") {
    ?>
        <div class="emocard">
            <h3>Satisfied</h3>
            <div class="emoji  emoji--yay" id="s">
                <div class="emoji__face">
                    <div class="emoji__eyebrows"></div>
                    <div class="emoji__mouth"></div>
                </div>
            </div>
        </div>
    <?php
} elseif ($react == "a") {
    ?>
        <h3>Awesome</h3>
        <div class="emoji  emoji--wow" id="a">
            <div class="emoji__face">
                <div class="emoji__eyebrows"></div>
                <div class="emoji__eyes"></div>
                <div class="emoji__mouth"></div>
            </div>
        </div>
    <?php
} elseif ($react == "e") {
    ?>
        <h3>Emotional</h3>
        <div class="emoji  emoji--sad" id="e">
            <div class="emoji__face">
                <div class="emoji__eyebrows"></div>
                <div class="emoji__eyes"></div>
                <div class="emoji__mouth"></div>
            </div>
        </div>
    <?php
} elseif ($react == "w") {
    ?>
        <h3>Waste of Time</h3>
        <div class="emoji  emoji--angry" id="w">
            <div class="emoji__face">
                <div class="emoji__eyebrows"></div>
                <div class="emoji__eyes"></div>
                <div class="emoji__mouth"></div>
            </div>
        </div>
    <?php
}
}


function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}



updateTop("musics");
updateTop("movies");
updateTop("tvshows");
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


                    <div class="hero-text">
                        <h1>Medate</h1>
                        <h2>Every Opinion Matters...</h2>
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
                    <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Your </span>Review<br>
                    </h1>
                    <center>
                        <h1 class="heading " style="padding-left:20px;box-shadow:5px 5px 5px 5px lightblue;width:50%;font-size:59px;"><span class=""><?php echo $_POST["title"] ?></span></h1>
                        <?php if ($_POST["media"] != "music") { ?>
                            <h1 class="heading blue"><span class="blue">Stars </span><?php getrating($_POST["star"]); ?></h1><br>
                        <?php } ?>
                        <?php
                        if ($_POST["media"] == "movie") {
                            ?><h1 class="heading blue"><span class="blue">Your </span>Reaction</h1><?php
                                                                                                        getreaction($_POST["reaction"])
                                                                                                        ?>
                        <?php } ?>
                        <br>
                        <br>
                        <img height="55px" width="55px" src="https://img.icons8.com/flat_round/64/000000/hearts.png" />
                        <h3>
                            <b>
                                <?php
                                if ($_POST["like"] == 0) {
                                    echo "0";
                                } else {
                                    echo "+1";
                                }
                                ?>
                            </b>
                        </h3>
                        <br>
                        <h1 class="heading blue"><span class="blue">Comment<br> </span><?php echo $_POST["comment"]; ?></h1><br>
                        <h1 class="heading green"><span class="green">Successfully </span>Recieved</h1><br>
                    </center>

                </div>
            </div>
        </div>
    </section>

    <!-- footer srk -->
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
</body>

</html>
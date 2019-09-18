<!DOCTYPE html>
<html lang="en">
<?php
$ee = '';
session_start();
try {
    $max = 0;
    $searchresult = array();
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['search'])) {
        $qname = strtolower($_POST["q"]);
        $query1 = $dbhandler->query("select Title from movies;");
        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);

        $query2 = $dbhandler->query("select Title from tvshows;");
        $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

        $query3 = $dbhandler->query("select Title from musics;");
        $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
        $media = '';
        for ($i = 0; $i < count($result1); $i++) {
            $dbtitle = strtolower($result1[$i]["Title"]);
            similar_text($qname, $dbtitle, $percent);
            if ($percent > 60.0) {
                array_push($searchresult, $result1[$i]["Title"]);
                $media = "mv";
            }
        }
        if (count($searchresult) == 0) {
            for ($i = 0; $i < count($result2); $i++) {
                $dbtitle = strtolower($result2[$i]["Title"]);
                similar_text($qname, $dbtitle, $percent);
                if ($percent > 60.0) {
                    array_push($searchresult, $result2[$i]["Title"]);
                    $media = "tv";
                }
            }
        }
        if (count($searchresult) == 0) {
            for ($i = 0; $i < count($result3); $i++) {
                $dbtitle = strtolower($result3[$i]["Title"]);
                similar_text($qname, $dbtitle, $percent);
                if ($percent > 60.0) {
                    array_push($searchresult, $result3[$i]["Title"]);
                    $media = "mu";
                }
            }
        }
        if (count($searchresult) == 0) {
            for ($i = 0; $i < count($result1); $i++) {
                $dbtitle = strtolower($result1[$i]["Title"]);
                similar_text($qname, $dbtitle, $percent);
                if ($percent > 10.0 && substr($qname, 0, 1) == substr($dbtitle, 0, 1)) {
                    array_push($searchresult, $result1[$i]["Title"]);
                    $media = "mv";
                }
            }
        }
        if (count($searchresult) == 0) {
            for ($i = 0; $i < count($result2); $i++) {
                $dbtitle = strtolower($result2[$i]["Title"]);
                similar_text($qname, $dbtitle, $percent);
                if ($percent > 10.0 && substr($qname, 0, 1) == substr($dbtitle, 0, 1)) {
                    array_push($searchresult, $result2[$i]["Title"]);
                    $media = "tv";
                }
            }
        }
        if (count($searchresult) == 0) {
            for ($i = 0; $i < count($result3); $i++) {
                $dbtitle = strtolower($result3[$i]["Title"]);
                similar_text($qname, $dbtitle, $percent);
                if ($percent > 10.0 && substr($qname, 0, 1) == substr($dbtitle, 0, 1)) {
                    array_push($searchresult, $result3[$i]["Title"]);
                    $media = "mu";
                }
            }
        }
        $finalresult = array();
        if (count($searchresult) != 0) {
            $mid = $searchresult[0];
        }
        if ($media == "mv") {
            $query = $dbhandler->query("select Poster,Movie_Id from movies where Title='$mid';");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $finalresult = $result[0];
        } elseif ($media == "tv") {
            $query = $dbhandler->query("select Poster,TvShow_Id from tvshows where Title='$mid';");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $finalresult = $result[0];
        } elseif ($media == "mu") {
            $query = $dbhandler->query("select Poster,Music_Id from musics where Title='$mid';");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $finalresult = $result[0];
        }
        if (count($finalresult) == 0) { } elseif ($media == 'mv') {
            $id = $finalresult["Movie_Id"];
            header("Location:http://localhost/med/moviedetail.php?id=" . $id);
        } elseif ($media == 'tv') {
            $id = $finalresult["TvShow_Id"];
            header("Location: http://localhost/med/tvshowdetail.php?id=" . $id);
        } elseif ($media == 'mu') {
            $id = $finalresult["Music_Id"];
            header("Location: http://localhost/med/musicdetail.php?id=" . $id);
        }
    }
} catch (PDOException $e) {
    $ee = $e;
    die();
}

?>

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
                                            <li><a href="index.php">
                                                    <form method="POST" action="index.php">
                                                        <p class="auth"><button type="submit" name="logout" style="font-weight:800; color:black; padding:10px; background-color: transparent; border: 3px solid white; color: white; padding: 10px 22px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">
                                                                LogOut
                                                            </button></p>
                                                    </form>

                                                </a></li>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </ul>
                    </nav>
                    <div class="hero-text">
                        <h1>Search Result</h1>
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
    <!-- main srk-->
    <section class="case-study">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper-container">
                        <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Search </span>Result<br></h1>
                        <div style="padding-left:450px; width:150%;">
                            <center>
                                <?php if (count($finalresult) == 0) {
                                    echo "<center>
                                    <h2 style='padding-right:1000px;'>No Result Found</h2>
                                </center>";
                                }
                                echo $ee;
                                ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- foot er srk -->
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
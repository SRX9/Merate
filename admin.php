<!DOCTYPE html>
<html lang="en">
<?php
$n = 5;
function generateid($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

session_start();
if (isset($_POST['addd'])) {
    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $_SESSION['add'] = "addyes";
        if ($_POST['media'] == 'movie') {
            $title = $_POST['name'];
            $id = $_POST['id'];
            $story = $_POST['story'];
            $poster = $_POST['poster'];
            $trailer = $_POST['trailer'];
            $gross = $_POST['gross'];
            $query = $dbhandler->exec("insert into movies (Movie_Id,Title,Description,Gross,Poster,Trailer) values('$id','$title','$story','$gross','$poster','$trailer')");
        } elseif ($_POST['media'] == 'tvshow') {
            $title = $_POST['name'];
            $id = $_POST['id'];
            $story = $_POST['story'];
            $poster = $_POST['poster'];
            $trailer = $_POST['trailer'];
            $season = $_POST['season'];
            $trp = $_POST['trp'];
            $query = $dbhandler->exec("insert into tvshows (TvShow_Id,Title,Current_Season,Description,Poster,Trailer,TRP) values('$id','$title','$season','$story','$poster','$trailer','$trp') ");
        } elseif ($_POST['media'] == 'music') {
            $artist = $_POST['artist'];
            $pid = generateid($n);

            $title = $_POST['name'];
            $id = $_POST['id'];
            $poster = $_POST['poster'];
            $trailer = $_POST['trailer'];
            $total = $_POST['total'];
            $query = $dbhandler->exec("insert into musics (Music_Id,Title,Totel_Stream,Poster,Song) values('$id','$title','$total','$poster','$trailer')");
            $query = $dbhandler->exec("insert into music_person  values('$id','$pid','aaa')");
            $query = $dbhandler->exec("insert into person (Person_Id,Name)  values('$pid','$artist')");
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
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

                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        $user = $_SESSION['user'];
                                        ?>
                                        <td style="padding-bottom:30px;">
                                            <h2 style="padding-left:10px;"><b>Admin </b><?php echo $user ?><h2><br>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </ul>
                    </nav>
                    <div class="hero-text">
                        <h1>Medate</h1>
                        <h3 style="font-size:50px;">Administration</h3>
                        <a href="profile.php">
                            <form action="index.php" method="post">
                                <div style="float:right;"><input type="submit" class="button button5" style="padding:4px;cursor:pointer;" name="adminout" value="Logout" /></div>
                            </form>
                        </a>
                        <?php if (isset($_SESSION['update'])) {
                            unset($_SESSION['update']);
                            $_SESSION['user']=$user;
                            ?>
                            <h3><b>Database Synchronized Succesfully</b></h3>

                        <?php } else {
                        ?>
                            <a href="update.php">
                                <div style="float:right; padding-right:10px;"><input type="submit" class="button button5" style="padding:4px;cursor:pointer;width:200px" name="adminout" value="Snychronize Database" /></div>
                            </a>
                        <?php } ?>
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
                        <?php if (isset($_SESSION['add'])) { ?>
                            <h1 class="heading green" style="padding-left:20px;color:greenyellow"><span class="green">Data Succesfully</span>Added<br></h1><br>
                            <?php
                            unset($_SESSION['add']);
                        } ?>
                        <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Add </span>Movies<br></h1>
                        <div style="padding-left:400px; width:150%;">
                            <form method="POST" action="admin.php">
                                <input type="hidden" name="media" value="movie" />
                                <input type="text" id="fname" name="name" placeholder="Movie Name" /><br>
                                <input type="text" id="fname" name="id" placeholder="MovieId" /><br>
                                <textarea style="width:30%;box-shadow:none;" placeholder="Story" name="story"></textarea><br>
                                <input type="text" id="fname" name="gross" placeholder="Gross" /><br>
                                <input type="text" id="fname" name="poster" placeholder="Poster Link" /><br>
                                <input type="text" id="fname" name="trailer" placeholder="Youtube Trailer Video Id" /><br>
                                <div style="padding-left:140px"><input class="button button5" style="padding-left:5px;" type="submit" name="addd" value="   Add Movie" /></a></div>
                            </form>
                        </div>
                        <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Add </span>TV Shows<br></h1>
                        <div style="padding-left:400px; width:150%;">
                            <form method="POST" action="admin.php">
                                <input type="hidden" name="media" value="tvshow" />
                                <input type="text" id="fname" name="name" placeholder="TVShow Name" /><br>
                                <input type="text" id="fname" name="id" placeholder="TVShow Id" /><br>
                                <textarea style="width:30%;box-shadow:none;" placeholder="Story" name="story"></textarea><br>
                                <input type="text" id="fname" name="trp" placeholder="TRP" /><br>
                                <input type="text" id="fname" name="season" placeholder="Season" /><br>
                                <input type="text" id="fname" name="poster" placeholder="Poster Link" /><br>
                                <input type="text" id="fname" name="trailer" placeholder="Youtube Trailer Video Id" /><br>
                                <div style="padding-left:140px"><input class="button button5" style="padding-left:5px;" type="submit" name="addd" value=" Add TV Show" /></a></div>
                            </form>
                        </div>
                        <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Add </span>Music<br></h1>
                        <div style="padding-left:400px; width:150%;">
                            <form method="POST" action="admin.php">
                                <input type="hidden" name="media" value="music" />
                                <input type="text" id="fname" name="name" placeholder="Music Name" /><br>
                                <input type="text" id="fname" name="artist" placeholder="Artist Name" /><br>
                                <input type="text" id="fname" name="id" placeholder="Music Id" /><br>
                                <input type="text" id="fname" name="total" placeholder="Total Online Streams" /><br>
                                <input type="text" id="fname" name="poster" placeholder="Poster Link" /><br>
                                <input type="text" id="fname" name="trailer" placeholder="Youtube Song Video Id" /><br>
                                <div style="padding-left:140px"><input class="button button5" style="padding-left:5px;" type="submit" name="addd" value="   Add Music" /></a></div>
                            </form>
                        </div>
                    </div>
                </div>
                <style>
                    input {
                        width: 30%;
                        padding: 12px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;
                        border: 3px solid grey;
                        -webkit-transition: 0.5s;
                        transition: 0.5s;
                        outline: none;
                    }

                    input:focus {
                        border: 3px solid black;
                    }

                    textarea {
                        width: 30%;
                        padding: 12px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;
                        border: 3px solid grey;
                        -webkit-transition: 0.5s;
                        transition: 0.5s;
                        outline: none;
                    }

                    textarea:focus {
                        border: 3px solid black;
                    }
                </style>
            </div>
        </div>
    </section>

    <!-- foot er srk -->
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
</body>

</html>
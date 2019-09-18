<!DOCTYPE html>
<html lang="en">
<?php


$profile;
$reviewgiven;
session_start();
$username = $_SESSION['user'];
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $dbhandler->query("select * from user_details where username='$username'");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $profile = $result[0];
    $query = $dbhandler->query("select rid from review where user='$username'");
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $reviewgiven = count($results);
} catch (PDOException $e) {
    echo $e;
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
                        <h1>Profile</h1>
                        <a href="edit.php">
                            <div style="float:right;"><input class="button button5" style="padding:4px;" type="submit" name="edit" value="Edit Profile" /></div>
                        </a>
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
                    <div class="swiper-container client-swiper">
                        <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Account </span>Info<br></h1>
                        <center>
                            <h1 class="heading blue" style="padding-left:20px;padding-top:15px;"><span class="blue">Username </span><br><?php echo $profile["username"] ?><br></h1>
                            <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Email </span><br><?php echo $profile["Email"] ?><br></h1>
                            <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Password </span><br><?php echo $profile["Password"] ?><br>
                                <h1 class="heading blue" style="padding-left:20px;"><span class="blue">Reviews Given </span><br><?php echo $reviewgiven; ?><br>
                                </h1>

                        </center>

                    </div>
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
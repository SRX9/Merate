<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$d = '';
if (isset($_POST['login'])) {
    $username = $_POST['name'];
    $pass = $_POST['pass'];
    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("select id from admin where username='$username' and Password='$pass'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0)
            $d = "Wrong Credentials";
        else {
            $_SESSION['user'] = $username;
            header("Location: http://localhost/med/admin.php");
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
                                    <td style="padding:9px;">
                                        <li><a href="index.php">
                                                <p style="color:white;">Home<p>
                                            </a></li>
                                    </td>
                                </tr>
                            </table>
                        </ul>
                    </nav>
                    <div class="hero-text">
                        <h1>Medate</h1>
                        <h3>
                            <table>
                                <td style="padding:9px;">
                                    <a href="movie.php">
                                        <p style="color:white;border-right:2px solid white;padding-right:10px;">Movies
                                            <p>
                                    </a>
                                </td>
                                <td style="">
                                    <a href="tvshow.php">
                                        <p style="color:white;border-right:2px solid white;padding-right:10px;">TV Shows
                                            <p>
                                    </a>
                                </td>
                                <td style="padding:9px;">
                                    <a href="music.php">
                                        <p style="color:white;padding:3px;">Music<p>
                                    </a>
                                </td>
                            </table>
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
                    <h1 class="heading purple" style="padding-left:20px;"><span class="purple">Admin</span> Login<br>
                    </h1>
                    <div class="swiper-container client-swiper">
                        <?php
                        echo "<h3 style='padding-left:495px;color:red;'>$d</h3>";
                        ?>
                        <div class="swiper-wrapper" style="padding-left:450px;">
                            <center>

                                <form method="POST" action="adminlog.php">
                                    <input type="text" id="fname" name="name" placeholder="Username" /><br>
                                    <input type="password" id="fname" name="pass" placeholder="Password" /><br>
                                    <div style="padding-left:70px"><input class="button button5" style="padding:4px;" type="submit" name="login" value="Login" /></a></div>
                                </form>

                                <style>
                                    input {
                                        width: 130%;
                                        padding: 12px 20px;
                                        margin: 8px 0;
                                        box-sizing: border-box;
                                        border: 3px solid white;
                                        -webkit-transition: 0.5s;
                                        transition: 0.5s;
                                        outline: none;
                                    }

                                    input:focus {
                                        border: 3px solid black;
                                    }
                                </style>
                            </center>


                        </div>
                    </div>
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
</body>

</html>
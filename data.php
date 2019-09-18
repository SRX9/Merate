<?php
function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}
$result;
$final = array();
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=mdb', 'srk', 'srk');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbhandler->query("select Song from musics");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($result); $i++) {
            $song =$result[$i]["Song"];
            $response = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&id='.$song.'&key=AIzaSyBvsuTz3IxNMamLZWRcN_UhdFM1zPY1VIg');
            $response = json_decode($response);
            $like = $response->items[0]->statistics->likeCount;
            $view = $response->items[0]->statistics->viewCount;
            $query = $dbhandler->exec("UPDATE musics SET Likes='$like',Youtub_Views='$view' WHERE Song='$song'");
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
    

?>
<?php
    
$domain = "http://localhost/";
    session_start();
    if (!isset($_SESSION["userId"])) {
        header("Location: /");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DaisyDale</title>
    <link type="image/png" href="/favicon.png" rel="icon" />
    <link rel="stylesheet" href="/game.css">
</head>
<body>
    
         <div class="container">
            <div class="centered">
                <embed type="application/x-shockwave-flash" src="base.swf"
                    style="width: 100%"
		    flashvars="<?php echo "game_server=" . $domain . "&url_path_server=" . $domain . "&portal_url=" . $domain . "&manual_server_selection=&start_step=0&useHashInName="; ?>"
            </div>
        </div>

    <p><a href="/items.html">Список предметов</a></p>
    <p> <a href="/logout.php">Выйти</a></p>
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
    <script type="text/javascript">
        function resize_embed() {
                    $("embed").height(($(window).height() / $(window).width()) * $("embed").width());
        }

        $(document).ready(resize_embed);
        $(window).resize(resize_embed);
    </script>
</div>
</body>

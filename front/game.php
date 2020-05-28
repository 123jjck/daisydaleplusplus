<?php
session_start();
if (!isset($_SESSION["userId"])) {
	header("Location: /");
}

$domain = (stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DD++</title>
    <link type="image/png" href="/favicon.png" rel="icon" />
    <link rel="stylesheet" href="/game.css">
</head>

<body>
    <div class="container">
        <div class="centered">
            <object id="base" name="base" menu="true" allowfullscreen="true" allowscriptaccess="always"  type="application/x-shockwave-flash" data="base.swf?v=1337" style="width: 100%"><param name="flashvars" value="<?php echo "game_server=" . $domain . "&url_path_server=" . $domain . "&portal_url=" . $domain . "&manual_server_selection=&start_step=0&useHashInName="; ?>"></object>
	</div>
    </div>
    <p><a href="/cabinet.php">Кабинет</a></p>
    <p><a href="/logout.php">Выйти</a></p>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function resize_embed() {
            $("#base").height(($(window).height() / $(window).width()) * $("#base").width());
        }
        $(document).ready(resize_embed);
        $(window).resize(resize_embed);
    </script>
</body>

</html>

<!DOCTYPE html>
<html>
<head lang="de">
    <meta charset="UTF-8">
    <title>PASSWD - KAYOS UG</title>
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <script src="javascript/passwd.js"></script>
    <link rel="stylesheet" type="text/css" href="css/passwd.css"  media="screen and (min-width: 601px)" />
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (min-device-width : 320px) and (max-device-width : 480px) , screen and (max-width: 600px)">
    <link rel="shortcut icon" href="https://passwd.kayos.eu/favicon.png" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

<a href="ajax/help.php" class="help" title="Hilfe"></a>
<section class="form">
    <h1><img src="images/logo_kayos.png" alt="KAYOS UG" style="width: 50px; height: 50px;" /><br />Passwort ändern</h1>
    <form action="ajax/verify.php" method="post" id="userdata">
        <input type="text" name="kayosid" placeholder="KAYOS-ID" autocomplete="off" required="required" />
        <input type="password" name="oldpass" placeholder="altes Passwort" id="pw" required="required" />
        <p>
            <input type="password" name="newpass" placeholder="neues Passwort" required="required" />
            <input type="password" name="newpassconf" placeholder="neues Passwort wiederholen" required="required" />
        </p>
        <button><span class="fa fa-arrow-right"></span></button>
    </form>
    <div style="clear: both;"></div>
</section>
<section class="overlay">
    <section class="form"></section>
</section>

</body>
</html>
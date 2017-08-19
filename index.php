<?php
/**
 * Uberspace passwd
 *
 * Author:      Michael Ochmann
 * Author URL:  http://mike-ochmann.de
 * Version:     0.5.0
 * License:     CreativeCommons -- Attribution-NonCommercial-ShareAlike 4.0 International
 *
 * You have to leave both attribution comments in the sourcecode.
 */
?>
<!DOCTYPE html>
<!--
######################################################################
## Uberspace passwd                                                 ##
##                                                                  ##
## a script by Michael Ochmann                                      ##
##   -- http://mike-ochmann.de                                      ##
##   -- miko@massivedynamic.eu                                      ##
##                                                                  ##
## find it at GitHub: https://github.com/miko007/Uberspace-passwd/  ##
##                                                                  ##
## (C) 2015, Michael Ochmann, Massive Dynamic                       ##
######################################################################
-->
<html>
<head lang="de">
    <meta charset="UTF-8">
    <title>PASSWD - KAYOS UG</title>
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <script src="javascript/passwd.js"></script>
    <link rel="stylesheet" type="text/css" href="css/passwd.css"  media="screen and (min-width: 601px)" />
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (min-device-width : 320px) and (max-device-width : 480px) , screen and (max-width: 600px)">
    <link rel="shortcut icon" href="https://passwd.subdomain.de/favicon.png" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

<a href="ajax/help.php" class="help" title="Hilfe"></a>
<section class="form">
    <h1><img src="images/logo_kayos.png" alt="Company Name" style="width: 50px; height: 50px;" /><br />Passwort ändern</h1>
    <form action="ajax/verify.php" method="post" id="userdata">
        <input type="text" name="companyid" placeholder="COMPANY-ID" autocomplete="off" required="required" />
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

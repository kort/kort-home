<?php
/**
 * kort - List of all proposed solutions with their specific information
 */

/** Load the ClassLoader */
require_once('./php/ClassLoader.php');
Kort\ClassLoader::registerAutoLoader();

use Helper\HttpHelper;

$statisticsUrl = 'https://kort.dev.ifs.hsr.ch/v1.0/statistics';
$http = new HttpHelper();
$result = $http->get($statisticsUrl);
$statistics = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kort - Dokumentation</title>
    <meta charset="utf-8">
	
	<!-- Facebook -->          
	<meta property="og:title" content="Kort" />
	<meta property="og:type" content="summary_large_image" />
 	<meta property="og:description" content="Kort - An OpenStreetMap Game" />
	<meta property="og:image" content="http://www.kort.ch/resources/images/twitterCard.png" />

	<!-- Twitter -->          
	<meta name="twitter:title" content="Kort"/>
	<meta name="twitter:creator" content="@KortGame"/>
	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:description" content="Kort - An OpenStreetMap Game"/>
	<meta name="twitter:image" content="http://www.kort.ch/resources/images/twitterCard.png"/>
	
    <link rel="icon" href="./resources/images/kort-favicon.ico" type="image/png" />
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="resources/styles/styles.scss">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="index.html">Kort</a>
                <ul class="nav">
                    <li><a href="index.html"><i class="nav-icon icon-home"></i> Home</a></li>
					<li class="active"><a href="documentation.php"><i class="nav-icon icon-tasks icon-white"></i> Dokumentation</a></li>
                    <li><a href="about.html"><i class="nav-icon icon-user"></i> Über uns</a></li>
					<li><a href="documentation_en.php"><i class="nav-icon icon-home icon-white"></i> Englisch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <header class="jumbotron subhead">
        <div class="container">
            <h1>Dokumentation</h1>
            <p>Fakten über Kort</p>
        </div>
    </header>
    
    <div class="content statistics">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <?php
                    if (!empty($statistics)) {
                        $values = $statistics['return'][0];
                        ?>
                        <h3>Benutzer</h3>
                        <div class="row">
                            <div class="span3">
                                <img class="statistics-image" src="resources/images/statistics/user.png" />
                            </div>
                            <div class="span5">
                                <?php
                                echo "<table class='table table-striped stats'>\n";
                                    echo "<tr>\n";
                                        echo "<th>OpenStreetMap</th>\n";
                                        echo "<td>" . $statistics['osm_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>Google</th>\n";
                                        echo "<td>" . $statistics['google_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th class='important'>Total</th>\n";
                                        echo "<td>" . $statistics['user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                echo "</table>\n";
                                ?>
                            </div>
                        </div>
                        <h3>Aufträge</h3>
                        <div class="row">
                            <div class="span3">
                                <img class="statistics-image" src="resources/images/statistics/fixes.png" />
                            </div>
                            <div class="span5">
                                <?php
                                echo "<table class='table table-striped stats'>\n";
                                    echo "<tr>\n";
                                        echo "<th class='important'>Erledigte Aufträge</th>\n";
                                        echo "<td>" . $statistics['fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>Davon noch nicht überprüft</th>\n";
                                        echo "<td>" . $statistics['incomplete_fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>Davon vollständig überprüft</th>\n";
                                        echo "<td>" . $statistics['complete_fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                echo "</table>\n";
                                ?>
                            </div>
                        </div>
                        <h3>Gewonnene Auszeichnungen</h3>
                        <div class="row">
                            <div class="span12">
                                <?php
                                $badgesUrl = 'http://play.kort.ch/resources/images/badges/';
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_10.png' />\n";
                                echo "<p>10 Aufträge: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_50.png' />\n";
                                echo "<p>50 Aufträge: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_100.png' />\n";
                                echo "<p>100 Aufträge: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_10.png' />\n";
                                echo "<p>10 Prüfungen: <span class='value'>"  . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_100.png' />\n";
                                echo "<p>100 Prüfungen: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_1000.png' />\n";
                                echo "<p>1000 Prüfungen: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_3.png' />\n";
                                echo "<p>3. Platz: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_2.png' />\n";
                                echo "<p>2. Platz: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_1.png' />\n";
                                echo "<p>1. Platz: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_1.png' />\n";
                                echo "<p>1. Auftrag: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_1.png' />\n";
                                echo "<p>1. Prüfung: <span class='value'>" . "</span></p>\n";
                                echo "</div>\n";
                                ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<div class=\"alert alert-error\">Fehler beim Laden der Statistik.</div>\n";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p class="pull-left">&copy; <a href="https://creativecommons.org/licenses/by-nc/4.0/" target="blank">CC BY-NC</a> - <a href="http://www.hsr.ch/geometalab" target="blank">Geometa Lab HSR</a> - HSR Hochschule für Technik Rapperswil</p>
        </div>
    </footer>
    
    <a href="https://github.com/kort/kort" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 1500;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
    <!-- UserVoice widget -->
    <script type="text/javascript">
    var uvOptions = {};
    (function() {
        var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
        uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/ciFv45SRa04ZQzkujVJKw.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
    })();
    </script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-37644286-2']);
        _gaq.push(['_trackPageview']);

        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

      </script>
	<!-- Piwik -->
	<script type="text/javascript">
	  var _paq = _paq || [];
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
		var u="//log.hsr.ch/";
		_paq.push(['setTrackerUrl', u+'piwik.php']);
		_paq.push(['setSiteId', '90']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
</body>
</html>

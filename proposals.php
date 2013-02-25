<?php
/**
 * kort - List of all proposed solutions with their specific information
 */

/** Load the ClassLoader */
require_once('./php/ClassLoader.php');
Kort\ClassLoader::registerAutoLoader();

use Helper\HttpHelper;
use Helper\LocaleHelper;
use Osm\OsmChecker;

$fixesUrl = 'http://play.kort.ch/server/webservices/bug/fix/completed';
$http = new HttpHelper();
$locale = new LocaleHelper("de");
$result = $http->get($fixesUrl);
$fixes = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kort - L&ouml;sungsvorschl&auml;ge</title>
    <meta charset="utf-8">
    <link rel="icon" href="./resources/images/kort-favicon.ico" type="image/png" />
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="resources/styles/styles.css">
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
                    <li><a href="screenshots.html"><i class="nav-icon icon-picture"></i> Screenshots</a></li>
                    <li><a href="developers.html"><i class="nav-icon icon-user"></i> Entwickler</a></li>
                    <li><a href="statistics.php"><i class="nav-icon icon-tasks"></i> Statistiken</a></li>
                    <li class="active"><a href="proposals.php"><i class="nav-icon icon-ok-sign icon-white"></i> Lösungen</a></li>
                </ul>
                <p><a href="http://play.kort.ch" target="_blank" class="btn btn-success" type="button">Jetzt spielen! <i class="icon-play-circle icon-white"></i></a></p>
            </div>
        </div>
    </div>
    <header class="jumbotron subhead">
        <div class="container">
            <h1>L&ouml;sungsvorschl&auml;ge</h1>
            <p>Von Kort-Benutzern erfasst und validiert</p>
        </div>
    </header>
    
    <div class="content">
        <div class="container with-margin">
            <div class="row">
               <div class="span12">
                    <p class="lead">
                        Derzeit ist das Zurückschreiben der validierten Daten zu OSM nicht implementiert! 
                        Stattdessen können Mapper auf dieser Seite die validierten Lösungen anschauen und diese allenfalls in OSM einpflegen.
                        Aus Peformancegründen werden nur <strong>10 validierte Lösungen</strong> angezeigt.
                    </p>
                    <?php
                    if (!empty($fixes)) {
                    ?>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="120">Erfasser</th>
                            <th width="*">Fehler</th>
                            <th width="*">Lösungsvorschlag</th>
                            <th width="80">Prüfungen</th>
                            <th width="80">OSM-Objekt</th>
                            <th width="80">Bearbeiten in OSM</th>
                        </tr>
                        <?php
                        $fixCount = 0;
                        foreach ($fixes as $fix) {
                            if ($fixCount >= 10) {
                                break;
                            }
                            if (OsmChecker::notChangedInOsm($fix)) {
                                $fixCount += 1;
                                echo "<tr>\n";
                                echo "<td>" . $fix['username'] . "<br /><small><em>" . $fix['formatted_create_date'] . "</em></small></td>\n";
                                echo "<td>";
                                echo "<img class='error-type' src='http://play.kort.ch/resources/images/marker_icons/" . $fix['error_type'] . ".png' />";
                                echo "<strong>" . $locale->getValue($fix['error_type_description']) . "</strong>";
                                echo "</td>\n";

                                // answer
                                if ($fix['falsepositive'] == "t") {
                                    $fix['answer'] = "Nicht lösbar";
                                }
                                echo "<td><p class=\"text-success\"><strong>" . $fix['answer'] . "</strong></p></td>\n";

                                // votes
                                $fix['votes'] = "";
                                if ($fix['upratings'] > 0) {
                                    $thumbsUp = "<img class=\"thumb\" src=\"./resources/images/proposals/thumbs-up.png\" />";
                                    $fix['votes'] = $fix['votes'] . "+" . $fix['upratings'] . $thumbsUp;
                                }
                                if ($fix['downratings'] > 0) {
                                    $thumbsDown = "<img class=\"thumb\" src=\"./resources/images/proposals/thumbs-down.png\" />";
                                    $fix['votes'] = $fix['votes'] . "-" . $fix['downratings'] . $thumbsDown;
                                }
                                echo "<td>" . $fix['votes'] . "</td>\n";

                                // osm link
                                $osmUrl = "http://www.openstreetmap.org/browse/" . $fix['osm_type'] . "/" . $fix['osm_id'];
                                $fix['osm_link'] = "<a href=\"" . $osmUrl . "\" target=\"_blank\">" . $fix['osm_id'] . "</a>";
                                echo "<td>" . $fix['osm_link'] . "</td>\n";

                                // edit
                                $potlatchUrl  = "http://www.openstreetmap.org/edit?editor=potlatch2&";
                                $potlatchUrl .= "lat=" . $fix['latitude'] . "&lon=" . $fix['longitude'] . "&zoom=18";

                                $josmUrl  = "http://localhost:8111/load_and_zoom?zoom_mode=download&";
                                $josmUrl .= "left=" . ($fix['longitude'] - 0.002) . "&";
                                $josmUrl .= "right=" . ($fix['longitude'] + 0.002) . "&";
                                $josmUrl .= "top=" . ($fix['latitude'] + 0.002) . "&";
                                $josmUrl .= "bottom=" . ($fix['latitude'] - 0.002) . "&";
                                $josmUrl .= "select=" . $fix['osm_type'] . $fix['osm_id'];

                                $keeprightUrl  = "http://www.keepright.at/report_map.php";
                                $keeprightUrl .= "?schema=" . $fix['schema'] . "&error=" . $fix['error_id'];

                                $fix['edit'] = "<div class=\"btn-group\">";
                                $fix['edit'] = $fix['edit'] . "<a class=\"btn btn-info dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
                                $fix['edit'] = $fix['edit'] . "Editor";
                                $fix['edit'] = $fix['edit'] . " <span class=\"caret\"></span>";
                                $fix['edit'] = $fix['edit'] . "</a>";
                                $fix['edit'] = $fix['edit'] . "<ul class=\"dropdown-menu\">";
                                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $potlatchUrl . "\"><i class=\"icon-pencil\"></i> Potlatch 2</a></li>";
                                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $josmUrl . "\"><i class=\"icon-pencil\"></i> JOSM</a></li>";
                                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $keeprightUrl . "\"><i class=\"icon-pencil\"></i> KeepRight</a></li>";
                                $fix['edit'] = $fix['edit'] . "</ul>";
                                $fix['edit'] = $fix['edit'] . "</div>";

                                echo "<td>" . $fix['edit'] . "</td>\n";

                                echo "</tr>\n";
                            }
                        }
                        ?>
                    </table>
                    <?php
                    } else {
                        echo "<div class=\"alert alert-info\">Derzeit sind keine validierten L&ouml;sungsvorschl&auml;ge vorhanden.</div>";
                    }
                    ?>
               </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p class="pull-left">&copy; 2013 Stefan Oderbolz, Jürg Hunziker</p>
            <p class="pull-right"><a href="http://www.hsr.ch/informatik" target="_blank"><img class="image-hsr-logo" src="resources/images/hsr_logo.png" /></a></p>
            <p class="pull-right"><a href="http://www.hsr.ch/informatik" target="_blank">Informatik-Studium an der HSR</a></p>
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
</body>
</html>

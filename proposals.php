<?php
/**
 * kort - List of all proposed solutions with their specific information
 */

/** Load the ClassLoader */
require_once('./php/ClassLoader.php');
Kort\ClassLoader::registerAutoLoader();

use Helper\CurlHelper;

$fixesUrl = 'http://localhost/kort/server/webservices/bug/fix/completed'
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kort - L&ouml;sungsvorschl&auml;ge</title>
    <meta charset="utf-8">
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
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="proposals.php">Lösungen</a></li>
                </ul>
                <p><a href="http://www.kort.ch" class="btn btn-success" type="button">Jetzt spielen!</a></p>
            </div>
        </div>
    </div>
    <header class="jumbotron subhead">
        <div class="container">
            <h1>L&ouml;sungsvorschl&auml;ge</h1>
            <p>Von Benutzern von Kort erfasst und validiert.</p>
        </div>
    </header>
    <div class="container with-margin">
        <?php
        $curl = new CurlHelper();
        $curl->setOption(CURLOPT_URL, $fixesUrl);
        $curl->setOption(CURLOPT_RETURNTRANSFER, 1);
        $result = $curl->execute();
        $curl->close();
        $fixes = json_decode($result, true);
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
            foreach ($fixes as $fix) {
                echo "<tr>\n";
                echo "<td>" . $fix['username'] . "<br /><small><em>" . $fix['formatted_create_date'] . "</em></small></td>\n";
                echo "<td><strong>" . $fix['error_type'] . "</strong></td>\n";
                
                // answer
                if ($fix['falsepositive'] == "t") {
                    $fix['answer'] = "Nicht lösbar";
                }
                echo "<td><p class=\"text-success\"><strong>" . $fix['answer'] . "</strong></p></td>\n";
                
                // votes
                $fix['votes'] = "";
                if ($fix['upratings'] > 0) {
                    $thumbsUp = "<img class=\"thumb\" src=\"./resources/images/thumbs-up.png\" />";
                    $fix['votes'] = $fix['votes'] . "+" . $fix['upratings'] . $thumbsUp;
                }
                if ($fix['downratings'] > 0) {
                    $thumbsDown = "<img class=\"thumb\" src=\"./resources/images/thumbs-down.png\" />";
                    $fix['votes'] = $fix['votes'] . "-" . $fix['downratings'] . $thumbsDown;
                }
                echo "<td>" . $fix['votes'] . "</td>\n";
                
                // osm link
                $osmUrl = "http://www.openstreetmap.org/browse/" . $fix['osm_type'] . "/" . $fix['osm_id'];
                $fix['osm_link'] = "<a href=\"" . $osmUrl . "\" target=\"_blank\">" . $fix['osm_id'] . "</a>";
                echo "<td>" . $fix['osm_link'] . "</td>\n";
                
                // edit
                $potlatchUrl  = "http://www.openstreetmap.org/edit?editor=potlatch2&";
                $remoteUrl  = "http://www.openstreetmap.org/edit?editor=remote&";
                $params = "lat=" . $fix['latitude'] . "&lon=" . $fix['longitude'] . "&zoom=18";
                $keeprightUrl  = "http://www.keepright.at/report_map.php";
                $keeprightUrl .= "?schema=" . $fix['schema'] . "&error=" . $fix['error_id'];

                $fix['edit'] = "<div class=\"btn-group\">";
                $fix['edit'] = $fix['edit'] . "<a class=\"btn btn-info dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
                $fix['edit'] = $fix['edit'] . "Editor";
                $fix['edit'] = $fix['edit'] . " <span class=\"caret\"></span>";
                $fix['edit'] = $fix['edit'] . "</a>";
                $fix['edit'] = $fix['edit'] . "<ul class=\"dropdown-menu\">";
                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $potlatchUrl . $params . "\"><i class=\"icon-pencil\"></i> Potlatch 2</a></li>";
                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $remoteUrl . $params . "\"><i class=\"icon-pencil\"></i> JSOM</a></li>";
                $fix['edit'] = $fix['edit'] . "<li><a target=\"_blank\" href=\"" . $keeprightUrl . "\"><i class=\"icon-pencil\"></i> KeepRight</a></li>";
                $fix['edit'] = $fix['edit'] . "</ul>";
                $fix['edit'] = $fix['edit'] . "</div>";
                
                echo "<td>" . $fix['edit'] . "</td>\n";
                
                echo "</tr>\n";
            }
            ?>
        </table>
    </div>
    <a href="https://github.com/odi86/kort" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 1500;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
</body>
</html>
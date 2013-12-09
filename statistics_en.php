<?php
/**
* kort - List of all proposed solutions with their specific information
*/

/** Load the ClassLoader */
require_once('./php/ClassLoader.php');
Kort\ClassLoader::registerAutoLoader();

use Helper\HttpHelper;

$statisticsUrl = 'http://play.kort.ch/server/webservices/statistics/';
$http = new HttpHelper();
$result = $http->get($statisticsUrl);
$statistics = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Kort - Statistics</title>
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
<li><a href="developers.html"><i class="nav-icon icon-user"></i> Developers</a></li>
<li class="active"><a href="statistics.php"><i class="nav-icon icon-tasks icon-white"></i> Statistics</a></li>
<li><a href="proposals.php"><i class="nav-icon icon-ok-sign"></i> Solutions</a></li>
<li><a href="statistics.php"><i class="nav-icon icon-home icon-white"></i> German</a></li>
</ul>
<p><a href="http://play.kort.ch" target="_blank" class="btn btn-success" type="button">Play now! <i class="icon-play-circle icon-white"></i></a></p>
</div>
</div>
</div>
<header class="jumbotron subhead">
<div class="container">
<h1>Statistics</h1>
<p>Facts about Kort</p>
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
<h3>Users</h3>
<div class="row">
<div class="span3">
<img class="statistics-image" src="resources/images/statistics/user.png" />
</div>
<div class="span5">
<?php
                                echo "<table class='table table-striped stats'>\n";
                                    echo "<tr>\n";
                                        echo "<th>OpenStreetMap</th>\n";
                                        echo "<td>" . $values['osm_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>Google</th>\n";
                                        echo "<td>" . $values['google_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>Facebook</th>\n";
                                        echo "<td>" . $values['fb_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th class='important'>Total</th>\n";
                                        echo "<td>" . $values['user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>There from active</th>\n";
                                        echo "<td>" . $values['active_user_count'] . "</td>\n";
                                    echo "</tr>\n";
                                echo "</table>\n";
                                ?>
</div>
</div>
<h3>Tasks</h3>
<div class="row">
<div class="span3">
<img class="statistics-image" src="resources/images/statistics/fixes.png" />
</div>
<div class="span5">
<?php
                                echo "<table class='table table-striped stats'>\n";
                                    echo "<tr>\n";
                                        echo "<th class='important'>Solved Tasks</th>\n";
                                        echo "<td>" . $values['fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>There from unsolvable</th>\n";
                                        echo "<td>" . $values['falsepositive_fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>There from fully examined</th>\n";
                                        echo "<td>" . $values['validated_fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                echo "</table>\n";
                                ?>
</div>
</div>
<h3>Examinations</h3>
<div class="row">
<div class="span3">
<img class="statistics-image" src="resources/images/statistics/votes.png" />
</div>
<div class="span5">
<?php
                                echo "<table class='table table-striped stats'>\n";
                                    echo "<tr>\n";
                                        echo "<th>Yet to be examined proposals for solutions</th>\n";
                                        echo "<td>" . $values['incomplete_fix_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th class='important'>Made examinations</th>\n";
                                        echo "<td>" . $values['vote_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>There from marked as correct</th>\n";
                                        echo "<td>" . $values['valid_vote_count'] . "</td>\n";
                                    echo "</tr>\n";
                                    echo "<tr>\n";
                                        echo "<th>There from marked as uncorrect</th>\n";
                                        echo "<td>" . $values['invalid_vote_count'] . "</td>\n";
                                    echo "</tr>\n";
                                echo "</table>\n";
                                ?>
</div>
</div>
<h3>Won awards</h3>
<div class="row">
<div class="span12">
<?php
                                $badgesUrl = 'http://play.kort.ch/resources/images/badges/';
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_10.png' />\n";
                                echo "<p>10 Tasks: <span class='value'>" . $values['ten_missions_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_50.png' />\n";
                                echo "<p>50 Tasks: <span class='value'>" . $values['fifty_missions_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_100.png' />\n";
                                echo "<p>100 Tasks: <span class='value'>" . $values['hundred_missions_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_10.png' />\n";
                                echo "<p>10 Examinations: <span class='value'>" . $values['ten_checks_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_100.png' />\n";
                                echo "<p>100 Examinations: <span class='value'>" . $values['hundred_checks_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_1000.png' />\n";
                                echo "<p>1000 Examinations: <span class='value'>" . $values['thousand_checks_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_3.png' />\n";
                                echo "<p>3. Place: <span class='value'>" . $values['third_place_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_2.png' />\n";
                                echo "<p>2. Place: <span class='value'>" . $values['second_place_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_1.png' />\n";
                                echo "<p>1. Place: <span class='value'>" . $values['first_place_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge clear'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_1.png' />\n";
                                echo "<p>1. Task: <span class='value'>" . $values['first_mission_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "vote_count_1.png' />\n";
                                echo "<p>1. Examination: <span class='value'>" . $values['first_check_badge_count'] . "</span></p>\n";
                                echo "</div>\n";
                                ?>
</div>
</div>
<?php
                    } else {
                        echo "<div class=\"alert alert-error\">Error loading statistics.</div>\n";
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
<p class="pull-right"><a href="http://www.hsr.ch/informatik" target="_blank">Study computer science at the HSR</a></p>
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
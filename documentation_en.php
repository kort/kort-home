<?php
/**
* kort - List of all proposed solutions with their specific information
*/

/** Load the ClassLoader */
require_once('./php/ClassLoader.php');
Kort\ClassLoader::registerAutoLoader();

use Helper\HttpHelper;
$statisticsUrl = 'https://prod.kort.dev.ifs.hsr.ch/v1.0/statistics';
$http = new HttpHelper();
$result = $http->get($statisticsUrl);
$statistics = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Kort - documentation</title>
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
<a class="brand" href="index_en.html">Kort</a>
<ul class="nav">
<li><a href="index_en.html"><i class="nav-icon icon-home"></i> Home</a></li>
<li class="active"><a href="documentation_en.php"><i class="nav-icon icon-tasks icon-white"></i> Documentation</a></li>
<li><a href="about_en.html"><i class="nav-icon icon-user"></i> About</a></li>
<li><a href="documentation.php"><i class="nav-icon icon-home icon-white"></i> German</a></li>
</ul>
</div>
</div>
</div>
<header class="jumbotron subhead">
<div class="container">
<h1>Documentation</h1>
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
<h3>Tasks</h3>
<div class="row">
<div class="span3">
<img class="statistics-image" src="resources/images/statistics/fixes.png" />
</div>
    <div class="span5">
        <?php
        echo "<table class='table table-striped stats'>\n";
        echo "<tr>\n";
        echo "<th class='important'>Missions (includes unsolvable)</th>\n";
        echo "<td>" . $statistics['fix_count'] . "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<th>Solved Missions</th>\n";
        echo "<td>" . $statistics['validated_fix_count'] . "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<th>thereof not validated</th>\n";
        echo "<td>" . $statistics['incomplete_fix_count'] . "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<th>thereof validated and ready to upload to OSM</th>\n";
        echo "<td>" . $statistics['complete_fix_count'] . "</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        ?>
    </div>
</div>
                        <h3>Solved Missions</h3>
                        <div class="row">
                            <div class="span12">
                                <?php
                                $badgesUrl = './resources/images/missions/';
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_language.png' />\n";
                                echo "<p>Language of the name unknown: <span class='value'>" . $statistics['solved_language_unknown_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_cuisine.png' />\n";
                                echo "<p>Restaurant without a cuisine: <span class='value'>" . $statistics['solved_missing_cuisine_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_floors.png' />\n";
                                echo "<p>Missing Levels: <span class='value'>" . $statistics['solved_missing_level_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_speed.png' />\n";
                                echo "<p>Missing speed limit: <span class='value'>" . $statistics['solved_missing_maxspeed_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_road.png' />\n";
                                echo "<p>Type of track unknown: <span class='value'>" . $statistics['solved_missing_track_type_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_motorway.png' />\n";
                                echo "<p>Motorway without reference: <span class='value'>" . $statistics['solved_motorway_ref_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_opening_hours.png' />\n";
                                echo "<p>Place without opening hours: <span class='value'>" . $statistics['solved_opening_hours_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_poi.png' />\n";
                                echo "<p>Object without a name: <span class='value'>" . $statistics['solved_poi_name_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_religion.png' />\n";
                                echo "<p>Place of worship without religion: <span class='value'>" . $statistics['solved_religion_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "mission_missing_street_name.png' />\n";
                                echo "<p>Street without a name: <span class='value'>" . $statistics['solved_way_wo_tags_count'] . "</span></p>\n";
                                echo "</div>\n";
                                ?>
                            </div>
                        </div>
<h3>Won awards</h3>
                        <div class="row">
                            <div class="span12">
                                <?php
                                $badgesUrl = './resources/images/badges/';
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_3.png' />\n";
                                echo "<p>3. Place: <span class='value'>" . $statistics['highscore_place_3_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_2.png' />\n";
                                echo "<p>2. Place: <span class='value'>" . $statistics['highscore_place_2_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "highscore_place_1.png' />\n";
                                echo "<p>1. Place: <span class='value'>" . $statistics['highscore_place_1_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "total_fix_count_1.png' />\n";
                                echo "<p>1. Mission: <span class='value'>" . $statistics['total_fix_count_1_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "total_fix_count_10.png' />\n";
                                echo "<p>10 Missions: <span class='value'>" . $statistics['total_fix_count_10_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "total_fix_count_50.png' />\n";
                                echo "<p>50 Missions: <span class='value'>" . $statistics['total_fix_count_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "total_fix_count_100.png' />\n";
                                echo "<p>100 Missions: <span class='value'>" . $statistics['total_fix_count_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "six_per_day.png' />\n";
                                echo "<p>6 Missions a Day Keeps the Doctor Away: <span class='value'>" . $statistics['six_per_day_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_language_unknown_5.png' />\n";
                                echo "<p>5 Language Unknown Missions: <span class='value'>" . $statistics['fix_count_language_unknown_5'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_language_unknown_50.png' />\n";
                                echo "<p>50 Language Unknown Missions: <span class='value'>" . $statistics['fix_count_language_unknown_50'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_language_unknown_100.png' />\n";
                                echo "<p>100 Language Unknown Missions: <span class='value'>" . $statistics['fix_count_language_unknown_100'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_cuisine_5.png' />\n";
                                echo "<p>Chef Trainee: <span class='value'>" . $statistics['fix_count_missing_cuisine_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_cuisine_50.png' />\n";
                                echo "<p>Gastronomist: <span class='value'>" . $statistics['fix_count_missing_cuisine_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_cuisine_100.png' />\n";
                                echo "<p>Chef de Cuisine: <span class='value'>" . $statistics['fix_count_missing_cuisine_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_level_5.png' />\n";
                                echo "<p>5 Building Levels Missions: <span class='value'>" . $statistics['fix_count_missing_level_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_level_50.png' />\n";
                                echo "<p>50 Building Levels Missions: <span class='value'>" . $statistics['fix_count_missing_level_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_level_100.png' />\n";
                                echo "<p>100 Building Levels Missions: <span class='value'>" . $statistics['fix_count_missing_level_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_maxspeed_5.png' />\n";
                                echo "<p>5 Maxspeed Missions: <span class='value'>" . $statistics['fix_count_missing_maxspeed_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_maxspeed_50.png' />\n";
                                echo "<p>50 Maxspeed Missions: <span class='value'>" . $statistics['fix_count_missing_maxspeed_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_maxspeed_100.png' />\n";
                                echo "<p>100 Maxspeed Missions: <span class='value'>" . $statistics['fix_count_missing_maxspeed_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_track_type_5.png' />\n";
                                echo "<p>5 Track Type Missions: <span class='value'>" . $statistics['fix_count_missing_track_type_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_track_type_50.png' />\n";
                                echo "<p>50 Track Type Missions: <span class='value'>" . $statistics['fix_count_missing_track_type_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_missing_track_type_100.png' />\n";
                                echo "<p>100 Track Type Missions: <span class='value'>" . $statistics['fix_count_missing_track_type_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_motorway_ref_5.png' />\n";
                                echo "<p>5 Motorway Reference Missions: <span class='value'>" . $statistics['fix_count_motorway_ref_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_motorway_ref_50.png' />\n";
                                echo "<p>50 Motorway Reference Missions: <span class='value'>" . $statistics['fix_count_motorway_ref_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_motorway_ref_100.png' />\n";
                                echo "<p>100 Motorway Reference Missions: <span class='value'>" . $statistics['fix_count_motorway_ref_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_opening_hours_5.png' />\n";
                                echo "<p>5 Opening Hour Missions: <span class='value'>" . $statistics['fix_count_opening_hours_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_opening_hours_50.png' />\n";
                                echo "<p>50 Opening Hour Missions: <span class='value'>" . $statistics['fix_count_opening_hours_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_opening_hours_100.png' />\n";
                                echo "<p>100 Opening Hour Missions: <span class='value'>" . $statistics['fix_count_opening_hours_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_poi_name_5.png' />\n";
                                echo "<p>5 POI Missions: <span class='value'>" . $statistics['fix_count_poi_name_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_poi_name_50.png' />\n";
                                echo "<p>50 POI Missions: <span class='value'>" . $statistics['fix_count_poi_name_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_poi_name_100.png' />\n";
                                echo "<p>100 POI Missions: <span class='value'>" . $statistics['fix_count_poi_name_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_religion_5.png' />\n";
                                echo "<p>5 Religion Missions: <span class='value'>" . $statistics['fix_count_religion_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_religion_50.png' />\n";
                                echo "<p>50 Religion Missions: <span class='value'>" . $statistics['fix_count_religion_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_religion_100.png' />\n";
                                echo "<p>100 Religion Missions: <span class='value'>" . $statistics['fix_count_religion_100_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_way_wo_tags_5.png' />\n";
                                echo "<p>5 Street Name Missions: <span class='value'>" . $statistics['fix_count_way_wo_tags_5_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_way_wo_tags_50.png' />\n";
                                echo "<p>50 Street Name Missions: <span class='value'>" . $statistics['fix_count_way_wo_tags_50_count'] . "</span></p>\n";
                                echo "</div>\n";
                                echo "<div class='kort-badge'>\n";
                                echo "<img src='" . $badgesUrl . "fix_count_way_wo_tags_100.png' />\n";
                                echo "<p>100 Street Name Missions: <span class='value'>" . $statistics['fix_count_way_wo_tags_100_count'] . "</span></p>\n";
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
<p class="pull-left">&copy; <a href="https://creativecommons.org/licenses/by-nc/4.0/" target="blank">CC BY-NC</a> - <a href="http://www.hsr.ch/geometalab" target="blank">Geometa Lab HSR</a> - HSR University of Applied Sciences Rapperswil</p>
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

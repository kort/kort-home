$(document).ready(function(){
    KortPresentation.updateStatistics();
    
    $('#statistics-refresh').click(function() {
        KortPresentation.updateStatistics();
    });
});

Reveal.addEventListener( 'statistics', function() {
    KortPresentation.updateStatistics();
}, false );

// Define KortPresentation namespace
var KortPresentation = {};
KortPresentation.updateStatistics = function() {
    var host = window.location.host,
        statisticsUrl = 'http://play.kort.ch';

    if (host === 'localhost') {
        statisticsUrl = 'http://' + host + '/kort';
    }
    statisticsUrl += '/server/webservices/statistics';

    KortPresentation.setLoadingState();
    var jqXHR = $.ajax(statisticsUrl, {
        dataType: 'jsonp'
    });
    jqXHR.done(function(data, status, jqXHR) {
        // xhr without jsonp
        if(typeof data === "string") {
            data = JSON.parse(data);
        }
        KortPresentation.setValues(data);
    });
    jqXHR.fail(function() {
        // default data
        console.log("Error occured, using local data.");
        var data = {
            "return": [
                {
                    "fix_count":"4528",
                    "falsepositive_fix_count":"284",
                    "complete_fix_count":"85",
                    "validated_fix_count":"74",
                    "user_count":"771",
                    "active_user_count":"328",
                    "osm_user_count":"580",
                    "google_user_count":"191",
                    "vote_count":"1239",
                    "valid_vote_count":"1144",
                    "invalid_vote_count":"95",
                    "badge_count":"602",
                    "first_place_badge_count":"12",
                    "second_place_badge_count":"11",
                    "third_place_badge_count":"14",
                    "hundred_missions_badge_count":"11",
                    "fifty_missions_badge_count":"19",
                    "ten_missions_badge_count":"106",
                    "thousand_checks_badge_count":"0",
                    "hundred_checks_badge_count":"4",
                    "ten_checks_badge_count":"27",
                    "first_mission_badge_count":"320",
                    "first_check_badge_count":"78"
                }
            ]
        };
        KortPresentation.setValues(data);
    });
};
KortPresentation.fields = [
    'fix_count',
    'user_count',
    'osm_user_count',
    'google_user_count',
    'vote_count'
];
KortPresentation.setLoadingState = function() {
    var fieldsCount = KortPresentation.fields.length,
    i;
    
    for(i = 0; i < fieldsCount; i++) {
        $('#' + KortPresentation.fields[i]).html('<img class="loading" src="../resources/images/template/ajax-loader.gif" />');
    }
};
KortPresentation.setValues = function(data) {
    var fieldsCount = KortPresentation.fields.length,
    i;
    
    for(i = 0; i < fieldsCount; i++) {
        $('#' + KortPresentation.fields[i]).html(data['return'][0][KortPresentation.fields[i]]);
    }
};

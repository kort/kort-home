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

    /*if (host === 'localhost') {
        statisticsUrl = 'http://' + host + '/kort';
    }*/
    statisticsUrl += '/server/webservices/statistics';

    KortPresentation.setLoadingState();
    var jqXHR = $.ajax(statisticsUrl, {
        timeout: 2000,
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
            "return":[{
                "fix_count":"39745",
                "falsepositive_fix_count":"2574",
                "complete_fix_count":"1297",
                "incomplete_fix_count":"38448",
                "validated_fix_count":"1245",
                "user_count":"2869",
                "active_user_count":"1807",
                "osm_user_count":"1665",
                "google_user_count":"1078",
                "fb_user_count":"126",
                "vote_count":"11942",
                "valid_vote_count":"11300",
                "invalid_vote_count":"642",
                "badge_count":"3633",
                "first_place_badge_count":"16",
                "second_place_badge_count":"16",
                "third_place_badge_count":"18",
                "hundred_missions_badge_count":"65",
                "fifty_missions_badge_count":"172",
                "ten_missions_badge_count":"682",
                "thousand_checks_badge_count":"1",
                "hundred_checks_badge_count":"15",
                "ten_checks_badge_count":"204",
                "first_mission_badge_count":"1716",
                "first_check_badge_count":"728"
            }]
        };
        KortPresentation.setValues(data);
    });
};
KortPresentation.fields = [
    'fix_count',
    'user_count',
    'osm_user_count',
    'google_user_count',
    'fb_user_count',
    'vote_count'
];
KortPresentation.setLoadingState = function() {
    var fieldsCount = KortPresentation.fields.length,
    i, currentField;
    
    for(i = 0; i < fieldsCount; i++) {
        currentField = $('#' + KortPresentation.fields[i]);
        if(currentField) {
            currentField.html('<img class="loading" src="../resources/images/template/ajax-loader.gif" />');
        }
    }
};
KortPresentation.setValues = function(data) {
    var fieldsCount = KortPresentation.fields.length,
    i, currentField;
    
    
    for(i = 0; i < fieldsCount; i++) {
        currentField = $('#' + KortPresentation.fields[i]);
        if(currentField) {
            currentField.html(data['return'][0][KortPresentation.fields[i]]);
        }
    }
};

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
                "fix_count":"46514",
                "falsepositive_fix_count":"2822",
                "complete_fix_count":"1376",
                "incomplete_fix_count":"45138",
                "validated_fix_count":"1317",
                "user_count":"3225",
                "active_user_count":"2050",
                "osm_user_count":"1869",
                "google_user_count":"1193",
                "fb_user_count":"163",
                "vote_count":"14117",
                "valid_vote_count":"13397",
                "invalid_vote_count":"720",
                "badge_count":"4120",
                "first_place_badge_count":"17",
                "second_place_badge_count":"17",
                "third_place_badge_count":"19",
                "hundred_missions_badge_count":"75",
                "fifty_missions_badge_count":"196",
                "ten_missions_badge_count":"770",
                "thousand_checks_badge_count":"2",
                "hundred_checks_badge_count":"17",
                "ten_checks_badge_count":"229",
                "first_mission_badge_count":"1954",
                "first_check_badge_count":"824"
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

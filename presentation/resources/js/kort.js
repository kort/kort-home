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
                    active_user_count: "1309",
                    badge_count: "2635",
                    complete_fix_count: "832",
                    falsepositive_fix_count: "1858",
                    fb_user_count: "50",
                    fifty_missions_badge_count: "121",
                    first_check_badge_count: "486",
                    first_mission_badge_count: "1254",
                    first_place_badge_count: "16",
                    fix_count: "28290",
                    google_user_count: "876",
                    hundred_checks_badge_count: "12",
                    hundred_missions_badge_count: "51",
                    incomplete_fix_count: "27458",
                    invalid_vote_count: "476",
                    osm_user_count: "1239",
                    second_place_badge_count: "16",
                    ten_checks_badge_count: "141",
                    ten_missions_badge_count: "519",
                    third_place_badge_count: "18",
                    thousand_checks_badge_count: "1",
                    user_count: "2165",
                    valid_vote_count: "8169",
                    validated_fix_count: "796",
                    vote_count: "8645"
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

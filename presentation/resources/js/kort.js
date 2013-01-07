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
    $.ajax(statisticsUrl, {
        dataType: 'jsonp',
        success: function(data, status) {
            // xhr without jsonp
            if(typeof data === "string") {
                data = JSON.parse(data);
            }
            KortPresentation.setValues(data);
        },
        error: function() {
            // default data
            var data = {
                "return": [
                    {
                        "fix_count":"3145",
                        "falsepositive_fix_count":"250",
                        "complete_fix_count":"53",
                        "validated_fix_count":"42",
                        "user_count":"507",
                        "active_user_count":"207",
                        "osm_user_count":"388",
                        "google_user_count":"114",
                        "vote_count":"560",
                        "valid_vote_count":"488",
                        "invalid_vote_count":"72",
                        "badge_count":"398",
                        "first_place_badge_count":"12",
                        "second_place_badge_count":"11",
                        "third_place_badge_count":"13",
                        "hundred_missions_badge_count":"8",
                        "fifty_missions_badge_count":"12",
                        "ten_missions_badge_count":"71",
                        "thousand_checks_badge_count":"0",
                        "hundred_checks_badge_count":"1",
                        "ten_checks_badge_count":"16",
                        "first_mission_badge_count":"205",
                        "first_check_badge_count":"49"
                    }
                ]
            };
            KortPresentation.setValues(data);
        }
    });
};
KortPresentation.fields = [
    'fix_count',
    'user_count',
    'osm_user_count',
    'google_user_count'
];
KortPresentation.setLoadingState = function() {
    var fieldsCount = KortPresentation.fields.length,
    i;
    
    for(i = 0; i < fieldsCount; i++) {
        $('#' + KortPresentation.fields[i]).html('<img class="loading" src="resources/images/template/ajax-loader.gif" />');
    }
};
KortPresentation.setValues = function(data) {
    var fieldsCount = KortPresentation.fields.length,
    i;
    
    for(i = 0; i < fieldsCount; i++) {
        $('#' + KortPresentation.fields[i]).html(data['return'][0][KortPresentation.fields[i]]);
    }
};

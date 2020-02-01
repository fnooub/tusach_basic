var domainurl = "http://localhost";

function ajaxSearch() {
    var input_data = $('#tukhoa').val();
    if (input_data.length === 0) {
        $('#suggestions').hide()
    } else {
        var post_data = {
            'tukhoa': input_data
        };
        $.ajax({
            type: "GET",
            url: domainurl + "/search/ajax",
            data: post_data,
            success: function(data) {
                if (data.length > 0) {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').addClass('list-group');
                    $('#autoSuggestionsList').html(data)
                }
            }
        })
    }
}
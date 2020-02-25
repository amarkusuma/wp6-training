jQuery(document).ready(function($) {
    $('#search').autocomplete({
        source: function(request, response) {
            $.ajax({
                method: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'myautocomplete',
                    data: request.term,
                },
                success: function(data) {
                    console.log(data);

                    response(JSON.parse(data));
                },
                error: function(errorThrown) {
                    console.log(errorThrown);
                },
            });
        },
    });
});
$('#country').on('keyup', function () {
    var query = $(this).val();
    var category = $('#category').val();
    var price = $('#price').val();
    var created_at = $('#created_at').val();
    $.ajax({
        url: "/search",
        type: "GET",
        data: {
            'country': query,
            'category': category,
            'price': price,
            'created_at': created_at,
        },

        success: function (data) {
            $('#results').html("")
            $('#resultsSearch').html(data);
        }
    })
    // end of ajax call
});

$(document).on('click', '#dataSearch', function () {
    var value = $(this).text();
    $('#country').val(value);
    $('#resultsSearch').html("");
});

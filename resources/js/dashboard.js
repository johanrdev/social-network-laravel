import jQuery from 'jquery';

window.$= jQuery;

$('input#check-all').click(function() {
    $('input[type="checkbox"]').not(this).prop('checked', this.checked);
});

$('#remove').on('click', function() {
    var allVals = [];
    var type = $('input[data-type]').data('type');

    $('input[type="checkbox"]:not(#check-all):checked').each(function() {
        allVals.push($(this).data('post-id'));
    });

    if (allVals.length > 0) {
        var joined_values = allVals.join(',');

         $.ajax({
            url: `http://localhost:8000/${type}`,
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content') },
            data: `ids=${joined_values}`,
            success: function(res) {
                $('input[type="checkbox"]:not(#check-all):checked').each(function() {
                    $(this).parents('tr').remove();
                });
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
    }
});
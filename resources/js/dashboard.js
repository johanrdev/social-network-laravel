import jQuery from 'jquery';

window.$= jQuery;

$('input#check-all').click(function() {
    $('input[type="checkbox"]').not(this).prop('checked', this.checked);
});

$('#remove').on('click', function() {
    var $checkboxes = $('table#data-table');
    var $allChecked = $checkboxes.find('input[type="checkbox"]:not(#check-all):checked');

    var $type = $('input[data-type]').data('type');

    var ids = [];

    $allChecked.map(function() {
        return ids.push($(this).data('post-id'));
    });

    console.log('ids:');
    console.log(ids.join(','));
    console.log('-----');

    $.ajax({
        url: `http://localhost:8000/${$type}`,
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content') },
        data: `ids=${ids}`,
        success: function(res) {
            console.log(res);
            // location.reload();
        },
        error: function(res) {
            console.log(res);
        }
    });
});
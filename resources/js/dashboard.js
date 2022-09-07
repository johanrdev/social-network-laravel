window.onload = function() {
    var ids_input = document.getElementById('ids');
    var check_all_checkbox = document.getElementById('check-all');

    if (ids_input) {
        var checkboxes = document.getElementsByClassName('remove-checkbox');
        
        for (let checkbox of checkboxes) {
            checkbox.addEventListener('change', function(e) {
                var id = e.target.getAttribute('data-post-id');

                if (this.checked) {
                    if (ids_input.value.length > 0) {
                        ids_input.value += `,${id}`;
                    } else {
                        ids_input.value += `${id}`;
                    }
                } else {
                    if (ids_input.value.includes(`${id}`)) {
                        var str = ids_input.value;
                        var new_str = str.replaceAll(id, '');
                        ids_input.value = new_str.replace(/(^,)|(,$)/g, '');
                    }
                }
            });
        }
    }

    if (check_all_checkbox) {
        check_all_checkbox.addEventListener('change', function(e) {
            var checkboxes = document.getElementsByClassName('remove-checkbox');

            for (let checkbox of checkboxes) {
                checkbox.checked = !checkbox.checked;
                triggerEvent(checkbox, 'change');
            }
        });
    }

    function triggerEvent(element, type) {
        if ('createEvent' in document) {
            var e = document.createEvent('HTMLEvents');
            e.initEvent(type, false, true);
            element.dispatchEvent(e);
        } else {
            var e = document.createEventObject();
            e.eventType = type;
            element.fireEvent('on' + e.eventType, e);
        }
    }
}
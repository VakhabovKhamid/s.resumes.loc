$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};
$(document).ready(function(){

    $('#address-region-id').change(function () {
        var parent = $(this),
            child = $('#address-district-id');
        ajaxSelect(
            parent,
            child,
            { region_id : parent.val() },
            '/applicants/get-districts-list'
        );
    });
    $(function() {
        var parent = $('#address-region-id'),
            child = $('#address-district-id');
        ajaxSelect(
            parent,
            child,
            { region_id : parent.val() },
            '/applicants/get-districts-list'
        );
    });

    function ajaxSelect(parent, child, data, url) {
        clearSelect(child);
        if (data) {
            $.ajax({
                url: url,
                beforeSend: function(xhr) {
                    var csrf = $('input[name="_csrfToken"]').val();
                    xhr.setRequestHeader('X-CSRF-Token', csrf);
                },
                data: data,
                dataType: 'json',
                type: "get",
                success: function(data) {
                    if (Object.keys(data.districts).length) {
                        updateOptions(child, data.districts);
                    }
                },
                error: function (request, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function clearSelect(select) {
        select.attr('disabled','disabled');
        select.find('option').each(function() {
            if ($(this).attr('value') != '') {
                $(this).remove();
            }
        });
    }

    function generateOptions(list) {
        if (list) {
            var options = "";
            $.each(list, function (key, value) {
                options += "<option value='"+key+"'>"+value+"</option>";
            });
            return options;
        }
    }

    function updateOptions(select, data) {
        var options = generateOptions(data);
        select.append(options);
        select.removeAttr('disabled');
    }

});
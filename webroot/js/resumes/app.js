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
            '/dictionary-districts/ajax-region-districts'
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

    function deleteClone(btn) {
        btn.click(function(e) {
            e.preventDefault();
            $(this).parents('.FiledClone').remove();
            i--;
        })
    }

    deleteClone($('.btnAddRemove'));

});
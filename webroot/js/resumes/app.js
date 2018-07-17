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


    $('.field.disabled input').focus(function() {
        $(this).blur();
    });


    $('.jq-date-field').inputmask("00-00-0000");

    $(function() {
        var i = $('.FiledMain').attr('data-leng');
        $('.btnAddField').click(function(e) {
            e.preventDefault();
            console.log(checkValueClones());
            if (i != 3 && checkValueClones()) {
                var clone = $(this).parents('.wrapCloneFields').find('.FiledMain').clone();
                clone.removeClass('FiledMain');
                clone.addClass('FiledClone');
                deleteClone(clone.find('.btnAddRemove'));
                clearValues(clone);
                $(this).before(clone);
                clone.find('input').focus();
                i++;
            }
        });

        function checkValueClones() {
            var error = false;
            $('.FiledClone, .FiledMain').each(function(){
                var input = $(this).find('input');
                if (input.val() == '') {
                    input.addClass('error');
                    error = true;
                }else{
                    input.removeClass('error');
                }
            });
            if (!error) {
                return true;
            }
            return false;
        }

        function deleteClone(btn) {
            btn.click(function(e) {
                e.preventDefault();
                $(this).parents('.FiledClone').remove();
                console.log(i);
                i--;
            })
        }

        deleteClone($('.btnAddRemove'));

        function clearValues(clone) {
            clone.find('input').each(function() {
                $(this).val('');
            });
        }
        
    });

    $('#desirable-countries-ids').change(function(){
        countriesSelects($(this));
    });
    countriesSelects($('#desirable-countries-ids'));
    function countriesSelects(firstList) {
        var val = firstList.val();
        $('#undesirable-countries-ids').find('option').each(function(){
            if (val && val.indexOf($(this).attr('value')) != '-1') {
                $(this).attr('disabled', true);
            }else{
                $(this).removeAttr('disabled');
            }
        });
        $('#undesirable-countries-ids').multipleSelect('refresh'); 
    }


    $('#importDataEmployee').click(function(e){
        e.preventDefault();
        if ($('#document-seria-number').val().length < 1) {
            $('#document-seria-number').addClass('error');
        }else{

            var form = $(this).parents('form');
            form.addClass('loader');

            var document_seria_number = $('#document-seria-number').val();
            document_seria_number = document_seria_number.toUpperCase();

            $.ajax({
                url: '/id-gov-uz/retrieve-personal-data-soliq-uz',
                beforeSend: function(xhr) {
                    var csrf = $('input[name="_csrfToken"]').val();
                    xhr.setRequestHeader('X-CSRF-Token', csrf);
                },
                data: {
                    document_seria_number: document_seria_number
                },
                dataType: 'json',
                type: "post",
                success: function(data) {
                    if (data) {
                        $('#document-seria-number').removeClass('error');
                        if (data.person.sname!=''){
                            $('#latin-surname').val(data.person.sname);
                        }else{
                            clearInputDisabled($('#latin-surname'));
                        }
                        if (data.person.fname!=''){
                            $('#latin-name').val(data.person.fname);
                        }else{
                            clearInputDisabled($('#latin-name'));
                        }
                        if (data.person.date_birth!=''){
                            $('#birth-date').val(data.person.date_birth);
                        }else{
                            clearInputDisabled($('#birth-date'));
                        }
                        if (data.person.gender!=''){
                            $('#sex').val(data.person.gender);
                        }else{
                            clearInputDisabled($('#sex'));
                        }
                        form.removeClass('loader');
                    }else{
                       $('#serverErrorSoliq').show();
                        clearInputsDisabled();
                        form.removeClass('loader');
                    }
                },
                error: function (request, status, error) {
                    $('#serverErrorSoliq').show();
                    clearInputsDisabled();
                    form.removeClass('loader');
                    console.log(error);
                }
            });

        }

    });

    function clearInputsDisabled() {
        $('.field.disabled').each(function() {
            var input = $(this).find('input');
            $(this).removeClass('disabled');
            input.unbind('focus');
            var disabledInput = $(this).find('input[disabled=disabled]');
            disabledInput.val(disabledInput.attr('alt-text'));
        });
    }

    function clearInputDisabled(input) {
        var field = input.parents('.field');
        field.removeClass('disabled');
        input.removeAttr('disabled');
        input.unbind('focus');
        var disabledInput = $(this).find('input[disabled=disabled]');
        disabledInput.val(disabledInput.attr('alt-text'));
    }

});
(function($) {
    $.fn.tabs = function( body ){
        var boddy = $(body);
        var navs = $(this).find('a');
        navs.click(function(e){
            e.preventDefault();
            var id = $(this).attr('href');
            $(this).parent().addClass('active').parent().find('li').not($(this).parent()).removeClass('active');
            boddy.each(function(){
                $(this).hide();
            });
            $(body+id).fadeIn(250);

        });
    }
})(jQuery);


$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};

function showModal(modal) {
        modal.fadeIn();
        $('body').addClass('openModal');
    }
function hideModal(modal) {
    modal.fadeOut();
    $('body').removeClass('openModal');
}
$(document).ready(function(){
    
    $('.questionsList h4').click(function(e){
        $(this).toggleClass('active').parent().find('h4').not($(this)).removeClass('active');
        $(this).nextUntil('h4').slideToggle().parent().find('p').not($(this).nextUntil('h4')).slideUp();
    });

    $('.showTrInfo').click(function(e) {
        e.preventDefault();

        if($(this).parents('tr').hasClass('opened')){
            $(this).parents('tr').removeClass('opened');
            $(this).parents('tr').next('tr.details').hide();
        }else{
            
            $(this).parents('table').find('tr.details').hide();
            $(this).parents('table').find('tr').removeClass('opened');

            $(this).parents('tr').addClass('opened');
            $(this).parents('tr').next('tr.details').show();
        }


    });

    $('.modalWindowMask, .modalWindowClose').click(function(){
        hideModal($(this).parents('.modalWindow'));
    });

    $(function(){
    $('.hoverEffect').prepend('<span class="activeBg"></span>');

    $('.hoverEffect li').hover(function(){
        var _ = $(this);
        var left = _.position().left;
        var top = _.position().top;
        var width = _.width();
        var height = _.height();
        var bg = $(this).parents('.hoverEffect').find('.activeBg');
        bg.removeClass('fade-out');
        bg.addClass('fade-in').css({left:left,top:top, width: width, height: height});
    },function(){
        var bg = $(this).parents('.hoverEffect').find('.activeBg');
        bg.removeClass('fade-in');
        bg.addClass('fade-out');
    });

  });


    $('#searchFIO').on('input' , function(){
        var val = $(this).val();
        var val2 = val.toLowerCase();
        var list = $(this).parents('tbody').find('.fieldFIO');
        list.each(function(){
            var t_text = $(this).text();
            var t_text2 = t_text.toLowerCase();
            if(~t_text2.indexOf(val2)) {
                $(this).parents('tr').show();
            }else{
                $(this).parents('tr').hide();
            }
        });
    });

    $('#searchPosition').on('input' , function(){
        var val = $(this).val();
        var val2 = val.toLowerCase();
        var list = $(this).parents('tbody').find('.fieldPosition');
        list.each(function(){
            var t_text = $(this).text();
            var t_text2 = t_text.toLowerCase();
            if(~t_text2.indexOf(val2)) {
                $(this).parents('tr').show();
            }else{
                $(this).parents('tr').hide();
            }
        });
    });

    $('.filterField').on('input' , function(){
        var valueF = $(this).attr('data-value');
        var val = $(this).val();
        var val2 = val.toLowerCase();
        var list = $(valueF);
        list.each(function(){
            // if ($(this).parents('tr').css('display') != 'none') {
                var t_text = $(this).text();
                var t_text2 = t_text.toLowerCase();
                if(~t_text2.indexOf(val2)) {
                    $(this).parents('tr').show();
                }else{
                    $(this).parents('tr').hide();
                }
            // }
        });
    });

    $('a, button').click(function(e){
        if ($(this).hasAttr('data-modal')) {
            e.preventDefault();
            var modal = $(this).attr('data-modal');
            if ($(modal).length > 0) {
                showModal($(modal));
            }else{
                console.log('Объект не найден!')
            }
        }
    }); 

    if ($('#fixedBlock').length > 0) {
        var elemTop = $('#fixedBlock').offset().top;
        $(window).resize(function(){
            var elemWidth = $('#fixedBlockParent').width();
            $('#fixedBlock').css({width: elemWidth});
        });
        $(window).scroll(function(){
            var elemWidth = $('#fixedBlockParent').width();
            var _ = $(this);
            $('#fixedBlock').css({width: elemWidth});
            if(_.width() > 940){
                var _top = _.scrollTop();
                if (_top >= elemTop) {
                    $('#fixedBlock').addClass('fixedBlock');                
                    var pTop = $('#fixedBlockParentRow').offset().top + $('#fixedBlockParentRow').height();
                    var newTop = pTop-$('#fixedBlock').height();
                    if (_top >= newTop) {
                        $('#fixedBlock').removeClass('fixedBlock');             
                        $('#fixedBlock').addClass('absolutedBlock');                
                    }else{
                        $('#fixedBlock').addClass('fixedBlock');                
                        $('#fixedBlock').removeClass('absolutedBlock');
                    }
                }else{
                    $('#fixedBlock').removeClass('fixedBlock');             
                }
            }else{
                $('#fixedBlock').removeClass('fixedBlock');             
                $('#fixedBlock').removeClass('absolutedBlock');
            }
        });
    }

    $(function(){
        var data = {
            "name" : 'ООО "Smart Technologies Group"',
            "address":"Ташкент, Мирзо-Улугбекский район, улица Паркентская, дом 13а, квартира 235",
            "register_data": "01.11.2016",
            "company_type": "Общество с ограниченой ответственностью",
            "oked": "12762",
            "okpo": "54872365",
            "coato": "5486193872",
            "opf": "5499",
            "fc": "556",
            "inn": "984151348",
            "fio": "Махкамов Б.А",
        };

        $('#importDataCompany').click(function(){

            if ($('#fieldInn').val().length < 1) {
                $('#fieldInn').addClass('error');
            }else{
                $('#fieldInn').removeClass('error');
                $('#name').val(data.name);
                $('#address').val(data.address);
                $('#register_data').val(data.register_data);
                $('#company_type').val(data.company_type);
                $('#oked').val(data.oked);
                $('#okpo').val(data.okpo);
                $('#coato').val(data.coato);
                $('#opf').val(data.opf);
                $('#fc').val(data.fc);
                $('#fio').val(data.fio);
            }

        });

    });

    // $(function(){
    //     var data = {
    //         "number_p" : 'AA 8976941',
    //         "name":"Рустам",
    //         "last_name": "Турдалиев",
    //         "middle_name": "Ахмадович",
    //         "inn": "548613564",
    //         "b_date": "30.12.1993",
    //         "sex": "мужской",
    //         "b_address": "Ташкент, Мирзо-Улугбекский район",
    //         "p_address": "Ташкент, Мирзо-Улугбекский район, улица Паркентская, дом 23а, квартира 153",
    //         "l_address": "Ташкент, Мирзо-Улугбекский район, улица Паркентская, дом 23а, квартира 153",
    //     };

    //     $('#importDataEmployee').click(function(){

    //         if ($('#pinfl').val().length < 1) {
    //             $('#pinfl').addClass('error');
    //         }else{
    //             $('#pinfl').removeClass('error');
    //             $('#number_p').val(data.number_p);
    //             $('#name').val(data.name);
    //             $('#last_name').val(data.last_name);
    //             $('#middle_name').val(data.middle_name);
    //             $('#inn').val(data.inn);
    //             $('#b_address').val(data.b_address);
    //             $('#b_date').val(data.b_date);
    //             $('#p_address').val(data.p_address);
    //             $('#l_address').val(data.l_address);
    //             $('#sex').val(data.sex);
    //         }

    //     });

    // });

    $('.checkboxToggle label input').change(function(){

        if ($(this).is(':checked')) {
            $(this).parents('.checkboxToggle').addClass('checked');
        }else{
            $(this).parents('.checkboxToggle').removeClass('checked');
        }

    });

    $(".phone").inputmask("+998 (00) 000 00 00");
    $('.pinfl').inputmask("0 000000 000 000 0");
    $('.cartNumber').inputmask("0000 0000 0000 0000");
    $('.series_doc').inputmask({ 
        mask: "AA0000000",
        definitions: {
          A: {
            validator: "[A-Za-z]",
            casing: "upper"
          }
        }
    });

    $(function(){
        if($('#selectCountries').length){
            $.each(countries, function(k, v){
                $('#selectCountries').append("<option>"+v.geoAreaName+"</option>");
            });
        }
    })

    $('.btnPersonalArea a.PersonalAreaLink').click(function(e){
        e.preventDefault();
        $('.subMenuPersonalArea').slideToggle(200);
    })

    $(function(){
        $('.timer').each(function(){
            var _ = $(this);
            var min = Number(_.find('.minute').text());
            var sec = Number(_.find('.secound').text());
            var interval;
            interval = setInterval(function(){
                if (sec == 0) {
                    sec = 60;
                    if (min == 0) {
                        clearInterval(interval);
                        return false;
                    }
                    min--; 
                }
                sec--;
                secText = (sec<10)?"0"+sec:sec;
                minText = (min<10)?"0"+min:min;
                _.find('.minute').text(minText);
                _.find('.secound').text(secText);
            },1000);
        });
    });
    if ($('.fancybox').length > 0) {
          $('.fancybox').fancybox({
            loop: true,
                buttons : [
                'close'
                ],
            });
      };


    $('.jq-multiple-select').multipleSelect({
        // selectAll: false,
        selectAllDelimiter: ['[', ']'],
        placeholder: 'Выберите',
        width: '100%',
        selectAllText: 'Выбрать все',
        allSelected: 'Все выбрано',
        countSelected: 'Выбрано # из %',
        noMatchesFound: 'Не найдено',
        // styler: changeInputs
    });


    $(function() {
        var i = $('.FiledMain').attr('data-leng');
        $('.btnAddField').click(function(e) {
            e.preventDefault();
            if (i != 5) {
                var clone = $(this).parents('.FiledMain').clone();
                clone.removeClass('FiledMain');
                clone.addClass('FiledClone');
                deleteClone(clone.find('.btnAddRemove'));
                clearValues(clone);
                $(this).parents('.FiledMain').after(clone);
                i++;
            }
        });

        function deleteClone(btn) {
            btn.click(function(e) {
                e.preventDefault();
                $(this).parents('.FiledClone').remove();
                i--;
            })
        }

        function clearValues(clone) {
            clone.find('input').each(function() {
                $(this).val('');
            });
        }
    });

    $('#registration-form').submit(function(e) {
        if (!$('#checkPublicOffer').prop('checked')) {
            e.preventDefault();
            $('.checkboxCf').addClass('error');
        }else{
            $('.checkboxCf').removeClass('error');
        }
    })



});


var countries = [{
    "geoAreaName": "Afghanistan"
}, {
    "geoAreaName": "Åland Islands"
}, {
    "geoAreaName": "Albania"
}, {
    "geoAreaName": "Algeria"
}, {
    "geoAreaName": "American Samoa"
}, {
    "geoAreaName": "Andorra"
}, {
    "geoAreaName": "Angola"
}, {
    "geoAreaName": "Anguilla"
}, {
    "geoAreaName": "Antarctica"
}, {
    "geoAreaName": "Antigua and Barbuda"
}, {
    "geoAreaName": "Argentina"
}, {
    "geoAreaName": "Armenia"
}, {
    "geoAreaName": "Aruba"
}, {
    "geoAreaName": "Australia"
}, {
    "geoAreaName": "Austria"
}, {
    "geoAreaName": "Azerbaijan"
}, {
    "geoAreaName": "Bahamas"
}, {
    "geoAreaName": "Bahrain"
}, {
    "geoAreaName": "Bangladesh"
}, {
    "geoAreaName": "Barbados"
}, {
    "geoAreaName": "Belarus"
}, {
    "geoAreaName": "Belgium"
}, {
    "geoAreaName": "Belize"
}, {
    "geoAreaName": "Benin"
}, {
    "geoAreaName": "Bermuda"
}, {
    "geoAreaName": "Bhutan"
}, {
    "geoAreaName": "Bolivia (Plurinational State of)"
}, {
    "geoAreaName": "Bosnia and Herzegovina"
}, {
    "geoAreaName": "Botswana"
}, {
    "geoAreaName": "Bouvet Island"
}, {
    "geoAreaName": "Brazil"
}, {
    "geoAreaName": "British Virgin Islands"
}, {
    "geoAreaName": "British Indian Ocean Territory"
}, {
    "geoAreaName": "Brunei Darussalam"
}, {
    "geoAreaName": "Bulgaria"
}, {
    "geoAreaName": "Burkina Faso"
}, {
    "geoAreaName": "Burundi"
}, {
    "geoAreaName": "Cambodia"
}, {
    "geoAreaName": "Cameroon"
}, {
    "geoAreaName": "Canada"
}, {
    "geoAreaName": "Cabo Verde"
}, {
    "geoAreaName": "Cayman Islands"
}, {
    "geoAreaName": "Central African Republic"
}, {
    "geoAreaName": "Chad"
}, {
    "geoAreaName": "Chile"
}, {
    "geoAreaName": "China"
}, {
    "geoAreaName": "China, Hong Kong Special Administrative Region"
}, {
    "geoAreaName": "China, Macao Special Administrative Region"
}, {
    "geoAreaName": "Christmas Island"
}, {
    "geoAreaName": "Cocos (Keeling) Islands"
}, {
    "geoAreaName": "Colombia"
}, {
    "geoAreaName": "Comoros"
}, {
    "geoAreaName": "Congo"
}, {
    "geoAreaName": "Democratic Republic of the Congo"
}, {
    "geoAreaName": "Cook Islands"
}, {
    "geoAreaName": "Costa Rica"
}, {
    "geoAreaName": "Côte d'Ivoire"
}, {
    "geoAreaName": "Croatia"
}, {
    "geoAreaName": "Cuba"
}, {
    "geoAreaName": "Cyprus"
}, {
    "geoAreaName": "Czechia"
}, {
    "geoAreaName": "Denmark"
}, {
    "geoAreaName": "Djibouti"
}, {
    "geoAreaName": "Dominica"
}, {
    "geoAreaName": "Dominican Republic"
}, {
    "geoAreaName": "Ecuador"
}, {
    "geoAreaName": "Egypt"
}, {
    "geoAreaName": "El Salvador"
}, {
    "geoAreaName": "Equatorial Guinea"
}, {
    "geoAreaName": "Eritrea"
}, {
    "geoAreaName": "Estonia"
}, {
    "geoAreaName": "Ethiopia"
}, {
    "geoAreaName": "Falkland Islands (Malvinas)"
}, {
    "geoAreaName": "Faroe Islands"
}, {
    "geoAreaName": "Fiji"
}, {
    "geoAreaName": "Finland"
}, {
    "geoAreaName": "France"
}, {
    "geoAreaName": "French Guiana"
}, {
    "geoAreaName": "French Polynesia"
}, {
    "geoAreaName": "French Southern Territories"
}, {
    "geoAreaName": "Gabon"
}, {
    "geoAreaName": "Gambia"
}, {
    "geoAreaName": "Georgia"
}, {
    "geoAreaName": "Germany"
}, {
    "geoAreaName": "Ghana"
}, {
    "geoAreaName": "Gibraltar"
}, {
    "geoAreaName": "Greece"
}, {
    "geoAreaName": "Greenland"
}, {
    "geoAreaName": "Grenada"
}, {
    "geoAreaName": "Guadeloupe"
}, {
    "geoAreaName": "Guam"
}, {
    "geoAreaName": "Guatemala"
}, {
    "geoAreaName": "Guernsey"
}, {
    "geoAreaName": "Guinea"
}, {
    "geoAreaName": "Guinea-Bissau"
}, {
    "geoAreaName": "Guyana"
}, {
    "geoAreaName": "Haiti"
}, {
    "geoAreaName": "Heard Island and McDonald Islands"
}, {
    "geoAreaName": "Holy See"
}, {
    "geoAreaName": "Honduras"
}, {
    "geoAreaName": "Hungary"
}, {
    "geoAreaName": "Iceland"
}, {
    "geoAreaName": "India"
}, {
    "geoAreaName": "Indonesia"
}, {
    "geoAreaName": "Iran (Islamic Republic of)"
}, {
    "geoAreaName": "Iraq"
}, {
    "geoAreaName": "Ireland"
}, {
    "geoAreaName": "Isle of Man"
}, {
    "geoAreaName": "Israel"
}, {
    "geoAreaName": "Italy"
}, {
    "geoAreaName": "Jamaica"
}, {
    "geoAreaName": "Japan"
}, {
    "geoAreaName": "Jersey"
}, {
    "geoAreaName": "Jordan"
}, {
    "geoAreaName": "Kazakhstan"
}, {
    "geoAreaName": "Kenya"
}, {
    "geoAreaName": "Kiribati"
}, {
    "geoAreaName": "Democratic People's Republic of Korea"
}, {
    "geoAreaName": "Republic of Korea"
}, {
    "geoAreaName": "Kuwait"
}, {
    "geoAreaName": "Kyrgyzstan"
}, {
    "geoAreaName": "Lao People's Democratic Republic"
}, {
    "geoAreaName": "Latvia"
}, {
    "geoAreaName": "Lebanon"
}, {
    "geoAreaName": "Lesotho"
}, {
    "geoAreaName": "Liberia"
}, {
    "geoAreaName": "Libya"
}, {
    "geoAreaName": "Liechtenstein"
}, {
    "geoAreaName": "Lithuania"
}, {
    "geoAreaName": "Luxembourg"
}, {
    "geoAreaName": "The former Yugoslav Republic of Macedonia"
}, {
    "geoAreaName": "Madagascar"
}, {
    "geoAreaName": "Malawi"
}, {
    "geoAreaName": "Malaysia"
}, {
    "geoAreaName": "Maldives"
}, {
    "geoAreaName": "Mali"
}, {
    "geoAreaName": "Malta"
}, {
    "geoAreaName": "Marshall Islands"
}, {
    "geoAreaName": "Martinique"
}, {
    "geoAreaName": "Mauritania"
}, {
    "geoAreaName": "Mauritius"
}, {
    "geoAreaName": "Mayotte"
}, {
    "geoAreaName": "Mexico"
}, {
    "geoAreaName": "Micronesia (Federated States of)"
}, {
    "geoAreaName": "Republic of Moldova"
}, {
    "geoAreaName": "Monaco"
}, {
    "geoAreaName": "Mongolia"
}, {
    "geoAreaName": "Montenegro"
}, {
    "geoAreaName": "Montserrat"
}, {
    "geoAreaName": "Morocco"
}, {
    "geoAreaName": "Mozambique"
}, {
    "geoAreaName": "Myanmar"
}, {
    "geoAreaName": "Namibia"
}, {
    "geoAreaName": "Nauru"
}, {
    "geoAreaName": "Nepal"
}, {
    "geoAreaName": "Netherlands"
}, {
    "geoAreaName": "Netherlands Antilles"
}, {
    "geoAreaName": "New Caledonia"
}, {
    "geoAreaName": "New Zealand"
}, {
    "geoAreaName": "Nicaragua"
}, {
    "geoAreaName": "Niger"
}, {
    "geoAreaName": "Nigeria"
}, {
    "geoAreaName": "Niue"
}, {
    "geoAreaName": "Norfolk Island"
}, {
    "geoAreaName": "Northern Mariana Islands"
}, {
    "geoAreaName": "Norway"
}, {
    "geoAreaName": "Oman"
}, {
    "geoAreaName": "Pakistan"
}, {
    "geoAreaName": "Palau"
}, {
    "geoAreaName": "State of Palestine"
}, {
    "geoAreaName": "Panama"
}, {
    "geoAreaName": "Papua New Guinea"
}, {
    "geoAreaName": "Paraguay"
}, {
    "geoAreaName": "Peru"
}, {
    "geoAreaName": "Philippines"
}, {
    "geoAreaName": "Pitcairn"
}, {
    "geoAreaName": "Poland"
}, {
    "geoAreaName": "Portugal"
}, {
    "geoAreaName": "Puerto Rico"
}, {
    "geoAreaName": "Qatar"
}, {
    "geoAreaName": "Réunion"
}, {
    "geoAreaName": "Romania"
}, {
    "geoAreaName": "Russian Federation"
}, {
    "geoAreaName": "Rwanda"
}, {
    "geoAreaName": "Saint Helena"
}, {
    "geoAreaName": "Saint Kitts and Nevis"
}, {
    "geoAreaName": "Saint Lucia"
}, {
    "geoAreaName": "Saint Pierre and Miquelon"
}, {
    "geoAreaName": "Samoa"
}, {
    "geoAreaName": "San Marino"
}, {
    "geoAreaName": "Sao Tome and Principe"
}, {
    "geoAreaName": "Saudi Arabia"
}, {
    "geoAreaName": "Senegal"
}, {
    "geoAreaName": "Serbia"
}, {
    "geoAreaName": "Seychelles"
}, {
    "geoAreaName": "Sierra Leone"
}, {
    "geoAreaName": "Singapore"
}, {
    "geoAreaName": "Slovakia"
}, {
    "geoAreaName": "Slovenia"
}, {
    "geoAreaName": "Solomon Islands"
}, {
    "geoAreaName": "Somalia"
}, {
    "geoAreaName": "South Africa"
}, {
    "geoAreaName": "South Georgia and the South Sandwich Islands"
}, {
    "geoAreaName": "South Sudan"
}, {
    "geoAreaName": "Spain"
}, {
    "geoAreaName": "Sri Lanka"
}, {
    "geoAreaName": "Sudan"
}, {
    "geoAreaName": "Suriname"
}, {
    "geoAreaName": "Svalbard and Jan Mayen Islands"
}, {
    "geoAreaName": "Eswatini"
}, {
    "geoAreaName": "Sweden"
}, {
    "geoAreaName": "Switzerland"
}, {
    "geoAreaName": "Syrian Arab Republic"
}, {
    "geoAreaName": "Taiwan, Republic of China"
}, {
    "geoAreaName": "Tajikistan"
}, {
    "geoAreaName": "United Republic of Tanzania"
}, {
    "geoAreaName": "Thailand"
}, {
    "geoAreaName": "Timor-Leste"
}, {
    "geoAreaName": "Togo"
}, {
    "geoAreaName": "Tokelau"
}, {
    "geoAreaName": "Tonga"
}, {
    "geoAreaName": "Trinidad and Tobago"
}, {
    "geoAreaName": "Tunisia"
}, {
    "geoAreaName": "Turkey"
}, {
    "geoAreaName": "Turkmenistan"
}, {
    "geoAreaName": "Turks and Caicos Islands"
}, {
    "geoAreaName": "Tuvalu"
}, {
    "geoAreaName": "Uganda"
}, {
    "geoAreaName": "Ukraine"
}, {
    "geoAreaName": "United Arab Emirates"
}, {
    "geoAreaName": "United Kingdom of Great Britain and Northern Ireland"
}, {
    "geoAreaName": "United States of America"
}, {
    "geoAreaName": "United States Minor Outlying Islands"
}, {
    "geoAreaName": "Uruguay"
}, {
    "geoAreaName": "Uzbekistan"
}, {
    "geoAreaName": "Vanuatu"
}, {
    "geoAreaName": "Venezuela (Bolivarian Republic of)"
}, {
    "geoAreaName": "Viet Nam"
}, {
    "geoAreaName": "Wallis and Futuna Islands"
}, {
    "geoAreaName": "Western Sahara"
}, {
    "geoAreaName": "Yemen"
}, {
    "geoAreaName": "Zambia"
}, {
    "geoAreaName": "Zimbabwe"
}, {
    "geoAreaName": "Eastern Africa"
}, {
    "geoAreaName": "Middle Africa"
}, {
    "geoAreaName": "Southern Africa"
}, {
    "geoAreaName": "Western Africa"
}, {
    "geoAreaName": "Caribbean"
}, {
    "geoAreaName": "Central America"
}, {
    "geoAreaName": "South America"
}, {
    "geoAreaName": "Northern Africa"
}, {
    "geoAreaName": "Sub-Saharan Africa"
}, {
    "geoAreaName": "Latin America and the Caribbean"
}, {
    "geoAreaName": "Northern America"
}, {
    "geoAreaName": "Africa"
}, {
    "geoAreaName": "Americas"
}, {
    "geoAreaName": "World"
}, {
    "geoAreaName": "Central Asia"
}, {
    "geoAreaName": "Eastern Asia"
}, {
    "geoAreaName": "South-Eastern Asia"
}, {
    "geoAreaName": "Southern Asia"
}, {
    "geoAreaName": "Western Asia"
}, {
    "geoAreaName": "Eastern Europe"
}, {
    "geoAreaName": "Northern Europe"
}, {
    "geoAreaName": "Southern Europe"
}, {
    "geoAreaName": "Western Europe"
}, {
    "geoAreaName": "Australia and New Zealand"
}, {
    "geoAreaName": "Melanesia"
}, {
    "geoAreaName": "Micronesia"
}, {
    "geoAreaName": "Polynesia"
}, {
    "geoAreaName": "Europe"
}, {
    "geoAreaName": "Asia"
}, {
    "geoAreaName": "Oceania"
}, {
    "geoAreaName": "Channel Islands"
}, {
    "geoAreaName": "Bonaire, Sint Eustatius and Saba"
}, {
    "geoAreaName": "Curaçao"
}, {
    "geoAreaName": "Saint Barthélemy"
}, {
    "geoAreaName": "Saint Martin (French Part)"
}, {
    "geoAreaName": "Saint Vincent and the Grenadines"
}, {
    "geoAreaName": "Sint Maarten (Dutch part)\t"
}, {
    "geoAreaName": "United States Virgin Islands"
}, {
    "geoAreaName": "Sark"
}, {
    "geoAreaName": "Least Developed Countries (LDCs)"
}, {
    "geoAreaName": "Small island developing States (SIDS)"
}, {
    "geoAreaName": "Landlocked developing countries (LLDCs)"
}, {
    "geoAreaName": "Developed regions (Europe, Cyprus, Israel, Northern America, Japan, Australia & New Zealand)"
}, {
    "geoAreaName": "Developing regions"
}, {
    "geoAreaName": "Kosovo"
}, {
    "geoAreaName": "Central and Southern Asia"
}, {
    "geoAreaName": "Southern Asia (excluding India)"
}, {
    "geoAreaName": "Caucasus and Central Asia"
}, {
    "geoAreaName": "Organisation for Economic Co-operation and Development (OECD) Member States"
}, {
    "geoAreaName": "Eastern Asia (excluding Japan and China)"
}, {
    "geoAreaName": "Latin America"
}, {
    "geoAreaName": "Western Asia (exc. Armenia, Azerbaijan, Cyprus, Israel and Georgia)"
}, {
    "geoAreaName": "Europe and Northern America"
}, {
    "geoAreaName": "Eastern Asia (excluding Japan)"
}, {
    "geoAreaName": "Oceania (exc. Australia and New Zealand)"
}, {
    "geoAreaName": "Development Assistance Committee members (DAC)"
}, {
    "geoAreaName": "Sub-Saharan Africa (inc. Sudan)"
}, {
    "geoAreaName": "Northern Africa (exc. Sudan)"
}, {
    "geoAreaName": "Northern Africa and Western Asia"
}, {
    "geoAreaName": "Eastern and South-Eastern Asia"
}, {
    "geoAreaName": "World Trade Organization (WTO) Member States"
}, {
    "geoAreaName": "Serbia and Montenegro [former]"
}, {
    "geoAreaName": "Africa (ILO)"
}, {
    "geoAreaName": "Asia and the Pacific (ILO)"
}, {
    "geoAreaName": "Central and Eastern Europe (ILO)"
}, {
    "geoAreaName": "Middle East and North Africa (ILO)"
}, {
    "geoAreaName": "Middle East (ILO)"
}, {
    "geoAreaName": "North America (ILO)"
}, {
    "geoAreaName": "Other regions (ILO)"
}, {
    "geoAreaName": "Western Europe (ILO)"
}, {
    "geoAreaName": "High income economies (WB)"
}, {
    "geoAreaName": "Low income economies (WB)"
}, {
    "geoAreaName": "Lower middle economies (WB)"
}, {
    "geoAreaName": "Low and middle income economies (WB)"
}, {
    "geoAreaName": "Upper middle economies (WB)"
}, {
    "geoAreaName": "WTO Developing Member States"
}, {
    "geoAreaName": "WTO Developed Member States"
}, {
    "geoAreaName": "International Centers (FAO)"
}, {
    "geoAreaName": "Sudan [former]"
}, {
    "geoAreaName": "European Union (EU) Institutions"
}, {
    "geoAreaName": "European Union"
}, {
    "geoAreaName": "Regional Centres (FAO)"
}, {
    "geoAreaName": "Azores Islands"
}, {
    "geoAreaName": "ODA residual"
}, {
    "geoAreaName": "Custom groupings of data providers"
}];
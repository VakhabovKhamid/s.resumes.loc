$(document).ready(function(){

    $('.btn-search').click(function (e) {
        e.preventDefault();
        $('tr.row-search').slideToggle(200);
    });

    $('.btn-filter-clear').click(function(e) {
        e.preventDefault();
        $(this).parents('tr.row-search').find('input').val('');
    })

    $('div.group-control').on('click', 'button.btn-refresh', function() {
        location.reload();
    });
    
    $(function(){
        var thead = $('.jq-fixed-thead thead');
        if (thead.length) {
            var thead_top = thead.offset().top - $('.navbar-fixed-top').height();
            var cloneTable = $('.jq-fixed-thead').clone();
            cloneTable.addClass('cloneTable');
            cloneTable.hide();
            $('body').append(cloneTable);
            $(window).scroll(function(){
                var thead_width = thead.width();
                var _top = $(this).scrollTop();
                var thead_left = thead.offset().left;
                if (_top >= thead_top) {
                    cloneTable.find('th').each(function(){
                        var index = $(this).index();
                        var width = thead.find('th').eq(index).outerWidth();
                        $(this).css('cssText', 'width:'+width+'px!important;');
                    })
                    cloneTable.show();
                    cloneTable.css({
                        'position': 'fixed',
                        'width': thead_width+'px',
                        'top': $('.navbar-fixed-top').height()+'px',
                        'left': thead_left+'px'
                    });
                }else{
                    cloneTable.hide();
                }
            });
        }
    });
    
    $('.toggleAccardion').click(function(e){
        e.preventDefault();
        var child = $(this).attr('href');
        if ($(this).hasClass('opened')) {
            $(this).removeClass('opened');
            $(child).removeClass('in');
            closeCollapse($(child));
        }else{
            $(this).addClass('opened');
            $(child).addClass('in');
        }

    });


    function closeCollapse(child){
        child.find('.toggleAccardion').each(function(){
            $(this).removeClass('opened');
            var ch = $(this).attr('href');
            $(ch).removeClass('in');
        });
    }

    $('#showCollapse').click(function(e){
        e.preventDefault();
        $('.collapse').addClass('in');
        $('.toggleAccardion').addClass('opened');
    });

    $('#hideCollapse').click(function(e){
        e.preventDefault();
        $('.collapse').removeClass('in');
        $('.toggleAccardion').removeClass('opened');
    });

});
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
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
    
});
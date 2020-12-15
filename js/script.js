(function($){
    $.get('./db.php', {}, function (data){
        var tpl = $('#tpl').html();
        for (var i in data){
            $('#content').append(Mustache.render(tpl, data[i]));
        }
    }, 'json');
})(jQuery);
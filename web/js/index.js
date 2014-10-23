$(document).ready(function() {
    $('#lastArticlesTabs a').on('click',function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    Socialite.load();
});
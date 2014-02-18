$(document).ready(function() {
    $('#lastArticlesTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    Socialite.load();
});
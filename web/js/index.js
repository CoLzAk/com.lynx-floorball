$(document).ready(function() {
    $('#lastArticlesTabs a').click(function (e) {
        e.preventDefault();
        console.log(this.id);
        $('#tab-'+this.id).tab('show');
    });

    Socialite.load();
});
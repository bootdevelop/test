function buildContentLinks() {
    setTimeout(function () {
        collectHeadlines($('#sidebar-nav .nav'));
    }, 2000)

    function collectHeadlines($container) {

        var $headlines = $('h4 > a.nostyle');

        $headlines.each(function () {
            var $item = buildListItem(this);
            $container.append($item);
        });
        $('.loading-content').css('display', 'none');
        return this;

        function buildListItem($target) {
            var targetText = $target.innerText;

            var $item = $('<li></li>');
            $item.append('<a href="#operations-tag-' + targetText + '">' + targetText + '</a>');
            $item.on('click', function (e) {
                e.preventDefault();

                var target = this.firstChild.hash;
                var $target = $(target);
                var targetParent = $target.parent();

                var headerHeight = $(".navbar-inverse").height() + $target.height();

                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top - headerHeight
                }, 900, 'swing', function () {
                    window.location.hash = "#/" + target.substring(16);
                    $target.addClass('blink')
                    setTimeout(function () {
                        $target.removeClass('blink');
                    }, 500);
                });
            });
            return $item;
        }

    };
}
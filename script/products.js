$(function() {
    $(".products .content").each(function(i) {
        setTimeout(function() {
            $(".products .content").eq(i).addClass("active");
        }, 150 * i);
    });
})
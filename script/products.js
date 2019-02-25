$(function() {
    $(".products .content").each(function(i) {
        setTimeout(function() {
            $(".products .inner").eq(i).addClass("active");
        }, 150 * i);
    });
})
window.onscroll = function() {
    var scrollDiv=document.getElementById("sticky-header")

    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        scrollDiv.style.display = "block";
    } else {
        scrollDiv.style.display = "none";
    }
}
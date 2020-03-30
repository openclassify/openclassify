// Hide watermark_image by default
$(".watermark_image").hide();

$("select[name='watermark_type']").change((event) => {
    let watermarkType = event.target.value;
    if (watermarkType === 'text') {
        $(".watermark_image").hide();
        $(".watermark_text").show()
    } else if (event.target.value === 'image') {
        $(".watermark_image").show();
        $(".watermark_text").hide()
    }
});
// Hide watermark_image by default
const watermarkType = $("select[name='watermark_type']")
const watermarkText = $(".watermark_text")
const watermarkImage = $(".watermark_image")

if (watermarkType.val() === 'text') {
    watermarkImage.hide();
} else {
    watermarkText.hide();
}

$(watermarkType).change((event) => {
    const watermarkTypeValue = event.target.value;
    if (watermarkTypeValue === 'text') {
        watermarkImage.hide();
        watermarkText.show()
    } else if (event.target.value === 'image') {
        watermarkImage.show();
        watermarkText.hide()
    }
});
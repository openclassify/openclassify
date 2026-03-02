
$(document).on("click",".sure-modal",(event) => {
    event.preventDefault();
    swal({
        text: categoryTableTrans.makeMainCategoryText,
        title: categoryTableTrans.makeMainCategoryTitle,
        icon: "warning",
        closeOnEsc: true,
        closeOnClickOutside: true,
        buttons: {
            cancel: {
                visible: true,
                text: categoryTableTrans.makeMainCategoryDeclineText
            },
            confirm: {
                closeModal: true,
                text: categoryTableTrans.makeMainCategoryConfirmText
            },
        }
    }).then((value) => {
        if (value === true) {
            window.location.href = $(event.target).attr('href');
        }
    });

});

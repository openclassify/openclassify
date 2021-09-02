function getCats(i, cat = null, change = false) {
    $(`.cat${i}`).show()
    $(`#cat${i}`).prop('disabled', true)

    $.get('/class/ajaxCategory', { level: i - 1, cat })
        .then((response) => {
            if (response.length) {
                const currSelect = $(`#cat${i}`)
                currSelect.html(`
                    <option value="">Choose an option...</option>
                `)
                for (let ii = 0; ii < response.length; ii++) {
                    currSelect.append(`
                    <option value="${response[ii].id}">${response[ii].name}</option>
                `)
                }
                currSelect.prop('disabled', false)

                if (typeof classified !== 'undefined' && !change) {
                    if (classified[`cat${i}`]) {
                        currSelect.val(classified[`cat${i}`])
                        getCats(i + 1, classified[`cat${i}`])
                    }
                }
            } else {
                $(`.cat${i}`).hide()
            }
        })
}
getCats(1);

for (let i = 1; i <= 10; i++) {
    $(`#cat${i}`).on('change', function () {
        changeCat(i + 1, this.value)
    })
}

function changeCat(level, id) {
    $(`.cat${level - 1}`)
        .nextUntil('.cat10 +').hide()
        .find('select').val('')

    getCats(level, id, true)
}

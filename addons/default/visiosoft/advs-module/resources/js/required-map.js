$('#createEditAdvForm').submit(function () {
    if ($('input[name=map_Val]').val().length === 0) {
        alert(selectLocationAlert)
        return false
    }
    return true
})
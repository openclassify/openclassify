if($('.notification-alert-success').html() != undefined)
{
    Notification($('.notification-alert-success').html(),'success')
}
if($('.notification-alert-info').html() != undefined)
{
    Notification($('.notification-alert-info').html(),'info')
}
if($('.notification-alert-warning').html() != undefined)
{
    Notification($('.notification-alert-warning').html(),'warning')
}
if($('.notification-alert-danger').html() != undefined)
{
    Notification($('.notification-alert-danger').html(),'danger')
}

function Notification(msg,type) {
    $.notify({message: msg}, {type: type,animate: {enter: 'animated fadeInRight', exit: 'animated fadeOutRight'}});
}
<?php

return [
    '403'                 => 'Acceso denegado.',
    '503'                 => 'Ya regresamos.',
    '404'                 => 'Página no encontrada.',
    '500'                 => 'Hubo un error.',
    'no_results'          => 'No hay resultados.',
    'no_fields_available' => 'No hay campos disponibles.',
    'delete_success'      => ':count fila(s) fueron eliminadas.',
    'reorder_success'     => ':count fila(s) fueron reordenadas.',
    'csrf_token_mismatch' => 'Su token de seguridad ha expirado, por favor envie el formulario de nuevo..',
    'delete_installer'    => 'El instalador aún existe! por favor eliminelo de su servidor!, dejarlo significa que el control de este sitio podria verse comprometido.<br><br><strong>' . link_to(
            'admin/addons/modules/delete/anomaly.module.installer',
            'Haga click acá para eliminar el instalador.'
        ) . '</strong>',
    'create_success'      => ':name creado satisfactoriamente.',
    'edit_success'        => ':name actualizado satisfactoriamente.',
    'confirm_delete'      => 'Esta seguro que desea eliminar?<br><small>Esto no se puede deshacer.</small>',
    'prompt_delete'       => 'Esta seguro que desea eliminar?<br><small>Escriba \":match:\" para confirmar.</small>',
];

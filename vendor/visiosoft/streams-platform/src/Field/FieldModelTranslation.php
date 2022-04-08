<?php namespace Anomaly\Streams\Platform\Field;

use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class FieldModelTranslation
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldModelTranslation extends EloquentModel
{

    /**
     * Don't cache this model.
     *
     * @var int
     */
    protected $ttl = false;

    /**
     * Do not use timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table name.
     *
     * @var string
     */
    protected $table = 'streams_fields_translations';
}

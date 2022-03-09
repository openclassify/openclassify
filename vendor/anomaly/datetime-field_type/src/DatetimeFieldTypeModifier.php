<?php namespace Anomaly\DatetimeFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Anomaly\Streams\Platform\Model\Variables\VariablesTestingEntryModel;
use Carbon\Carbon;
use Illuminate\Contracts\Config\Repository;

/**
 * Class DatetimeFieldTypeModifier
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFieldTypeModifier extends FieldTypeModifier
{

    /**
     * The datetime field type.
     * This is for IDE hinting.
     *
     * @var DatetimeFieldType
     */
    protected $fieldType;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new DatetimeFieldTypeModifier instance.
     *
     * @param Repository $config
     * @param DatetimeFieldType $fieldType
     */
    public function __construct(Repository $config, DatetimeFieldType $fieldType)
    {
        $this->config    = $config;
        $this->fieldType = $fieldType;
    }

    /**
     * Modify the value.
     *
     * @param $value
     * @return Carbon|null
     */
    public function modify($value)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof \DateTime) {
            $value = $this->toCarbon($value, array_get($this->fieldType->getConfig(), 'timezone'));
        }

        if ($this->fieldType->config('mode') !== 'date') {
            $value->setTimezone($this->config->get('streams::datetime.database_timezone'));
        }

        return $value;
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return Carbon
     */
    public function restore($value)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof \DateTime) {
            try {
                $value = (new Carbon())->createFromFormat(
                    $this->fieldType->getStorageFormat(),
                    $value,
                    $this->config->get('streams::datetime.database_timezone')
                );
            } catch (\Exception $e) {
                $value = (new Carbon())->createFromTimestamp(
                    strtotime($value),
                    $this->config->get('streams::datetime.database_timezone')
                );
            }
        }

        if ($this->fieldType->config('mode') !== 'date') {
            $value->setTimezone(array_get($this->fieldType->getConfig(), 'timezone'));
        }
        
        if ($this->fieldType->config('mode') == 'date') {
            $value->startOfDay();
        }

        if ($this->fieldType->getEntry() instanceof VariablesTestingEntryModel) {
            //dd($value->setTimezone($this->config->get('streams::datetime.database_timezone')));
        }

        return $value;
    }

    /**
     * Return a carbon instance
     * based on the value.
     *
     * @param              $value
     * @param  null $timezone
     * @return Carbon|null
     * @throws \Exception
     */
    protected function toCarbon($value, $timezone = null)
    {
        if (!$value) {
            return null;
        }

        if ($value instanceof Carbon) {
            return $value;
        }

        if (is_numeric($value)) {
            return (new Carbon())->createFromTimestamp($value, $timezone);
        }

        try {
            return (new Carbon())->createFromFormat($this->fieldType->getDatetimeFormat(), $value, $timezone);
        } catch (\Exception $e) {
            return (new Carbon())->createFromTimestamp(strtotime($value), $timezone);
        }
    }
}

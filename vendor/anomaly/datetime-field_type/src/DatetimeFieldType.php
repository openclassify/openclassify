<?php namespace Anomaly\DatetimeFieldType;

use Anomaly\DatetimeFieldType\Support\DatetimeConverter;
use Anomaly\DatetimeFieldType\Validation\ValidateDatetime;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Carbon\Carbon;
use Illuminate\Contracts\Config\Repository;

/**
 * Class DatetimeFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFieldType extends FieldType
{

    /**
     * The database column type. Depending on the
     * mode this will be datetime, date, or time.
     *
     * @var string
     */
    protected $columnType = 'datetime';

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'datetime',
    ];

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.datetime::filter';

    /**
     * The field type validators.
     *
     * @var array
     */
    protected $validators = [
        'datetime' => [
            'handler' => ValidateDatetime::class,
            'message' => 'The date/time format is invalid.',
        ],
    ];

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode'        => 'datetime',
        'picker'      => true,
        'date_format' => null,
        'time_format' => null,
        'timezone'    => null,
        'step'        => 1,
    ];

    /**
     * The configuration repository.
     *
     * @var Repository
     */
    protected $configuration;

    /**
     * The converter utility.
     *
     * @var DatetimeConverter
     */
    protected $converter;

    /**
     * Create a new DatetimeFieldType instance.
     *
     * @param DatetimeConverter $converter
     * @param Repository $configuration
     */
    public function __construct(DatetimeConverter $converter, Repository $configuration)
    {
        $this->converter     = $converter;
        $this->configuration = $configuration;
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $timezones = array_map(
            function ($timezone) {
                return strtolower($timezone);
            },
            timezone_identifiers_list()
        );

        $formats = $this->configuration->get('anomaly.field_type.datetime::formats.date');

        // Check for default / erroneous timezone.
        if ((!$timezone = strtolower(array_get($config, 'timezone'))) || !in_array($timezone, $timezones)) {
            $config['timezone'] = $this->configuration->get('app.timezone');
        }

        // Default date format.
        if (!$config['date_format']) {
            $config['date_format'] = $this->configuration->get('streams::datetime.date_format');
        }

        // Default time format.
        if (!$config['time_format']) {
            $config['time_format'] = $this->configuration->get('streams::datetime.time_format');
        }

        // Make sure format is supported.
        if (!in_array($config['date_format'], array_keys($formats))) {
            $config['date_format'] = array_first(array_keys($formats));
        }

        return $config;
    }

    /**
     * Get the column type.
     *
     * @return string
     */
    public function getColumnType()
    {
        return array_get($this->config, 'mode');
    }

    /**
     * Get the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        if ($view = parent::getInputView()) {
            return $view;
        }

        if ($this->isPicker()) {
            return 'anomaly.field_type.datetime::picker';
        }

        return 'anomaly.field_type.datetime::input';
    }

    /**
     * Return if the picker
     * is enabled or not.
     *
     * @return bool
     */
    public function isPicker()
    {
        return array_get($this->getConfig(), 'picker') == true;
    }

    /**
     * Return the conversion map to use.
     *
     * @return string
     */
    public function converterMap()
    {
        return $this->isPicker() ? 'picker' : 'default';
    }

    /**
     * Get the date format
     * for the plugin.
     *
     * @param null $mode
     * @return string
     */
    public function getPluginFormat($mode = null)
    {
        return $this->converter->toJs(
            $this->getDatetimeFormat($mode),
            $this->converterMap()
        );
    }

    /**
     * Get the input value.
     *
     * @param null $default
     * @return Carbon
     */
    public function getInputValue($default = null)
    {
        if (!$value = parent::getInputValue($default)) {
            return null;
        }

        $value = (new Carbon())->createFromFormat(
            $this->getInputFormat(),
            $value,
            array_get($this->getConfig(), 'timezone')
        );

        return $value;
    }

    /**
     * Get the input format
     * for the plugin.
     *
     * @return string
     */
    public function getInputFormat()
    {
        return $this->converter->toJs(
            str_replace(':s', '', $this->getStorageFormat()),
            $this->converterMap()
        );
    }

    /**
     * Get the post format.
     *
     * @param $mode
     * @return string
     */
    public function getDatetimeFormat($mode = null)
    {
        $mode = $mode ?: array_get($this->getConfig(), 'mode');

        $date = array_get($this->getConfig(), 'date_format');
        $time = array_get($this->getConfig(), 'time_format');

        if ($mode === 'datetime') {
            return $date . ' ' . $time;
        }

        return $mode === 'date' ? $date : $time;
    }

    /**
     * Get the storage format.
     *
     * @return string
     * @throws \Exception
     */
    public function getStorageFormat()
    {
        switch ($this->getColumnType()) {
            case 'datetime':
                return 'Y-m-d H:i:s';
            case 'date':
                return 'Y-m-d';
            case 'time':
                return 'H:i:s';
        }

        throw new \Exception('Storage format can not be determined.');
    }

    /**
     * Get the output format.
     *
     * @param  null $output
     * @return string
     */
    public function getOutputFormat($output = null)
    {
        switch ($output ?: $this->getColumnType()) {
            case 'datetime':
                return array_get(
                        $this->getConfig(),
                        'date_format',
                        config('streams::datetime.date_format')
                    ) . ' ' . array_get(
                        $this->getConfig(),
                        'time_format',
                        config('streams::datetime.time_format')
                    );
            case 'date':
                return array_get($this->getConfig(), 'date_format', config('streams::datetime.date_format'));
            case 'time':
                return array_get($this->getConfig(), 'time_format', config('streams::datetime.time_format'));
        }

        return null;
    }

    /**
     * Get the placeholder.
     *
     * @return int|null|string
     */
    public function getPlaceholder()
    {
        $placeholder = parent::getPlaceholder();

        if ($placeholder === false) {
            return null;
        }

        if ($placeholder === null) {
            return date($this->getDatetimeFormat());
        }

        return $placeholder;
    }
}

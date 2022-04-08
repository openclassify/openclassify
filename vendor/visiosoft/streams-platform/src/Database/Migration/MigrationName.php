<?php namespace Anomaly\Streams\Platform\Database\Migration;

class MigrationName
{

    /**
     * The migration file name.
     *
     * @var string
     */
    protected $file;

    /**
     * Create a new MigrationFile
     *
     * @param string $file The migration file name
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Return the filename without the date prefix.
     *
     * @return string The file name without date prefix.
     */
    public function withoutDatePrefix()
    {
        return preg_replace('/^(\d{4}_\d{2}_\d{2}_\d{6}_)/', '', basename($this->file));
    }

    /**
     * Return the namespace of the migration filename.
     *
     * @return string
     */
    public function addonNamespace()
    {
        return preg_replace('/(__\w+)(\.php)?$/', '', $this->withoutDatePrefix());
    }

    /**
     * Return the class name for the migration file.
     *
     * @return string
     */
    public function className()
    {
        return studly_case(str_replace('.', '_', basename($this->withoutDatePrefix(), '.php')));
    }

    /**
     * Return the migration name for the migration file.
     *
     * @return string
     */
    public function migration()
    {
        return basename($this->file, '.php');
    }
}

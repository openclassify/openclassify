<?php namespace Anomaly\Streams\Platform\Database\Migration\Field;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Field\FieldInput;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;

class FieldMigrator
{
    /**
     * The field input reader.
     *
     * @var FieldInput
     */
    protected $input;

    /**
     * The field repository.
     *
     * @var FieldRepositoryInterface
     */
    protected $fields;

    /**
     * Create a new FieldMigrator instance.
     *
     * @param FieldRepositoryInterface $fields
     */
    public function __construct(FieldInput $input, FieldRepositoryInterface $fields)
    {
        $this->input  = $input;
        $this->fields = $fields;
    }

    /**
     * Migrate the migration.
     *
     * @param Migration $migration
     */
    public function migrate(Migration $migration)
    {
        $this->input->read($migration);

        foreach ($migration->getFields() as $field) {
            if (!$this->fields->findBySlugAndNamespace($field['slug'], $field['namespace'])) {
                $this->fields->create($field);
            }
        }
    }

    /**
     * Reset the migration.
     *
     * @param Migration $migration
     */
    public function reset(Migration $migration)
    {
        $this->input->read($migration);

        foreach ($migration->getFields() as $field) {
            if ($field = $this->fields->findBySlugAndNamespace($field['slug'], $field['namespace'])) {
                $this->fields->delete($field);
            }
        }
    }
}

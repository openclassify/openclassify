<?php namespace Anomaly\Streams\Platform\Database\Migration;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Migration extends \Illuminate\Database\Migrations\Migration
{

    use DispatchesJobs;

    /**
     * The addon instance.
     *
     * This is set by the migrator when
     * an addon is being migrated.
     *
     * @var Addon
     */
    protected $addon = null;

    /**
     * The stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * The migration fields.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * The migration stream.
     *
     * @var array
     */
    protected $stream = [];

    /**
     * The migration assignments.
     *
     * @var array
     */
    protected $assignments = [];

    /**
     * Should the migration delete
     * its stream when rolling back?
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * Return the migration's contextual namespace.
     *
     * @return string
     */
    public function contextualNamespace()
    {
        return $this->getNamespace() ?: $this->addon->getSlug();
    }

    /**
     * Return the field repository.
     *
     * @return FieldRepositoryInterface
     */
    public function fields()
    {
        return app(FieldRepositoryInterface::class);
    }

    /**
     * Return the stream repository.
     *
     * @return StreamRepositoryInterface
     */
    public function streams()
    {
        return app(StreamRepositoryInterface::class);
    }

    /**
     * Return the assignment repository.
     *
     * @return AssignmentRepositoryInterface
     */
    public function assignments()
    {
        return app(AssignmentRepositoryInterface::class);
    }

    /**
     * Return the schema builder.
     *
     * @return Builder
     */
    public function schema()
    {
        return app('db')->connection()->getSchemaBuilder();
    }

    /**
     * Return the delete flag.
     *
     * @return bool
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * Set the addon.
     *
     * @param Addon $addon
     */
    public function setAddon(Addon $addon)
    {
        $this->addon = $addon;

        return $this;
    }

    /**
     * Get the addon.
     *
     * @return Addon
     */
    public function getAddon()
    {
        return $this->addon;
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the fields.
     *
     * @param  array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set the stream.
     *
     * @param  array $stream
     * @return $this
     */
    public function setStream(array $stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the stream.
     *
     * @return array
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the assignments.
     *
     * @param  array $assignments
     * @return $this
     */
    public function setAssignments(array $assignments)
    {
        $this->assignments = $assignments;

        return $this;
    }

    /**
     * Get the assignments.
     *
     * @return array
     */
    public function getAssignments()
    {
        return $this->assignments;
    }

    /**
     * Migrate
     */
    public function up()
    {
    }

    /**
     * Rollback
     */
    public function down()
    {
    }
}

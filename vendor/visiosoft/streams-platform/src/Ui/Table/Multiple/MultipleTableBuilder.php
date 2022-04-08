<?php namespace Anomaly\Streams\Platform\Ui\Table\Multiple;

use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\BuildTables;
use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\LoadTables;
use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\MergeRows;
use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\PostTables;
use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\SetActiveActions;
use Anomaly\Streams\Platform\Ui\Table\Multiple\Command\SetActiveFilters;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableCollection;

/**
 * Class MultipleTableBuilder
 *
 * @link          http://anomaly.is/streams-plattable
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MultipleTableBuilder extends TableBuilder
{

    /**
     * The table collection.
     *
     * @var TableCollection
     */
    protected $tables;

    /**
     * Create a new MultipleTableBuilder instance.
     *
     * @param Table           $table
     * @param TableCollection $tables
     */
    public function __construct(Table $table, TableCollection $tables)
    {
        $this->tables = $tables;

        parent::__construct($table);
    }

    /**
     * Build the table.
     */
    public function build()
    {
        parent::build();

        $this->dispatchNow(new SetActiveFilters($this));
        $this->dispatchNow(new BuildTables($this));
        $this->dispatchNow(new MergeRows($this));

        if (app('request')->isMethod('post')) {
            $this->dispatchNow(new SetActiveActions($this));
            $this->dispatchNow(new PostTables($this));
        }
    }

    /**
     * Make the table response.
     */
    public function make()
    {
        $this->dispatchNow(new LoadTables($this));

        parent::make();
    }

    /**
     * Get the tables.
     *
     * @return TableCollection
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Set the tables.
     *
     * @param $tables
     * @return $this
     */
    public function setTables(TableCollection $tables)
    {
        $this->tables = $tables;

        return $this;
    }

    /**
     * Add a table.
     *
     * @param               $key
     * @param  TableBuilder $builder
     * @return $this
     */
    public function addTable($key, TableBuilder $builder)
    {
        $this->tables->put(
            $key,
            $builder->setOption('prefix', $key . '_')
        );

        return $this;
    }
}

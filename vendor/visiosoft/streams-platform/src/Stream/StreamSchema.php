<?php namespace Anomaly\Streams\Platform\Stream;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/**
 * Class StreamSchema
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class StreamSchema
{

    /**
     * The schema builder.
     *
     * @var Builder
     */
    protected $schema;

    /**
     * Create a new StreamSchema instance.
     */
    public function __construct()
    {
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    /**
     * Create a table.
     *
     * @param StreamInterface
     */
    public function createTable(StreamInterface $stream)
    {
        $table = $stream->getEntryTableName();

        $this->schema->dropIfExists($table);

        $this->schema->create(
            $table,
            function (Blueprint $table) use ($stream) {

                $table->engine = $stream->getConfig('database.engine');

                $table->increments('id');
                $table->integer('sort_order')->nullable();
                $table->datetime('created_at');
                $table->integer('created_by_id')->nullable();
                $table->datetime('updated_at')->nullable();
                $table->integer('updated_by_id')->nullable();

                if ($stream->isTrashable()) {
                    $table->datetime('deleted_at')->nullable();
                }
            }
        );
    }

    /**
     * Create translations table.
     *
     * @param StreamInterface $stream
     */
    public function createTranslationsTable(StreamInterface $stream)
    {
        $this->schema->dropIfExists($stream->getEntryTranslationsTableName());

        $this->schema->create(
            $stream->getEntryTranslationsTableName(),
            function (Blueprint $table) use ($stream) {

                $table->engine = $stream->getConfig('database.engine');

                $table->increments('id');
                $table->integer('entry_id');
                $table->datetime('created_at');
                $table->integer('created_by_id')->nullable();
                $table->datetime('updated_at')->nullable();
                $table->integer('updated_by_id')->nullable();
                $table->string('locale')->index();
            }
        );
    }

    /**
     * Rename a table.
     *
     * @param StreamInterface $from
     * @param StreamInterface $to
     */
    public function renameTable(StreamInterface $from, StreamInterface $to)
    {
        if ($from->getEntryTableName() === $to->getEntryTableName()) {
            return;
        }

        $this->schema->rename($from->getEntryTableName(), $to->getEntryTableName());
    }

    /**
     * Rename a translations table.
     *
     * @param StreamInterface $from
     * @param StreamInterface $to
     */
    public function renameTranslationsTable(StreamInterface $from, StreamInterface $to)
    {
        if ($from->getEntryTranslationsTableName() === $to->getEntryTranslationsTableName()) {
            return;
        }

        $this->schema->rename($from->getEntryTranslationsTableName(), $to->getEntryTranslationsTableName());
    }

    /**
     * Drop a table.
     *
     * @param $table
     */
    public function dropTable($table)
    {
        $this->schema->dropIfExists($table);
    }
}

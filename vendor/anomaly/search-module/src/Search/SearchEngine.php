<?php namespace Anomaly\SearchModule\Search;

use Anomaly\SearchModule\Item\Contract\ItemInterface;
use Anomaly\SearchModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\SearchModule\Item\ItemModel;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Entry\EntryTranslationsModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;

/**
 * Class SearchEngine
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchEngine extends Engine
{

    /**
     * The item repository.
     *
     * @var ItemRepositoryInterface
     */
    protected $items;

    /**
     * Create a new SearchEngine instance.
     *
     * @param ItemRepositoryInterface $items
     */
    public function __construct(ItemRepositoryInterface $items)
    {
        $this->items = $items;
    }

    /**
     * Update the given model in the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function update($models)
    {
        $this->delete($models);

        /* @var EntryModel $model */
        foreach ($models as $model) {

            /* @var StreamInterface $stream */
            $stream = $model->getStream();

            /**
             * If the stream is translatable
             * then loop through locales and
             * index each one accordingly.
             */
            if ($stream->isTranslatable()) {
                foreach (config('streams::locales.enabled', []) as $locale) {

                    /* @var EntryTranslationsModel $translation */
                    $translation = $model->translateOrDefault($locale);

                    $this->index($translation->getParent(), $translation->getLocale());
                }
            }

            /**
             * If the stream is NOT translatable
             * then simply loop the one model.
             */
            if (!$stream->isTranslatable()) {
                $this->index($model);
            }
        }
    }

    /**
     * Remove the given model from the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function delete($models)
    {
        foreach ($models as $model) {

            /* @var ItemInterface|EloquentModel $item */
            foreach ($this->items->findAllByEntry($model) as $item) {
                $this->items->withoutEvents(
                    function () use ($item) {
                        $this->items->delete($item);
                    }
                );
            }
        }
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
        return $this->items->search($builder);
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder $builder
     * @param  int $perPage
     * @param  int $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        return $this->items->search(
            $builder,
            [
                'per_page' => $perPage,
                'page'     => $page,
            ]
        );
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
        return $results->pluck('id');
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param  \Laravel\Scout\Builder $builder
     * @param  EntryCollection $results
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function map(Builder $builder, $results, $model)
    {
        return $results->map(
            function (ItemInterface $item) {
                return $item->getEntry();
            }
        );
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed $results
     * @return int
     */
    public function getTotalCount($results)
    {
        return $results->count();
    }

    /**
     * Flush all of the model's records from the engine.
     *
     * @param  \Illuminate\Database\Eloquent\Model|EntryModel $model
     * @return void
     */
    public function flush($model)
    {
        foreach ($this->items->findAllBy('stream_id', $model->getStreamId()) as $item) {
            $this->items->withoutEvents(
                function () use ($item) {
                    $this->items->delete($item);
                }
            );
        }
    }

    /**
     * Index the model.
     *
     * @param EntryModel $model
     */
    protected function index(EntryModel $model, $locale = null)
    {
        $locale = $locale ?: config('app.fallback_locale');

        /* @var EntryModel $model */
        if (!$array = $model->toSearchableArray()) {
            return;
        }

        /**
         * If the model is translatable
         * then translate it and use
         * that array data to index.
         *
         * Keep any fields that don't have a translation
         * as the default locale
         *
         * @var EntryTranslationsModel|EntryModel $translation
         */
        if ($model->isTranslatable() && $translation = $model->translateOrDefault($locale)) {
            $array = array_merge(
                $array,
                array_filter(
                    $translation->toArray(),
                    function ($item, $key) use ($array) {
                        return !empty($item) && in_array($key, array_keys($array));
                    },
                    ARRAY_FILTER_USE_BOTH
                )
            );
        }

        if (!$item = $this->items->findByEntryAndLocale($model, $locale)) {
            $item = new ItemModel(
                [
                    'entry'  => $model,
                    'stream' => $model->getStream(),
                ]
            );
        }

        if (($title = $model->getTitleName()) == 'id') {
            $title = 'title';
        }

        $item->fill(
            [
                'title'       => array_get($array, $title),
                'keywords'    => array_get($array, 'keywords'),
                'description' => array_get($array, 'description'),
                'locale'      => $locale,
                'searchable'  => $array,
            ]
        );

        $this->items->withoutEvents(
            function () use ($item) {
                $this->items->save($item);
            }
        );
    }

}

<?php namespace Anomaly\BlocksFieldType\Block;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BlocksRelation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksRelation extends BelongsToMany
{

    /**
     * Create a new instance of the related model.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
//    public function create(array $attributes)
//    {
//        /**
//         * Mutate the 'entry' attribute since
//         * that is what we're used to.
//         *
//         * @var EntryInterface $entry
//         */
//        if (isset($attributes['entry']) && $attributes['entry'] instanceof EntryInterface) {
//
//            $entry = array_pull($attributes, 'entry');
//
//            $attributes['entry_id']   = $entry->getId();
//            $attributes['entry_type'] = get_class($entry);
//        }
//
//        // Here we will set the raw attributes to avoid hitting the "fill" method so
//        // that we do not have to worry about a mass accessor rules blocking sets
//        // on the models. Otherwise, some of these attributes will not get set.
//        $instance = $this->related->newInstance($attributes);
//
//        $instance->setTable($this->related->getTable());
//
//        $instance->setAttribute($this->getPlainForeignKey(), $this->getParentKey());
//
//        $instance->save();
//
//        return $instance;
//    }
}

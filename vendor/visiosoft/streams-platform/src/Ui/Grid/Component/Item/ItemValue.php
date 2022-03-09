<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Item;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\View\View;
use Robbo\Presenter\Decorator;
use StringTemplate\Engine;

/**
 * Class ItemValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemValue
{

    /**
     * The string parser.
     *
     * @var Engine
     */
    protected $parser;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * The decorator utility.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new ItemValue instance.
     *
     * @param Engine    $parser
     * @param Evaluator $evaluator
     * @param Decorator $decorator
     */
    public function __construct(Engine $parser, Evaluator $evaluator, Decorator $decorator)
    {
        $this->parser    = $parser;
        $this->evaluator = $evaluator;
        $this->decorator = $decorator;
    }

    /**
     * Return the item value.
     *
     * @param  GridBuilder     $builder
     * @param                  $entry
     * @return View|mixed|null
     */
    public function make(GridBuilder $builder, $entry)
    {
        $value = $builder->getGridOption('item_value', 'entry.title');

        /*
         * If the entry is an instance of EntryInterface
         * then try getting the field value from the entry.
         */
        if ($entry instanceof EntryInterface && $entry->getField($value)) {
            if ($entry->assignmentIsRelationship($value)) {
                $value = $entry->{camel_case($value)}->getTitle();
            } else {
                $value = $entry->getFieldValue($value);
            }
        }

        /*
         * If the value matches a field with a relation
         * then parse the string using the eager loaded entry.
         */
        if (preg_match("/^entry.([a-zA-Z\\_]+)/", $value, $match)) {
            $fieldSlug = camel_case($match[1]);

            if (method_exists($entry, $fieldSlug) && $entry->{$fieldSlug}() instanceof Relation) {
                $entry = $this->decorator->decorate($entry);

                $value = data_get(
                    compact('entry'),
                    str_replace("entry.{$match[1]}.", 'entry.' . camel_case($match[1]) . '.', $value)
                );
            }
        }

        /*
         * Decorate the entry object before
         * sending to decorate so that data_get()
         * can get into the presenter methods.
         */
        $entry = $this->decorator->decorate($entry);

        /*
         * If the value matches a method in the presenter.
         */
        if (preg_match("/^entry.([a-zA-Z\\_]+)/", $value, $match)) {
            if (method_exists($entry, camel_case($match[1]))) {
                $value = $entry->{camel_case($match[1])}();
            }
        }

        /*
         * By default we can just pass the value through
         * the evaluator utility and be done with it.
         */
        $value = $this->evaluator->evaluate($value, compact('builder', 'entry'));

        /*
         * Lastly, prepare the entry to be
         * parsed into the string.
         */
        if ($entry instanceof Arrayable) {
            $entry = $entry->toArray();
        } else {
            $entry = null;
        }

        /*
         * Parse the value with the entry.
         */
        $value = $this->parser->render($builder->getGridOption('item_wrapper', '{value}'), compact('value', 'entry'));

        /*
         * If the value looks like a language
         * key then try translating it.
         */
        if (str_is('*.*.*::*', $value)) {
            $value = trans($value);
        }

        return $value;
    }
}

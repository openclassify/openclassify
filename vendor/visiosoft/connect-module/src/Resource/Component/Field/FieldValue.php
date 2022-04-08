<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\Resource;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Evaluator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\View\View;
use Robbo\Presenter\Decorator;
use StringTemplate\Engine;

/**
 * Class FieldValue
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field
 */
class FieldValue
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
     * Create a new FieldValue instance.
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
     * Return the field value.
     *
     * @param Resource $resource
     * @param array    $field
     * @param          $entry
     * @return View|mixed|null
     */
    public function make(Resource $resource, array $field, $entry)
    {
        $value = array_get($field, 'value');

        /**
         * If the value is a view path then return a view.
         */
        if ($view = array_get($field, 'view')) {
            return view($view, compact('resource', 'entry', 'value'));
        }

        /**
         * If the entry is an instance of EntryInterface
         * then try getting the field value from the entry.
         */
        if ($entry instanceof EntryInterface && $entry->getField($value)) {

            /* @var EntryInterface $relation */
            if ($entry->assignmentIsRelationship($value) && $relation = $entry->{camel_case($value)}) {
                $value = $relation->getTitle();
            } else {
                $value = $entry->getFieldValue($value);
            }
        }

        /**
         * If the value matches a field with a relation
         * then parse the string using the eager loaded entry.
         */
        if (is_string($value) && preg_match("/^entry.([a-zA-Z\\_]+)/", $value, $match)) {

            $fieldSlug = camel_case($match[1]);

            if (method_exists($entry, $fieldSlug) && $entry->{$fieldSlug}() instanceof Relation) {

                $entry = $this->decorator->decorate($entry);

                $value = data_get(
                    compact('entry'),
                    str_replace("entry.{$match[1]}.", 'entry.' . camel_case($match[1]) . '.', $value)
                );
            }
        }

        /**
         * Decorate the entry object before
         * sending to decorate so that data_get()
         * can get into the presenter methods.
         */
        $entry = $this->decorator->decorate($entry);

        /**
         * If the value matches a method in the presenter.
         */
        if (is_string($value) && preg_match("/^entry.([a-zA-Z\\_]+)/", $value, $match)) {
            if (method_exists($entry, camel_case($match[1]))) {
                $value = $entry->{camel_case($match[1])}();
            }
        }

        /**
         * By default we can just pass the value through
         * the evaluator utility and be done with it.
         */
        $value = $this->evaluator->evaluate($value, compact('resource', 'entry'));

        /**
         * Lastly, prepare the entry to be
         * parsed into the string.
         */
        if ($entry instanceof Arrayable) {
            $entry = $entry->toArray();
        } else {
            $entry = null;
        }

        /**
         * Parse the value with the entry.
         */
        $value = $this->parser->render($field['wrapper'], compact('value', 'entry'));

        /**
         * If the value looks like a language
         * key then try translating it.
         */
        if (str_is('*.*.*::*', $value)) {
            $value = trans($value);
        }

        return $value;
    }
}

<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryStreamParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryStreamParser
{

    /**
     * Parse the stream data.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $string = '[';

        $this->parseStream($stream, $string);
        $this->parseAssignments($stream, $string);
        $this->parseTranslations($stream, $string);

        $string .= "\n]";

        return $string;
    }

    /**
     * Parse the stream.
     *
     * @param StreamInterface $stream
     * @param                 $string
     */
    protected function parseStream(StreamInterface $stream, &$string)
    {
        foreach ($stream->getAttributes() as $key => $value) {
            $key = addcslashes($key, "'");
            $value = addcslashes($value, "'");

            $string .= "\n'{$key}' => '{$value}',";
        }
    }

    /**
     * Parse the assignments.
     *
     * @param StreamInterface $stream
     * @param                 $string
     */
    protected function parseAssignments(StreamInterface $stream, &$string)
    {
        $string .= "\n'assignments' => [";

        foreach ($stream->getAssignments() as $assignment) {
            $this->parseAssignment($assignment, $string);
        }

        $string .= "\n],";
    }

    /**
     * Parse an assignment.
     *
     * @param AssignmentInterface $assignment
     * @param                     $string
     */
    protected function parseAssignment(AssignmentInterface $assignment, &$string)
    {
        $string .= "\n[";

        foreach ($assignment->getAttributes() as $key => $value) {
            $value = $assignment->getAttribute($key);
            $key = addcslashes($key, "'");

            // Serialize arrays.
            if (is_array($value)) {
                $value = serialize($value);
            }

            // Cast objects to strings.
            if(is_object($value)){
                $value = (string)$value;
            }

            // Quote and escape non numeric values.
            if(!is_numeric($value)){
                $value = "'" . addcslashes($value, "'") . "'";
            }

            $string .= "\n'{$key}' => {$value},";
        }

        // Parse this assignment field.
        $this->parseField($assignment->getField(), $string);

        // Parse assignment translations.
        $this->parseTranslations($assignment, $string);

        $string .= "\n],";
    }

    /**
     * Parse an assignment field.
     *
     * @param FieldInterface $field
     * @param                $string
     */
    protected function parseField(FieldInterface $field, &$string)
    {
        $string .= "\n'field' => [";

        foreach ($field->getAttributes() as $key => $value) {
            $value = $field->getAttribute($key);

            if (is_array($value)) {
                $value = serialize($value);
            }

            $key = addcslashes($key, "'");
            $value = addcslashes($value, "'");

            $string .= "\n'{$key}' => '{$value}',";
        }

        // Parse field translations.
        $this->parseTranslations($field, $string);

        $string .= "\n],";
    }

    /**
     * Parse a model's translations.
     *
     * @param EloquentModel $model
     * @param               $string
     */
    protected function parseTranslations(EloquentModel $model, &$string)
    {
        $string .= "\n'translations' => [";

        foreach ($model->getTranslations() as $translation) {
            $this->parseTranslation($translation, $string);
        }

        $string .= "\n],";
    }

    /**
     * Parse a translation.
     *
     * @param EloquentModel $translation
     * @param               $string
     */
    protected function parseTranslation(EloquentModel $translation, &$string)
    {
        $string .= "\n[";

        foreach ($translation->getAttributes() as $key => $value) {
            $value = $translation->getAttribute($key);
            $key = addcslashes($key, "'");

            // Serialize arrays.
            if (is_array($value)) {
                $value = serialize($value);
            }

            // Cast objects to strings.
            if(is_object($value)){
                $value = (string)$value;
            }

            // Quote and escape non numeric values.
            if(!is_numeric($value)){
                $value = "'" . addcslashes($value, "'") . "'";
            }

            $string .= "\n'{$key}' => {$value},";
        }

        $string .= "\n],";
    }
}

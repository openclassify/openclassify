<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;

/**
 * Class FieldTypeParser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\Streams\Platform\Addon\FieldType
 */
class FieldTypeParser
{

    /**
     * Return the parsed relation.
     *
     * @param AssignmentInterface $assignment
     * @return string
     */
    public function relation(AssignmentInterface $assignment)
    {
        $fieldSlug = $assignment->getFieldSlug();
        $fieldName = humanize($fieldSlug);
        $method    = camel_case($fieldSlug);

        return "
    /**
     * The {$fieldName} relation
     *
     * @return Relation
     */
    public function {$method}()
    {
        return \$this->getFieldType('{$fieldSlug}')->getRelation();
    }
";
    }
}

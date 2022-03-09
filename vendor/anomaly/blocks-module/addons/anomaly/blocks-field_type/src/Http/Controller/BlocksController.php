<?php namespace Anomaly\BlocksFieldType\Http\Controller;

use Anomaly\BlocksFieldType\BlocksFieldType;
use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class BlocksController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksController extends PublicController
{

    /**
     * Choose what kind of row to add.
     *
     * @param FieldRepositoryInterface $fields
     * @param                          $field
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(FieldRepositoryInterface $fields, ExtensionCollection $extensions, $field)
    {
        /* @var FieldInterface $field */
        $field = $fields->find($field);

        /* @var BlocksFieldType $type */
        $type = $field->getType();

        /* @var ExtensionCollection $extensions */
        $extensions = $extensions->search('anomaly.module.blocks::block.*')
            ->enabled()
            ->sort();

        $allowed = $type->config('blocks', []);

        if (!$allowed) {
            $allowed = array_map(
                function (BlockExtension $extension) {
                    return $extension->getNamespace();
                },
                $extensions->all()
            );
        }

        $extensions = $extensions->filter(
            function ($extension) use ($allowed) {

                /* @var BlockExtension $extension */
                return in_array($extension->getNamespace(), $allowed);
            }
        );

        return $this->view->make(
            'anomaly.field_type.blocks::choose',
            [
                'blocks' => $extensions->all(),
            ]
        );
    }

    /**
     * Return a form row.
     *
     * @param FieldRepositoryInterface $fields
     * @param ExtensionCollection $extensions
     * @param $field
     * @param $extension
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function form(
        FieldRepositoryInterface $fields,
        ExtensionCollection $extensions,
        $field,
        $extension
    ) {

        /* @var FieldInterface $field */
        /* @var BlockExtension $extension */
        $field     = $fields->find($field);
        $extension = $extensions->get($extension);

        /* @var BlocksFieldType $type */
        $type = $field->getType();

        $type->setPrefix($this->request->get('prefix'));

        return $type
            ->form(
                $field,
                $extension,
                $this->request->get('instance')
            )
            ->addFormData('field_type', $type)
            ->render();
    }
}

<?php namespace Anomaly\Streams\Platform\Ui\Form\Contract;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Interface FormRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface FormRepositoryInterface
{

    /**
     * Find an entry or return a new one.
     *
     * @param $id
     * @return mixed
     */
    public function findOrNew($id);

    /**
     * Save the form.
     *
     * @param  FormBuilder $builder
     * @return bool|mixed
     */
    public function save(FormBuilder $builder);
}

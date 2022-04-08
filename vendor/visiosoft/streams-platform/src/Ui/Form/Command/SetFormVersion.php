<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Version\Contract\VersionRepositoryInterface;

/**
 * Class SetFormVersion
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetFormVersion
{

    /**
     * The form builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Form\FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormColumnsCommand instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the form model object from the builder's model.
     *
     * @param VersionRepositoryInterface $versions
     */
    public function handle(VersionRepositoryInterface $versions)
    {
        if (request()->method() == 'POST') {
            return;
        }

        if (!$version = request('version')) {
            return;
        }

        if ($this->builder->getFormModel() && $this->builder->getFormModelName() != request('versionable')) {
            return;
        }

        /* @var VersionInterface $version */
        if (!$version = $versions->find($version)) {
            return;
        }

        $this->builder
            ->setVersion($version)
            ->setFormEntry($version->getModel());
    }
}

<?php namespace Anomaly\DashboardModule\Dashboard;

use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class DashboardPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardPresenter extends EntryPresenter
{

    /**
     * Return the edit link.
     *
     * @return string
     */
    public function editLink()
    {
        return app('html')->link(
            implode(
                '/',
                array_unique(
                    array_filter(
                        [
                            'admin',
                            $this->object->getStreamNamespace(),
                            'edit',
                            $this->object->getId(),
                        ]
                    )
                )
            ),
            $this->object->{$this->object->getTitleName()}
        );
    }
}

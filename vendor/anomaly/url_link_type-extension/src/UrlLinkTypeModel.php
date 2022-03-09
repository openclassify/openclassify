<?php namespace Anomaly\UrlLinkTypeExtension;

use Anomaly\Streams\Platform\Model\UrlLinkType\UrlLinkTypeUrlsEntryModel;

/**
 * Class UrlLinkTypeModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UrlLinkTypeModel extends UrlLinkTypeUrlsEntryModel
{

    /**
     * Eager load these relations.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}

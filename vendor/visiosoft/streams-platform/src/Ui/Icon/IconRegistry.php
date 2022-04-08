<?php namespace Anomaly\Streams\Platform\Ui\Icon;

/**
 * Class IconRegistry
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class IconRegistry
{

    /**
     * Available icon.
     *
     * @var array
     */
    protected $icons = [
        'addon'                => 'fa fa-puzzle-piece',
        'adjust'               => 'glyphicons glyphicons-adjust-alt',
        'airplane'             => 'glyphicons glyphicons-airplane',
        'amex'                 => 'fa fa-cc-amex',
        'arrows-h'             => 'fa fa-arrows-h',
        'arrows-v'             => 'fa fa-arrows-v',
        'ban'                  => 'fa fa-ban',
        'bars'                 => 'fa fa-bars',
        'bookmark'             => 'fa fa-bookmark',
        'bookmark-alt'         => 'fa fa-bookmark-o',
        'book-open'            => 'glyphicons glyphicons-book-open',
        'brush'                => 'glyphicons glyphicons-brush',
        'calendar'             => 'glyphicons glyphicons-calendar',
        'car'                  => 'glyphicons glyphicons-car',
        'check'                => 'fa fa-check',
        'check-circle'         => 'fa fa-check-circle',
        'check-circle-alt'     => 'fa fa-check-circle-o',
        'check-square-alt'     => 'fa fa-check-square-o',
        'circle'               => 'fa fa-circle',
        'circle-alt'           => 'fa fa-circle-o',
        'circle-question-mark' => 'glyphicons glyphicons-circle-question-mark',
        'cloud-plus'           => 'glyphicons glyphicons-cloud-plus',
        'cloud-upload'         => 'fa fa-cloud-upload',
        'cloud-upload-alt'     => 'glyphicons glyphicons-cloud-upload',
        'code'                 => 'fa fa-code',
        'code-fork'            => 'fa fa-code-fork',
        'cog'                  => 'fa fa-cog',
        'cogs'                 => 'fa fa-cogs',
        'comments'             => 'glyphicons glyphicons-comments',
        'compress'             => 'fa fa-compress',
        'conversation'         => 'glyphicons glyphicons-conversation',
        'credit-card'          => 'glyphicons glyphicons-credit-card',
        'cubes'                => 'fa fa-cubes',
        'dashboard'            => 'fa fa-dashboard',
        'database'             => 'fa fa-database',
        'diners-club'          => 'fa  fa-cc-diners-club',
        'discover'             => 'fa fa-cc-discover',
        'download'             => 'fa fa-download',
        'duplicate'            => 'glyphicons glyphicons-duplicate',
        'envelope'             => 'fa fa-envelope',
        'envelope-alt'         => 'fa fa-envelope-o',
        'exchange'             => 'fa fa-exchange',
        'exit'                 => 'fa fa-sign-out',
        'expand'               => 'fa fa-expand',
        'external-link'        => 'fa fa-external-link',
        'eyedropper'           => 'glyphicons glyphicons-eyedropper',
        'facebook'             => 'fa fa-facebook',
        'facebook-square'      => 'fa fa-facebook-square',
        'facetime-video'       => 'glyphicons glyphicons-facetime-video',
        'file'                 => 'fa fa-file-o',
        'file-image'           => 'fa fa-file-image-o',
        'film'                 => 'fa fa-film',
        'filter'               => 'fa fa-filter',
        'fire'                 => 'glyphicons glyphicons-fire',
        'flag'                 => 'fa fa-flag',
        'folder-closed'        => 'glyphicons glyphicons-folder-closed',
        'folder-open'          => 'glyphicons glyphicons-folder-open',
        'fullscreen'           => 'glyphicons glyphicons-fullscreen',
        'git-branch'           => 'glyphicons glyphicons-git-branch',
        'global'               => 'glyphicons glyphicons-global',
        'globe'                => 'glyphicons glyphicons-globe',
        'history'              => 'fa fa-history',
        'home'                 => 'fa fa-home',
        'jcb'                  => 'fa fa-cc-jcb',
        'keys'                 => 'glyphicons glyphicons-keys',
        'language'             => 'fa fa-language',
        'laptop'               => 'fa fa-laptop',
        'link'                 => 'glyphicons glyphicons-link',
        'list-alt'             => 'fa fa-list-alt',
        'list-ol'              => 'fa fa-list-ol',
        'list-ul'              => 'fa fa-list-ul',
        'lock'                 => 'fa fa-lock',
        'locked'               => 'fa fa-lock',
        'magic'                => 'glyphicons glyphicons-magic',
        'map-marker'           => 'fa fa-map-marker',
        'mastercard'           => 'fa fa-cc-mastercard',
        'minus'                => 'fa fa-minus',
        'newspaper'            => 'fa fa-newspaper-o',
        'options'              => 'fa fa-options',
        'order'                => 'glyphicons glyphicons-sort',
        'paperclip'            => 'glyphicons glyphicons-paperclip',
        'paypal'               => 'fa fa-cc-paypal',
        'pencil'               => 'fa fa-pencil',
        'percent'              => 'fa fa-percent',
        'phone'                => 'fa fa-phone',
        'picture'              => 'glyphicons glyphicons-picture',
        'play'                 => 'fa fa-play',
        'plug'                 => 'fa fa-plug',
        'plus'                 => 'fa fa-plus',
        'plus-circle'          => 'fa fa-plus-circle',
        'plus-square'          => 'fa fa-plus-square',
        'power-off'            => 'fa fa-power-off',
        'question'             => 'fa fa-question',
        'question-circle'      => 'fa fa-question-circle',
        'quote-left'           => 'fa fa-quote-left',
        'quote-right'          => 'fa fa-quote-right',
        'redo'                 => 'glyphicons glyphicons-redo',
        'refresh'              => 'fa fa-refresh',
        'repeat'               => 'fa fa-repeat',
        'retweet'              => 'glyphicons glyphicons-retweet',
        'rss'                  => 'fa fa-rss',
        'rss-square'           => 'fa fa-rss-square',
        'save'                 => 'fa fa-save',
        'scissors'             => 'glyphicons glyphicons-scissors-alt',
        'search'               => 'fa fa-search',
        'server'               => 'glyphicons glyphicons-server',
        'share'                => 'fa fa-share-alt',
        'shopping-cart'        => 'glyphicons glyphicons-shopping-cart',
        'sign-in'              => 'fa fa-sign-in',
        'sign-out'             => 'fa fa-sign-out',
        'sitemap'              => 'fa fa-sitemap',
        'sliders'              => 'fa fa-sliders',
        'sort-ascending'       => 'glyphicons glyphicons-sort-by-attributes',
        'sort-descending'      => 'glyphicons glyphicons-sort-by-attributes-alt',
        'sortable'             => 'glyphicons glyphicons-sorting',
        'square'               => 'fa fa-square',
        'square-alt'           => 'fa fa-square-o',
        'star'                 => 'fa fa-star',
        'stripe'               => 'fa-cc-stripe',
        'tag'                  => 'fa fa-tag',
        'tags'                 => 'fa fa-tags',
        'th'                   => 'fa fa-th',
        'th-large'             => 'fa fa-th-large',
        'thumbnails'           => 'glyphicons glyphicons-thumbnails',
        'times'                => 'fa fa-times',
        'times-circle'         => 'fa fa-times-circle',
        'times-square'         => 'fa fa-times-square',
        'translate'            => 'glyphicons glyphicons-translate',
        'trash'                => 'fa fa-trash',
        'truck'                => 'fa fa-truck',
        'twitter'              => 'fa fa-twitter',
        'unlock'               => 'fa fa-unlock',
        'upload'               => 'fa fa-upload',
        'usd'                  => 'fa fa-usd',
        'user'                 => 'fa fa-user',
        'users'                => 'fa fa-users',
        'video-camera'         => 'fa fa-video-camera',
        'warning'              => 'fa fa-warning',
        'wrench'               => 'fa fa-wrench',
        'youtube'              => 'fa fa-youtube',
    ];

    /**
     * Get an icon.
     *
     * @param  $icon
     * @return string
     */
    public function get($icon)
    {
        return array_get($this->icons, $icon, $icon);
    }

    /**
     * Register an icon.
     *
     * @param  string $icon
     * @param  string $value
     * @return $this
     */
    public function register($icon, $value)
    {
        array_set($this->icons, $icon, $value);

        return $this;
    }

    /**
     * Get the icons.
     *
     * @return array
     */
    public function getIcons()
    {
        return $this->icons;
    }

    /**
     * Set the icons.
     *
     * @param array $icons
     * @return $this
     */
    public function setIcons(array $icons)
    {
        $this->icons = $icons;

        return $this;
    }
}

<?php namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Class UserPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var UserInterface
     */
    protected $object;

    /**
     * Return the users name.
     *
     * @return string
     */
    public function name()
    {
        return implode(' ', array_filter([$this->object->getFirstName(), $this->object->getLastName()]));
    }

    /**
     * Return the user gravatar.
     *
     * @param  array $parameters
     * @return Image
     */
    public function gravatar($parameters = [])
    {
        /* @var Image $image */
        $image = app(Image::class);

        return $image->make(
            'https://www.gravatar.com/avatar/' . md5($this->object->getEmail()) . '?' . http_build_query(
                $parameters
            ),
            'image'
        );
    }

    /**
     * Return the user's status as a label.
     *
     * @param  string $size
     * @return null|string
     */
    public function statusLabel($size = 'sm')
    {
        $status = $this->status();
        $trans  = trans("anomaly.module.users::field.status.option.{$status}");
        $color  = 'default';

        switch ($status) {
            case 'active':
                $color = 'success';
                break;

            case 'inactive':
                $color = 'default';
                break;

            case 'disabled':
                $color = 'danger';
                break;
        }

        return "<span class=\"label label-{$size} label-{$color}\">{$trans}</span>";
    }

    /**
     * Return the status key.
     *
     * @return null|string
     */
    public function status()
    {
        if (!$this->object->isEnabled()) {
            return 'disabled';
        }

        if ($this->object->isEnabled() && !$this->object->isActivated()) {
            return 'inactive';
        }

        if ($this->object->isEnabled() && $this->object->isActivated()) {
            return 'active';
        }

        return null;
    }
}

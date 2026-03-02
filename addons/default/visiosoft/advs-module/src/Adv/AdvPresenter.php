<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\Cloudinary\CloudinaryVideoEntryModel;

class AdvPresenter extends EntryPresenter
{

    private $fileRepository;

    public function __construct($object, FileRepositoryInterface $fileRepository)
    {
        parent::__construct($object);
        $this->fileRepository = $fileRepository;
    }

    public function getViewPhotoUrl()
    {
        $item_Photo = array();
        foreach ($this->files as $image) {
            $item_Photo[] = url('files/' . $image->path);
        }
        return $item_Photo;

    }

    public function getMediumPhotoUrl($fullPhotoUrl)
    {
        $mediumPhotoUrl = pathinfo($fullPhotoUrl);
        $mediumPhotoName = 'md-' . $mediumPhotoUrl['basename'];
        if ($this->fileRepository->findBy('name', $mediumPhotoName)) {
            return $mediumPhotoUrl['dirname'] . '/' . $mediumPhotoName;
        } else {
            return $fullPhotoUrl;
        }
    }

    public function isAdVideo()
    {
        $isActiveCloudinary = is_module_installed('visiosoft.module.cloudinary');
        if ($isActiveCloudinary) {
            $cloudinaryModel = new CloudinaryVideoEntryModel();
            $adVideo = $cloudinaryModel::query()->where('adv', $this->getObject()->id)->first();
            if ($adVideo != null) {
                return $adVideo->url;
            } else {
                return null;
            }

        }
        return null;

    }

    public function getAdvsList($attributes)
    {
        if(setting_value('visiosoft.module.advs::translatable_slug')) {
            return \route('visiosoft.module.advs::list_mlang', [trans('visiosoft.module.advs::slug.category'),$attributes]);
        }
            return \route('visiosoft.module.advs::list', $attributes);
    }

    public function isCorporate()
    {
        $user_id = $this->getObject()->created_by;
        if ($user_id && $user_id->register_type !== null) {
            return $user_id->register_type;
        }

        return 1;
    }

    public function priceFormat($adv)
    {
        $advModel = new AdvModel();
        return $advModel->priceFormat($adv->getObject());
    }

	public function detailUrl()
	{
		return $this->getObject()->getAdvDetailLinkByModel($this);
	}
}

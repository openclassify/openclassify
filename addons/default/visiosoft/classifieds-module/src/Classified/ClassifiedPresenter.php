<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\Cloudinary\CloudinaryVideoEntryModel;

class ClassifiedPresenter extends EntryPresenter
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
        $isActive = new ClassifiedModel();
        $isActiveCloudinary = $isActive->is_enabled('cloudinary');
        if ($isActiveCloudinary) {
            $cloudinaryModel = new CloudinaryVideoEntryModel();
            $adVideo = $cloudinaryModel::query()->where('classified', $this->getObject()->id)->first();
            if ($adVideo != null) {
                return $adVideo->url;
            } else {
                return null;
            }

        }
        return null;

    }

    public function getClassifiedsList($attributes)
    {
        return \route('visiosoft.module.classifieds::list', $attributes);
    }

    public function isCorporate()
    {
        $user_id = $this->getObject()->created_by;
        if ($user_id->register_type != null) {
            return $user_id->register_type;
        } else {
            return 1;
        }

    }

    public function priceFormat($classified)
    {
        $classifiedModel = new ClassifiedModel();
        return $classifiedModel->priceFormat($classified->getObject());
    }

	public function detailUrl()
	{
		return $this->getObject()->getClassifiedDetailLinkByModel($this);
	}
}

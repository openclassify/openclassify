<?php namespace Visiosoft\ProfileModule\Adress\Command;


use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;

class GetAddressByUser
{

    /**
     * @var $id
     */
    protected $id;

    /**
     * GetProduct constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param AdressRepositoryInterface $adressRepository
     * @return \Anomaly\Streams\Platform\Model\EloquentModel|null
     */
    public function handle(AdressRepositoryInterface $adressRepository)
    {
        if ($this->id) {
            return $adressRepository->findByUser($this->id);
        }
        return null;
    }
}

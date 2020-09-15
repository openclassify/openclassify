<?php namespace Visiosoft\ProfileModule\Adress\Command;


use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;

class GetAddressByUser
{

    /**
     * @var $userId
     */
    protected $userId;

    /**
     * GetProduct constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param AdressRepositoryInterface $adressRepository
     * @return \Anomaly\Streams\Platform\Model\EloquentModel|null
     */
    public function handle(AdressRepositoryInterface $adressRepository)
    {
        if ($this->userId) {
            return $adressRepository->getUserAddresses($this->userId);
        }
        return null;
    }
}

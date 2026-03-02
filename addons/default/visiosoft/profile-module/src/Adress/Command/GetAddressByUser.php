<?php namespace Visiosoft\ProfileModule\Adress\Command;

use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;

class GetAddressByUser
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(AdressRepositoryInterface $addressRepository)
    {
        if ($this->id) {
            return $addressRepository->findByUser($this->id);
        }

        return null;
    }
}

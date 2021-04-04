<?php namespace Visiosoft\ProfileModule\Adress\Command;

use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;

class GetAddress
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(AdressRepositoryInterface $addressRepository)
    {
        if ($this->id) {
            return $addressRepository->find($this->id);
        }

        return null;
    }
}

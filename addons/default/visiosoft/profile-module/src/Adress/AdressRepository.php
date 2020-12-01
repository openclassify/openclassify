<?php namespace Visiosoft\ProfileModule\Adress;

use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class AdressRepository extends EntryRepository implements AdressRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var AdressModel
     */
    protected $model;

    /**
     * Create a new AdressRepository instance.
     *
     * @param AdressModel $model
     */
    public function __construct(AdressModel $model)
    {
        $this->model = $model;
    }

    public function findByUser($user_id)
    {
        return $this->newQuery()->where('user_id', $user_id)->get();
    }

    public function createAddress($name, $user_id, $first_name, $last_name, $country_id, $city_id, $content, $gsm_phone)
    {
        return $this->create([
            'adress_name' => $name,
            'user_id' => $user_id,
            'adress_first_name' => $first_name,
            'adress_last_name' => $last_name,
            'country_id' => $country_id,
            'city' => $city_id,
            'adress_content' => $content,
            'adress_gsm_phone' => $gsm_phone,
        ]);
    }
}

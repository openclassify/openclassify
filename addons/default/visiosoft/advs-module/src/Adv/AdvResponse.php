<?php namespace Visiosoft\AdvsModule\Adv;
/**
 * Created by PhpStorm.
 * User: emek
 * Date: 13.12.2018
 * Time: 17:54
 */

use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Illuminate\Routing\ResponseFactory;

class AdvResponse {
    protected $container;

    function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    public function make(AdvInterface $adv) {
        if (!$adv->getResponse()) {

            $response = $this->response->view(
                'visiosoft.theme.base::ad-detail/detail',
                [
                    'adv'    => $adv,
                ]
            );

            if (!$adv->is_active()) {
                $response->setTtl(0);
            }

            $adv->setResponse($response);
        }
    }
}
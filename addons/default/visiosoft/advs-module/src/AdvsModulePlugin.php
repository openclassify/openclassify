<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Twig_Environment;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;
use Visiosoft\AdvsModule\Adv\Command\GetAd;
use Visiosoft\AdvsModule\Adv\Command\GetListingLocation;
use Visiosoft\AdvsModule\Adv\Command\getPopular;
use Visiosoft\AdvsModule\Adv\Command\GetUserAds;
use Visiosoft\AdvsModule\Adv\Command\LatestAds;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Support\Command\Currency;

class AdvsModulePlugin extends Plugin
{

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'adDetail',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetAd($id))) {
                        return null;
                    }

                    return $ad;
                }
            ), new \Twig_SimpleFunction(
                'latestAds',
                function () {
                    if (!$latestAds = $this->dispatchSync(new LatestAds())) {
                        return 0;
                    }
                    return $latestAds;
                }
            ),
	        new \Twig_SimpleFunction(
	            'bestsellerAds',
		        function ($catId = null, $limit = 10) {
	            	return app(AdvRepositoryInterface::class)->bestsellerAds($catId, $limit);
		        }
	        ),
            new \Twig_SimpleFunction(
                'appendRequestURL',
                function ($request, $url, $new_parameters, $removeParams = []) {
                    return $this->dispatchSync(new appendRequestURL($request, $url, $new_parameters, $removeParams));
                }
            ),
            new \Twig_SimpleFunction(
                'getUserAllAdvs',
                function ($user = null) {
                    if (!$user) {
                        $user = auth()->user();
                    }

                    $advModel = new AdvModel();
                    return $advModel->newQuery()
                        ->where('advs_advs.created_by_id', $user->id)
                        ->get();
                }
            ),
            new \Twig_SimpleFunction(
                'getUserAds',
                function ($userID = null, $status = "approved") {
                    return $this->dispatchSync(new GetUserAds($userID, $status));
                }
            ),
            new \Twig_SimpleFunction(
                'getListingLocation',
                function ($locationInfo, $currentAdv) {
                    return $this->dispatchSync(new GetListingLocation($locationInfo, $currentAdv));
                }
            ),
            new \Twig_SimpleFunction(
                'getUserPassiveAdvs',
                function ($user = null) {
                    if (!$user) {
                        $user = auth()->user();
                    }

                    $advModel = new AdvModel();

                    return $advModel->pendingAdvsByUser()->get();
                }
            ),
            new \Twig_SimpleFunction(
                'fn',
                function (Twig_Environment $twig, $name, ...$args) {
                    $fn = $twig->getFunction($name);

                    if ($fn === false) {
                        return null;
                    }

                    return $fn->getCallable()(...$args);
                }, ['needs_environment' => true]
            ), new \Twig_SimpleFunction(
                'getPopular',
                function () {
                    if (!$popular = $this->dispatchSync(new getPopular())) {
                        return null;
                    }
                    return $popular;
                }
            ),
            new \Twig_SimpleFunction(
                'currency_*',
                function ($name) {
                    return call_user_func_array(
                        [app(Currency::class), camel_case($name)],
                        array_slice(func_get_args(), 1)
                    );
                }
            ),
            new \Twig_SimpleFunction(
                'getByCat',
                function ($catID = null,$level = '1', $limit = 12) {
                    return app(AdvRepositoryInterface::class)->getByCat($catID,$level, $limit);
                }
            ),
        ];
    }

    /**
     * Get the filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'ksort',
                function ($array) {
                    if ($array) {
                        ksort($array);
                        return $array;
                    }
                    return null;
                }
            ),
        ];
    }
}

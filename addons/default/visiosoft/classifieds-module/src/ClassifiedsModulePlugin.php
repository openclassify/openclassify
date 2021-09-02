<?php namespace Visiosoft\ClassifiedsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Twig_Environment;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Visiosoft\ClassifiedsModule\Classified\Command\appendRequestURL;
use Visiosoft\ClassifiedsModule\Classified\Command\GetAd;
use Visiosoft\ClassifiedsModule\Classified\Command\getPopular;
use Visiosoft\ClassifiedsModule\Classified\Command\GetUserClassifieds;
use Visiosoft\ClassifiedsModule\Classified\Command\isActive;
use Visiosoft\ClassifiedsModule\Classified\Command\LatestClassifieds;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Support\Command\Currency;

class ClassifiedsModulePlugin extends Plugin
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

                    if (!$classified = $this->dispatch(new GetAd($id))) {
                        return null;
                    }

                    return $classified;
                }
            ), new \Twig_SimpleFunction(
                'isActive',
                function ($name, $type = 'module', $project = 'visiosoft') {

                    if (!$isActive = $this->dispatch(new isActive($name, $type, $project))) {
                        return 0;
                    }

                    return $isActive;
                }
            ), new \Twig_SimpleFunction(
                'latestClassifieds',
                function () {
                    if (!$latestClassifieds = $this->dispatch(new LatestClassifieds())) {
                        return 0;
                    }
                    return $latestClassifieds;
                }
            ),
	        new \Twig_SimpleFunction(
	            'bestsellerClassifieds',
		        function ($catId = null, $limit = 10) {
	            	return app(ClassifiedRepositoryInterface::class)->bestsellerClassifieds($catId, $limit);
		        }
	        ),
            new \Twig_SimpleFunction(
                'appendRequestURL',
                function ($request, $url, $new_parameters, $removeParams = []) {
                    return $this->dispatch(new appendRequestURL($request, $url, $new_parameters, $removeParams));
                }
            ),
            new \Twig_SimpleFunction(
                'getUserAllClassifieds',
                function ($user = null) {
                    if (!$user) {
                        $user = auth()->user();
                    }

                    $classifiedModel = new ClassifiedModel();
                    return $classifiedModel->newQuery()
                        ->where('classifieds_classifieds.created_by_id', $user->id)
                        ->get();
                }
            ),
            new \Twig_SimpleFunction(
                'getUserClassifieds',
                function ($userID = null, $status = "approved") {
                    return $this->dispatch(new GetUserClassifieds($userID, $status));
                }
            ),
            new \Twig_SimpleFunction(
                'getUserPassiveClassifieds',
                function ($user = null) {
                    if (!$user) {
                        $user = auth()->user();
                    }

                    $classifiedModel = new ClassifiedModel();

                    return $classifiedModel->pendingClassifiedsByUser()->get();
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
                    if (!$popular = $this->dispatch(new getPopular())) {
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
	        	'is_module_enabled',
		        function ($slug) {
	        		return app(ClassifiedModel::class)->is_enabled($slug);
		        }
	        )
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

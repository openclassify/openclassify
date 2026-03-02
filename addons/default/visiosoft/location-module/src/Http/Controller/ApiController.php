<?php namespace Visiosoft\LocationModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\ResourceController;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class ApiController extends ResourceController
{
    protected $responseSchema = [
        'success' => true,
        'response' => [],
        'message' => '',
        'error_code' => 0
    ];

    public function cities(CityRepositoryInterface $cities)
    {
        try {
            $limit = $this->request->has('limit') ? $this->request->get('limit') : null;
            $countryId = $this->request->has('country') ? $this->request->get('country') : null;
            $entries = $cities->getCitiesApi($countryId, $limit);

            $schema = $this->responseSchema;
            $schema['response'] = $entries;

            return $this->response->json($schema, 200);
        } catch (\Exception $exception) {
            $schema = $this->responseSchema;
            $schema['success'] = false;
            $schema['message'] = trans('streams::error.500.name');
            $schema['error_code'] = 500;

            if (config('app.debug')) {
                $schema['message'] = $exception->getMessage() . ' LINE: ' . $exception->getLine();
                $schema['response'] = $exception->getTrace();
            }
            return response($schema, 500);
        }
    }
}

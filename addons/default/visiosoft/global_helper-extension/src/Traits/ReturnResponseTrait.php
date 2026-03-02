<?php

namespace Visiosoft\GlobalHelperExtension\Traits;
use Illuminate\Http\JsonResponse;

trait ReturnResponseTrait
{
    protected array $output = [
        'success' => true,
        'data' => [],
        'message' => '',
    ];

    /**
     * @param $data
     * @param bool $success
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendResponse($data = [], string $message = '', bool $success = true, int $statusCode = 200): JsonResponse
    {
        if (request()->method() == 'POST') {
            $statusCode = 201;
        }
        $this->output['success'] = $success;
        $this->output['data'] = $data;
        $this->output['message'] = $message;
        return $this->setResponse($this->output, $statusCode);
    }

    /**
     * @param array $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendError($errors = [], string $message = '', int $statusCode = 404): JsonResponse
    {
        $this->output['success'] = false;
        $this->output['errors'] = $errors;
        $this->output['message'] = $message;
        return $this->setResponse($this->output, $statusCode);
    }

    /**
     * @param $e
     * @param $statusCode
     * @return JsonResponse
     */
    public function sendExceptionError($e, $statusCode = 500): JsonResponse
    {
        $message = 'internal error';
        if (config('app.debug')) {
            $message = $e->getMessage() . ' LINE:' . $e->getLine();
        }
        $this->output['success'] = false;
        $this->output['message'] = $message;
        return $this->setResponse($this->output, $statusCode);
    }

    /**
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    private function setResponse(array $data = [], int $code = 200): JsonResponse
    {
        return response()->json($data, $code);
    }
}
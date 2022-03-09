<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Response;
use SimpleXMLElement;

/**
 * Class MakeXmlResponse
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class MakeXmlResponse
{

    /**
     * The response factory.
     *
     * @var null|ResponseFactory
     */
    protected $response = null;

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResourceFormattersCommand instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResponseFactory $response
     */
    public function handle(ResponseFactory $response)
    {
        $this->setResponse($response);

        $data = $this->builder->getResourceData();

        return $this->xml(json_decode(json_encode($data->all()), true));
    }

    /**
     * @param array $vars
     * @param int   $status
     * @param array $header
     * @param null  $xml
     * @return Response
     */
    public function xml(array $vars, $status = 200, array $header = [], $rootElement = 'response', $xml = null)
    {
        if (is_object($vars) && $vars instanceof Arrayable) {
            $vars = $vars->toArray();
        }

        if (is_null($xml)) {
            $xml = new SimpleXMLElement('<' . $rootElement . '/>');
        }

        foreach ($vars as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $this->xml(
                        $value,
                        $status,
                        $header,
                        $rootElement,
                        $xml->addChild(str_singular($xml->getName()))
                    );
                } else {
                    $this->xml($value, $status, $header, $rootElement, $xml->addChild($key));
                }
            } else {
                $xml->addChild($key, $value);
            }
        }

        if (empty($header)) {
            $header['Content-Type'] = 'application/xml';
        }

        return $this->response->make($xml->asXML(), $status, $header);
    }

    /**
     * Set the response.
     *
     * @param ResponseFactory $response
     * @return $this
     */
    public function setResponse(ResponseFactory $response)
    {
        $this->response = $response;

        return $this;
    }
}

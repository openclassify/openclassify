<?php namespace Barryvdh\StackMiddleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ClosureHttpKernel implements HttpKernelInterface
{
    /** @var callable $closure */
    protected $closure;

    /**
     * @param callable $closure
     */
    public function setClosure(callable $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @param Request $request A Request instance
     * @param int     $type
     * @param bool    $catch
     *
     * @return Response A Response instance
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true): Response
    {
        $closure = $this->closure;

        return $closure($request);
    }
}

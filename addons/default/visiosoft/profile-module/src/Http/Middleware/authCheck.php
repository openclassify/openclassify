<?php namespace Visiosoft\ProfileModule\Http\Middleware;

use Anomaly\FilesModule\File\Command\GetFile;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class authCheck
{
    use DispatchesJobs;

    private $auth;
    private $request;
    private $template;

    public function __construct(Guard $auth,Request $request, ViewTemplate $template)
    {
        $this->auth = $auth;
        $this->request = $request;
        $this->template = $template;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->check()) {
            return redirect($this->request->get('redirect', '/'));
        }

        if (($ogImage = session()->get('ogImage')) && ($file = $this->dispatch(new GetFile($ogImage)))) {
            $this->template->set(
                'og_image',
                $file->make()->url()
            );
        }

        return $next($request);
    }
}

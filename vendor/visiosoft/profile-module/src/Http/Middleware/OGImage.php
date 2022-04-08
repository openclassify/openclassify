<?php namespace Visiosoft\ProfileModule\Http\Middleware;

use Anomaly\FilesModule\File\Command\GetFile;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class OGImage
{
    use DispatchesJobs;

    private $template;

    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    public function handle(Request $request, Closure $next)
    {
        if (($ogImage = session()->get('ogImage')) && ($file = $this->dispatch(new GetFile($ogImage)))) {
            $this->template->set(
                'og_image',
                $file->make()->url()
            );
        }

        return $next($request);
    }
}

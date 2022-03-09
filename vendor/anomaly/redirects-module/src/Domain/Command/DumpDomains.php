<?php namespace Anomaly\RedirectsModule\Domain\Command;

use Anomaly\RedirectsModule\Domain\Contract\DomainInterface;
use Anomaly\RedirectsModule\Domain\Contract\DomainRepositoryInterface;

/**
 * Class DumpDomains
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DumpDomains
{

    /**
     * Handle the command.
     *
     * @param DomainRepositoryInterface $domains
     */
    public function handle(DomainRepositoryInterface $domains)
    {
        $file = app_storage_path('redirects/domains.php');

        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        $content = join(
            ",",
            array_map(
                function (DomainInterface $domain) {

                    $secure = $domain->isSecure() ? 'true' : 'false';

                    return "'{$domain->getFrom()}' => ['to' => '{$domain->getTo()}', 'status' => {$domain->getStatus()}, 'secure' => {$secure}]";
                },
                $domains->all()->all()
            )
        );

        file_put_contents($file, "<?php\n\n return [$content];");
    }
}

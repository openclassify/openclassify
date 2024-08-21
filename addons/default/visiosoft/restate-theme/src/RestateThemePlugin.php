<?php namespace Visiosoft\RestateTheme;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldRepository;
use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueRepository;
use Visiosoft\RestateTheme\Handler\pagesFindBySlug;

class RestateThemePlugin extends Plugin
{
    protected $customfieldRepository;
    protected $cfvalueRepository;

    public function __construct(CustomFieldRepositoryInterface $customfieldRepository, CfvalueRepositoryInterface $cfvalueRepository)
    {
        $this->customfieldRepository = $customfieldRepository;
        $this->cfvalueRepository = $cfvalueRepository;
    }
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction(
                'pagesFindBySlug',
                function ($slug) {
                    return $this->dispatch(new pagesFindBySlug($slug));
                }
            ),
            new \Twig\TwigFunction(
                'getCustomFieldById',
                function ($id) {
                    $customField = $this->customfieldRepository->findBy('id',$id);
                    if ($customField && $cfValues = $customField->cfvalues()->get()){
                        return ["id" => $customField->id, "name" => $customField->name, "values" => $cfValues->toArray()];
                    }
                    return null;
                }
            ),
        ];
    }
}

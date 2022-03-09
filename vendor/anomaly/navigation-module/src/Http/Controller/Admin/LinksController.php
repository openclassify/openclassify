<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\Entry\EntryFormBuilder;
use Anomaly\NavigationModule\Link\Form\LinkFormBuilder;
use Anomaly\NavigationModule\Link\Tree\LinkTreeBuilder;
use Anomaly\NavigationModule\Link\Type\LinkTypeExtension;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class LinksController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinksController extends AdminController
{

    /**
     * Return an index of existing links.
     *
     * @param  LinkTreeBuilder $tree
     * @param  MenuRepositoryInterface $menus
     * @param  null $menu
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(LinkTreeBuilder $tree, MenuRepositoryInterface $menus, $menu = null)
    {
        if (!$menu) {

            $this->messages->warning('Please choose a menu first.');

            return $this->response->redirectTo('admin/navigation');
        }

        $tree->setMenu($menu = $menus->findBySlug($menu));

        return $tree->render();
    }

    /**
     * Return the modal for choosing a link type.
     *
     * @param  ExtensionCollection $extensions
     * @param  string $menu
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions, $menu)
    {
        return view(
            'module::ajax/choose_link_type',
            [
                'link_types' => $extensions
                    ->search('anomaly.module.navigation::link_type.*')
                    ->enabled(),
                'menu'       => $menu,
            ]
        );
    }

    /**
     * Change the link type.
     *
     * @param  LinkRepositoryInterface $links
     * @param ExtensionCollection $extensions
     * @param $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(LinkRepositoryInterface $links, ExtensionCollection $extensions, $menu)
    {
        /* @var LinkInterface $link */
        $link = $links->find($this->route->parameter('id'));

        return view(
            'module::ajax/change_link_type',
            [
                'link_types' => $extensions
                    ->search('anomaly.module.navigation::link_type.*')
                    ->enabled(),
                'link'       => $link,
                'menu'       => $menu,
            ]
        );
    }

    /**
     * Return the form for creating a new link.
     *
     * @param  LinkFormBuilder $link
     * @param  EntryFormBuilder $form
     * @param  LinkRepositoryInterface $links
     * @param  MenuRepositoryInterface $menus
     * @param  ExtensionCollection $extensions
     * @param                                             $menu
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        LinkFormBuilder $link,
        EntryFormBuilder $form,
        LinkRepositoryInterface $links,
        MenuRepositoryInterface $menus,
        ExtensionCollection $extensions,
        $menu
    ) {
        /* @var LinkTypeExtension $type */
        $type = $extensions->get($this->request->get('link_type'));

        /* @var LinkInterface $parent */
        if ($parent = $links->find($this->request->get('parent'))) {
            $link->setParent($parent);
        }

        $form->addForm('type', $type->builder());
        $form->addForm('link', $link->setType($type)->setMenu($menu = $menus->findBySlug($menu)));

        $this->breadcrumbs->add($menu->getName(), 'admin/navigation/links/' . $menu->getSlug());

        return $form->render();
    }

    /**
     * Return the form for editing an existing link.
     *
     * @param  LinkFormBuilder $link
     * @param  EntryFormBuilder $form
     * @param  LinkRepositoryInterface $links
     * @param  MenuRepositoryInterface $menus
     * @param ExtensionCollection $extensions
     * @param $menu
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        LinkFormBuilder $link,
        EntryFormBuilder $form,
        LinkRepositoryInterface $links,
        MenuRepositoryInterface $menus,
        ExtensionCollection $extensions,
        $slug,
        $id
    ) {
        /* @var LinkInterface $entry */
        $entry = $links->find($id);

        $type = $entry->getType();

        $typeEntry = $entry->getEntry();

        $form->addForm('type', $type->builder()->setEntry($typeEntry ? $typeEntry->id : null));

        $form->addForm(
            'link',
            $link->setEntry($id)->setType($entry->getType())->setMenu($menu = $menus->findBySlug($slug))
        );

        $this->breadcrumbs->add($menu->getName(), 'admin/navigation/links/' . $menu->getSlug());

        /**
         * If the link is changing types then
         * reset some configuration here for it.
         *
         * @var LinkTypeExtension $type
         */
        if ($extension = $extensions->get($this->request->get('link_type'))) {
            $link->setType($extension);
            $form->addForm('type', $extension->builder()->setFormMode('edit'));
            $form->setOption('redirect', 'admin/navigation/links/' . $slug . '/edit/' . $id);
        }

        return $form->render();
    }

    /**
     * View the link destination.
     *
     * @param  LinkRepositoryInterface $links
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(LinkRepositoryInterface $links)
    {
        /* @var LinkInterface $link */
        $link = $links->find($this->route->parameter('id'));

        return $this->response->redirectTo($link->getUrl());
    }

    /**
     * Delete a link and go back.
     *
     * @param  LinkRepositoryInterface $links
     * @param  Authorizer $authorizer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(LinkRepositoryInterface $links, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.navigation::links.delete')) {

            $this->messages->error('streams::message.access_denied');

            return $this->redirect->back();
        }

        /*
         * Force delete until we get
         * views into the tree UI.
         */
        $links->forceDelete($links->find($this->route->parameter('id')));

        return $this->redirect->back();
    }
}

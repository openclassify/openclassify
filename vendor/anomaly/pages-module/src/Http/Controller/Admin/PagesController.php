<?php namespace Anomaly\PagesModule\Http\Controller\Admin;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\Form\Command\AddEntryFormFromPage;
use Anomaly\PagesModule\Page\Form\Command\AddEntryFormFromRequest;
use Anomaly\PagesModule\Page\Form\Command\AddPageFormFromPage;
use Anomaly\PagesModule\Page\Form\Command\AddPageFormFromRequest;
use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;
use Anomaly\PagesModule\Page\Form\PageFormBuilder;
use Anomaly\PagesModule\Page\Table\PageTableBuilder;
use Anomaly\PagesModule\Page\Tree\PageTreeBuilder;
use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Routing\Redirector;

/**
 * Class PagesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesController extends AdminController
{

    /**
     * Return a table/tree of existing pages.
     *
     * @param PageTreeBuilder $tree
     * @param PageTableBuilder $table
     * @param PreferenceRepositoryInterface $preferences
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function index(
        PageTreeBuilder $tree,
        PageTableBuilder $table,
        PreferenceRepositoryInterface $preferences
    ) {
        if ($preferences->value('anomaly.module.pages::page_view', 'tree') == 'table') {
            return $table->render();
        }

        return $tree->render();
    }

    /**
     * Change the pages view.
     *
     * @param PreferenceRepositoryInterface $preferences
     * @param                               $view
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(PreferenceRepositoryInterface $preferences, $view)
    {
        $preferences->set('anomaly.module.pages::page_view', $view);

        return $this->redirect->back();
    }

    /**
     * Return the form for creating a new page.
     *
     * @param  PageEntryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PageEntryFormBuilder $form, PageRepositoryInterface $pages)
    {
        $this->dispatch(new AddEntryFormFromRequest($form));
        $this->dispatch(new AddPageFormFromRequest($form));

        /* @var PageInterface $parent */
        if ($parent = $pages->find($this->request->get('parent'))) {

            /* @var PageFormBuilder $pageForm */
            $pageForm = $form->getChildForm('page');

            $pageForm->setParent($parent);
        }

        return $form->render();
    }

    /**
     * Return the form for editing an existing page.
     *
     * @param  PageRepositoryInterface $pages
     * @param  PageEntryFormBuilder $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PageRepositoryInterface $pages, PageEntryFormBuilder $form, $id)
    {
        /* @var PageInterface $page */
        $page = $pages->find($id);

        $this->dispatch(new AddPageFormFromPage($form, $page)); // First
        $this->dispatch(new AddEntryFormFromPage($form, $page)); // Second

        return $form->render($page);
    }

    /**
     * Redirect to a page's URL.
     *
     * @param  PageRepositoryInterface $pages
     * @param  Redirector $redirect
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(PageRepositoryInterface $pages, Redirector $redirect, $id)
    {
        /* @var PageInterface $page */
        $page = $pages->find($id);

        if (!$page->isLive()) {
            return $redirect->to('pages/preview/' . $page->getStrId());
        }

        if ($page->isHome()) {
            return $redirect->to('/');
        }

        return $redirect->to($page->getPath());
    }

    /**
     * Delete a page and go back.
     *
     * @param  PageRepositoryInterface $pages
     * @param  Authorizer $authorizer
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(PageRepositoryInterface $pages, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.delete')) {

            $this->messages->error('streams::message.access_denied');

            return $this->redirect->back();
        }

        $pages->delete($page = $pages->find($id));

        $page->entry->delete();

        return redirect()->back();
    }
}

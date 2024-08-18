<?php namespace Visiosoft\CommentsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Comments\CommentsCommentsEntryModel;
use Illuminate\Routing\Router;
use Visiosoft\CommentsModule\Comment\CommentModel;
use Visiosoft\CommentsModule\Comment\CommentRepository;
use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;
use Visiosoft\CommentsModule\Comment\Events\CreateNewComment;
use Visiosoft\CommentsModule\Comment\Listener\SaveComment;

class CommentsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        CommentsModulePlugin::class
    ];

    protected $routes = [
        'admin/comments' => 'Visiosoft\CommentsModule\Http\Controller\Admin\CommentsController@index',
        'admin/comments/create' => 'Visiosoft\CommentsModule\Http\Controller\Admin\CommentsController@create',
        'admin/comments/edit/{id}' => 'Visiosoft\CommentsModule\Http\Controller\Admin\CommentsController@edit',
        'comments/edit/{id}' => 'Visiosoft\CommentsModule\Http\Controller\Admin\CommentsController@edit',
        'comments/save_comment' => [
            'as' => 'comments::save_comment',
            'uses' => 'Visiosoft\CommentsModule\Http\Controller\CommentsController@saveComment',
        ],
        'admin/comments/status/{id},{type}' => 'Visiosoft\CommentsModule\Http\Controller\Admin\CommentsController@status',

        // Admin ReportController
        'admin/api/comments/report/product' => 'Visiosoft\CommentsModule\Http\Controller\Admin\ReportController@product',
        'admin/api/comments/report/comment' => 'Visiosoft\CommentsModule\Http\Controller\Admin\ReportController@comment',
    ];

    protected $routeMiddleware = [];

    protected $listeners = [
        CreateNewComment::class => [
            SaveComment::class
        ],
    ];

    protected $bindings = [
        CommentsCommentsEntryModel::class => CommentModel::class,
    ];

    protected $singletons = [
        CommentRepositoryInterface::class => CommentRepository::class,
    ];
}

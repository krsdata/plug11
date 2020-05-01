<?php

    Route::get('admin/forgot-password', 'Modules\Admin\Http\Controllers\AuthController@forgetPassword');
    Route::post('password/email', 'Modules\Admin\Http\Controllers\AuthController@sendResetPasswordLink');
    Route::get('admin/password/reset', 'Modules\Admin\Http\Controllers\AuthController@resetPassword');
    Route::get('admin/logout', 'Modules\Admin\Http\Controllers\AuthController@logout');
    Route::get('admin/login', 'Modules\Admin\Http\Controllers\AuthController@index');

    Route::post('admin/blog/ajax', 'Modules\Admin\Http\Controllers\BlogController@ajax');
    Route::get('admin/error', 'Modules\Admin\Http\Controllers\PageController@error');
    Route::post('admin/login', function (App\Admin $user) {

        $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')];

        $admin_auth = auth()->guard('admin');
        $user_auth =  auth()->guard('web'); //Auth::attempt($credentials);

        if ($admin_auth->attempt($credentials) or $user_auth->attempt($credentials)) {
            return Redirect::to('admin');
        } else {
            return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['message'=>'Invalid email or password. Try again!']);
        }
    });


    Route::get('admin/supportTicket', 'Modules\Admin\Http\Controllers\ArticleTypeController@supportTicket')->name('supportTicket');

    Route::post('admin/supportTicket', 'Modules\Admin\Http\Controllers\ArticleTypeController@supportTicketAddreply')->name('supportTicket');


    Route::group(['middleware' => ['admin']], function () {

        Route::get('admin', 'Modules\Admin\Http\Controllers\AdminController@index');
        /*------------User Model and controller---------*/
        
        Route::post('login', [ 'as' => 'custom.login', 'uses' => 'FrontEndController@login']);


        Route::match(['get','post'],'admin/bankAccount', 
            [ 
                'as' => 'bankAccount', 
                'uses' => 'Modules\Admin\Http\Controllers\DocumentController@bankAccount'
            ]
        );

        Route::bind('documents', function ($value, $route) {
            return Modules\Admin\Models\Document::find($value);
        });

        Route::resource(
            'admin/documents',
            'Modules\Admin\Http\Controllers\DocumentController',
            [
                'names' => [
                    'edit'      => 'documents.edit',
                    'show'      => 'documents.show',
                    'destroy'   => 'documents.destroy',
                    'update'    => 'documents.update',
                    'store'     => 'documents.store',
                    'index'     => 'documents',
                    'create'    => 'documents.create',
                ]
                    ]
        );

        Route::bind('updatePlayerPoints', function ($value, $route) {
            return Modules\Admin\Models\UpdatePlayerPoints::find($value);
        });
        Route::resource(
            'admin/updatePlayerPoints',
            'Modules\Admin\Http\Controllers\UpdatePlayerPointsController',
            [
            'names' => [
                'edit' => 'updatePlayerPoints.edit',
                'show' => 'updatePlayerPoints.show',
                'destroy' => 'updatePlayerPoints.destroy',
                'update' => 'updatePlayerPoints.update',
                'store' => 'updatePlayerPoints.store',
                'index' => 'updatePlayerPoints',
                'create' => 'updatePlayerPoints.create',
            ]
                ]
        );
        //wallets
         Route::bind('wallets', function ($value, $route) {
            return Modules\Admin\Models\Wallets::find($value);
        });
        Route::resource(
            'admin/wallets',
            'Modules\Admin\Http\Controllers\WalletsController',
            [
                'names' => [
                    'edit' => 'wallets.edit',
                    'show' => 'wallets.show',
                    'destroy' => 'wallets.destroy',
                    'update' => 'wallets.update',
                    'store' => 'wallets.store',
                    'index' => 'wallets',
                    'create' => 'wallets.create',
                ]
            ]
        );
        // Prize distribution
        Route::bind('prizeDistribution', function ($value, $route) {
            return Modules\Admin\Models\UpdatePlayerPoints::find($value);
        });
        Route::resource(
            'admin/prizeDistribution',
            'Modules\Admin\Http\Controllers\PrizeDistributionController',
            [
                'names' => [
                    'edit' => 'prizeDistribution.edit',
                    'show' => 'prizeDistribution.show',
                    'destroy' => 'prizeDistribution.destroy',
                    'update' => 'prizeDistribution.update',
                    'store' => 'prizeDistribution.store',
                    'index' => 'prizeDistribution',
                    'create' => 'prizeDistribution.create',
                ]
            ]
        );


        Route::bind('user', function ($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource(
            'admin/user',
            'Modules\Admin\Http\Controllers\UsersController',
            [
            'names' => [
                'edit' => 'user.edit',
                'show' => 'user.show',
                'destroy' => 'user.destroy',
                'update' => 'user.update',
                'store' => 'user.store',
                'index' => 'user',
                'create' => 'user.create',
            ]
                ]
        );

        Route::bind('errorLog', function ($value, $route) {
            return Modules\Admin\Models\ErrorLog::find($value);
        });

        Route::resource(
            'admin/errorLog',
            'Modules\Admin\Http\Controllers\ErrorLogController',
            [
            'names' => [
                'edit' => 'errorLog.edit',
                'show' => 'errorLog.show',
                'destroy' => 'errorLog.destroy',
                'update' => 'errorLog.update',
                'store' => 'errorLog.store',
                'index' => 'errorLog',
                'create' => 'errorLog.create',
            ]
                ]
        );


        Route::bind('menu', function ($value, $route) {
            return Modules\Admin\Models\Menu::find($value);
        });

        Route::resource(
            'admin/menu',
            'Modules\Admin\Http\Controllers\MenuController',
            [
            'names' => [
                'edit' => 'menu.edit',
                'show' => 'menu.show',
                'destroy' => 'menu.destroy',
                'update' => 'menu.update',
                'store' => 'menu.store',
                'index' => 'menu',
                'create' => 'menu.create',
            ]
                ]
        );

        Route::bind('apkUpdate', function ($value, $route) {
            return Modules\Admin\Models\ApkUpdate::find($value);
        });

        Route::resource(
            'admin/apkUpdate',
            'Modules\Admin\Http\Controllers\ApkUpdateController',
            [
            'names' => [
                'edit' => 'apkUpdate.edit',
                'show' => 'apkUpdate.show',
                'destroy' => 'apkUpdate.destroy',
                'update' => 'apkUpdate.update',
                'store' => 'apkUpdate.store',
                'index' => 'apkUpdate',
                'create' => 'apkUpdate.create',
            ]
                ]
        );

        Route::resource(
            'admin/clientuser',
            'Modules\Admin\Http\Controllers\ClientUsersController',
            [
            'names' => [
                'edit' => 'clientuser.edit',
                'show' => 'clientuser.show',
                'destroy' => 'clientuser.destroy',
                'update' => 'clientuser.update',
                'store' => 'clientuser.store',
                'index' => 'clientuser',
                'create' => 'clientuser.create',
            ]
                ]
        );



        /*------------User Category and controller---------*/

        Route::bind('category', function ($value, $route) {
            return Modules\Admin\Models\Category::find($value);
        });

        Route::resource(
            'admin/category',
            'Modules\Admin\Http\Controllers\CategoryController',
            [
                'names' => [
                    'edit'      => 'category.edit',
                    'show'      => 'category.show',
                    'destroy'   => 'category.destroy',
                    'update'    => 'category.update',
                    'store'     => 'category.store',
                    'index'     => 'category',
                    'create'    => 'category.create',
                ]
                    ]
        );
        /*---------End---------*/

        Route::bind('banner', function ($value, $route) {
            return Modules\Admin\Models\Banner::find($value);
        });

        Route::resource(
            'admin/banner',
            'Modules\Admin\Http\Controllers\BannerController',
            [
                'names' => [
                    'edit'      => 'banner.edit',
                    'show'      => 'banner.show',
                    'destroy'   => 'banner.destroy',
                    'update'    => 'banner.update',
                    'store'     => 'banner.store',
                    'index'     => 'banner',
                    'create'    => 'banner.create',
                ]
                    ]
        );


        /*---------Contact Route ---------*/

        Route::bind('contestType', function ($value, $route) {
            return Modules\Admin\Models\ContestType::find($value);
        });

        Route::resource(
            'admin/contestType',
            'Modules\Admin\Http\Controllers\ContestTypeController',
            [
            'names' => [
                'edit' => 'contestType.edit',
                'show' => 'contestType.show',
                'destroy' => 'contestType.destroy',
                'update' => 'contestType.update',
                'store' => 'contestType.store',
                'index' => 'contestType',
                'create' => 'contestType.create',
            ]
                ]
        );

        Route::get(
            'admin/match/triggerEmail',
            'Modules\Admin\Http\Controllers\MatchController@triggerEmail')->name('triggerEmail');

        Route::bind('match', function ($value, $route) {
            return App\Models\Match::find($value);
        });

        Route::resource(
            'admin/match',
            'Modules\Admin\Http\Controllers\MatchController',
            [
            'names' => [
                'edit' => 'match.edit',
                'show' => 'match.show',
                'destroy' => 'match.destroy',
                'update' => 'match.update',
                'store' => 'match.store',
                'index' => 'match',
                'create' => 'match.create',
            ]
                ]
        );

        Route::get('admin/comment/showComment/{id}', 'Modules\Admin\Http\Controllers\CommentController@showComment');

        Route::resource(
            'admin/complaint',
            'Modules\Admin\Http\Controllers\CompaintController',
            [
            'names' => [
                'index' => 'complaint',
            ]
                ]
        );
        // complain details
        Route::get('admin/complainDetail', 'Modules\Admin\Http\Controllers\CompaintController@complainDetail');

        Route::post('admin/supportReply', 'Modules\Admin\Http\Controllers\CompaintController@supportReply');



        Route::bind('postTask', function ($value, $route) {
            return Modules\Admin\Models\PostTask::find($value);
        });

        Route::resource(
            'admin/postTask',
            'Modules\Admin\Http\Controllers\PostTaskController',
            [
            'names' => [
                'edit' => 'postTask.edit',
                'show' => 'postTask.show',
                'destroy' => 'postTask.destroy',
                'update' => 'postTask.update',
                'store' => 'postTask.store',
                'index' => 'postTask',
                'create' => 'postTask.create',
            ]
                ]
        );

        Route::get('admin/mytask/{id}', 'Modules\Admin\Http\Controllers\PostTaskController@mytask');

        // programs
        Route::bind('program', function ($value, $route) {
            return Modules\Admin\Models\Program::find($value);
        });

        Route::resource(
            'admin/program',
            'Modules\Admin\Http\Controllers\ProgramController',
            [
            'names' => [
                'edit' => 'program.edit',
                'show' => 'program.show',
                'destroy' => 'program.destroy',
                'update' => 'program.update',
                'store' => 'program.store',
                'index' => 'program',
                'create' => 'program.create',
            ]
                ]
        );


        // programs
        Route::bind('reason', function ($value, $route) {
            return Modules\Admin\Models\Reason::find($value);
        });

        Route::resource(
            'admin/reason',
            'Modules\Admin\Http\Controllers\ReasonController',
            [
            'names' => [
                'edit' => 'reason.edit',
                'show' => 'reason.show',
                'destroy' => 'reason.destroy',
                'update' => 'reason.update',
                'store' => 'reason.store',
                'index' => 'reason',
                'create' => 'reason.create',
            ]
                ]
        );


        Route::get('admin/createGroup', 'Modules\Admin\Http\Controllers\ContactController@createGroup');
        Route::post('admin/contact/import', 'Modules\Admin\Http\Controllers\ContactController@contactImport');


        //  Route::bind('contacts', function($value, $route) {
        //     return Modules\Admin\Models\Contact::find($value);
        // });

        // Route::resource('admin/contacts', 'Modules\Admin\Http\Controllers\ContactController', [
        //     'names' => [
        //         'edit' => 'contacts.edit',
        //         'show' => 'contacts.show',
        //         'destroy' => 'contacts.destroy',
        //         'update' => 'contacts.update',
        //         'store' => 'contacts.store',
        //         'index' => 'contacts',
        //         'create' => 'contacts.create',
        //     ]
        //         ]
        // );



        Route::get('admin/updateGroup', 'Modules\Admin\Http\Controllers\ContactGroupController@updateGroup');
        /*---------Contact Route ---------*/

        Route::bind('defaultContest', function ($value, $route) {
            return Modules\Admin\Models\DefaultContest::find($value);
        });

        Route::resource(
            'admin/defaultContest',
            'Modules\Admin\Http\Controllers\DefaultContestController',
            [
            'names' => [
                'edit' => 'defaultContest.edit',
                'show' => 'defaultContest.show',
                'destroy' => 'defaultContest.destroy',
                'update' => 'defaultContest.update',
                'store' => 'defaultContest.store',
                'index' => 'defaultContest',
                'create' => 'defaultContest.create',
            ]
                ]
        );

        Route::bind('transaction', function ($value, $route) {
            return Modules\Admin\Models\Transaction::find($value);
        });
        Route::resource(
            'admin/transaction',
            'Modules\Admin\Http\Controllers\PaymentController',
            [
            'names' => [
                'edit'      => 'transaction.edit',
                'show'      => 'transaction.show',
                'destroy'   => 'transaction.destroy',
                'update'    => 'transaction.update',
                'store'     => 'transaction.store',
                'index'     => 'transaction',
                'create'    => 'transaction.create',
            ]
                ]
        );
        Route::bind('paymentsHistory', function ($value, $route) {
            return Modules\Admin\Models\Transaction::find($value);
        });

        Route::resource(
            'admin/paymentsHistory',
            'Modules\Admin\Http\Controllers\TransactionHistoryController',
            [
            'names' => [
                'edit'      => 'paymentsHistory.edit',
                'show'      => 'paymentsHistory.show',
                'destroy'   => 'paymentsHistory.destroy',
                'update'    => 'paymentsHistory.update',
                'store'     => 'paymentsHistory.store',
                'index'     => 'paymentsHistory',
                'create'    => 'paymentsHistory.create',
            ]
                ]
        );
        Route::bind('payments', function ($value, $route) {
            return Modules\Admin\Models\Transaction::find($value);
        });

        Route::resource(
            'admin/payments',
            'Modules\Admin\Http\Controllers\TransactionController',
            [
            'names' => [
                'edit'      => 'payments.edit',
                'show'      => 'payments.show',
                'destroy'   => 'payments.destroy',
                'update'    => 'payments.update',
                'store'     => 'payments.store',
                'index'     => 'payments',
                'create'    => 'payments.create',
            ]
                ]
        );

        Route::bind('setting', function ($value, $route) {
            return Modules\Admin\Models\Settings::find($value);
        });

        Route::resource(
            'admin/setting',
            'Modules\Admin\Http\Controllers\SettingsController',
            [
            'names' => [
                'edit'      => 'setting.edit',
                'show'      => 'setting.show',
                'destroy'   => 'setting.destroy',
                'update'    => 'setting.update',
                'store'     => 'setting.store',
                'index'     => 'setting',
                'create'    => 'setting.create',
            ]
                ]
        );


        Route::bind('blog', function ($value, $route) {
            return Modules\Admin\Models\Blogs::find($value);
        });

        Route::resource(
            'admin/blog',
            'Modules\Admin\Http\Controllers\BlogController',
            [
            'names' => [
                'edit' => 'blog.edit',
                'show' => 'blog.show',
                'destroy' => 'blog.destroy',
                'update' => 'blog.update',
                'store' => 'blog.store',
                'index' => 'blog',
                'create' => 'blog.create',
            ]
                ]
        );


        Route::bind('role', function ($value, $route) {
            return Modules\Admin\Models\Role::find($value);
        });

        Route::resource(
            'admin/role',
            'Modules\Admin\Http\Controllers\RoleController',
            [
            'names' => [
                'edit' => 'role.edit',
                'show' => 'role.show',
                'destroy' => 'role.destroy',
                'update' => 'role.update',
                'store' => 'role.store',
                'index' => 'role',
                'create' => 'role.create',
            ]
                ]
        );


        Route::bind('content', function ($value, $route) {
            return Modules\Admin\Models\Page::find($value);
        });
        Route::resource(
            'admin/content',
            'Modules\Admin\Http\Controllers\PageController',
            [
            'names' => [
                'edit' => 'content.edit',
                'show' => 'content.show',
                'destroy' => 'content.destroy',
                'update' => 'content.update',
                'store' => 'content.store',
                'index' => 'content',
                'create' => 'content.create',
            ]
                ]
        );


        Route::bind('article', function ($value, $route) {
            return Modules\Admin\Models\Article::find($value);
        });

        Route::resource(
            'admin/article',
            'Modules\Admin\Http\Controllers\ArticleController',
            [
            'names' => [
                'edit' => 'article.edit',
                'show' => 'article.show',
                'destroy' => 'article.destroy',
                'update' => 'article.update',
                'store' => 'article.store',
                'index' => 'article',
                'create' => 'article.create',
            ]
                ]
        );



        Route::bind('press', function ($value, $route) {
            return Modules\Admin\Models\Press::find($value);
        });

        Route::resource(
            'admin/press',
            'Modules\Admin\Http\Controllers\PressController',
            [
            'names' => [
                'edit' => 'press.edit',
                'show' => 'press.show',
                'destroy' => 'press.destroy',
                'update' => 'press.update',
                'store' => 'press.store',
                'index' => 'press',
                'create' => 'press.create',
            ]
                ]
        ); 

        Route::match(['get','post'], 'admin/permission', 'Modules\Admin\Http\Controllers\RoleController@permission');

        /*----------End---------*/

        Route::match(['get','post'], 'admin/profile', 'Modules\Admin\Http\Controllers\AdminController@profile');

        Route::match(['get','post'], 'admin/monthly-report/{name}', 'Modules\Admin\Http\Controllers\MonthlyReportController@corporateUser');
        Route::match(['get','post'], 'admin/corporate-monthly-report', 'Modules\Admin\Http\Controllers\MonthlyReportController@index');
    });

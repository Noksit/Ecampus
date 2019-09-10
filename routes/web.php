<?php


Auth::routes();

//NOTHING BETTER THAN HOME
Route::get('/', 'HomeController@index')->name('front-index');

//AUTH
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//ADMIN
Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('administration');

    //manage members
    Route::prefix('members')->group(function () {
        Route::get('/', 'Admin\MemberController@index')->name('admin.members.index');
        Route::get('/create', 'Admin\MemberController@create')->name('admin.member.create');
        Route::post('/create', 'Admin\MemberController@store')->name('admin.member.store');
        Route::get('/{user}', 'Admin\MemberController@edit')->name('admin.member.edit');
        Route::post('/{user}', 'Admin\MemberController@update')->name('admin.member.update');
        Route::get('/{user}/delete', 'Admin\MemberController@destroy')->name('admin.member.delete');
    });

    // Manage Posts
    Route::prefix('posts')->group(function () {
        Route::get('/', 'Admin\PostController@index')->name('admin.posts.index');
        Route::get('/create', 'Admin\PostController@create')->name('admin.post.create');
        Route::post('/create', 'Admin\PostController@store')->name('admin.post.store');
        Route::get('/{publication}', 'Admin\PostController@edit')->name('admin.post.edit');
        Route::post('/{publication}', 'Admin\PostController@update')->name('admin.post.update');
        Route::get('/{publication}/delete', 'Admin\PostController@destroy')->name('admin.post.delete');
    });

    //Manage Tutorials
    Route::prefix('tutorials')->group(function () {
        Route::get('/', 'Admin\TutorialController@index')->name('admin.tutorials.index');
        Route::get('/create', 'Admin\TutorialController@create')->name('admin.tutorial.create');
        Route::post('/create', 'Admin\TutorialController@store')->name('admin.tutorial.store');
        Route::get('/{publication}', 'Admin\TutorialController@edit')->name('admin.tutorial.edit');
        Route::post('/{publication}', 'Admin\TutorialController@update')->name('admin.tutorial.update');
        Route::get('/{publication}/delete', 'Admin\TutorialController@destroy')->name('admin.tutorial.delete');
    });

    //Manage COmments
    Route::prefix('comments')->group(function () {
        Route::get('/', 'Admin\CommentController@index')->name('admin.comments.index');
        Route::get('/{comment}', 'Admin\CommentController@edit')->name('admin.comment.edit');
        Route::post('/{comment}', 'Admin\CommentController@update')->name('admin.comment.update');
        Route::get('/{comment}/delete', 'Admin\CommentController@destroy')->name('admin.comment.delete');
    });

    //Manage Requestes
    Route::prefix('requests')->group(function () {
        Route::get('/', 'Admin\RequestController@index')->name('admin.request.index');
        Route::get('/email/{user}', 'Admin\RequestController@email')->name('admin.request.email');
    });

    //Manage Comptable
    Route::prefix('comptable')->middleware('role:adminMarketing')->group(function () {
        Route::get('/', 'Admin\ComptableController@index')->name('admin.comptable.index');
    });

    //Manage Marketing
    Route::prefix('marketing')->middleware('role:adminAccounting')->group(function () {
        Route::get('/', 'Admin\MarketingController@index')->name('admin.marketing.index');
    });
});


//SEARCH
Route::post('/recherche', 'FrontEnd\SearchController@index')->name('search');


//TRAVEL OVER EVERY TUTORIALS
Route::prefix('travel')->group(function () {
    Route::get('/all/', 'FrontEnd\PublicationController@index')->name('listing-all');

    Route::prefix('byCategory')->group(function () {
        Route::get('/', 'FrontEnd\PublicationController@categoriesList')->name('listing-categorie');
        Route::get('/{name}', 'FrontEnd\PublicationController@show');
        Route::get('/{name}/all', 'FrontEnd\PublicationController@showByCategory')->name('listing-all-categorie');
    });
});

//PUBLCIATIONS
Route::prefix('publication')->group(function () {

    //POSTS
    Route::prefix('post')->group(function () {
        //MANAGE
        Route::get('/create', 'FrontEnd\PostController@create')->name('post-ajout');
        Route::post('/store', 'FrontEnd\PostController@store')->name('store-post');
        Route::get('/{slug}/edit', 'FrontEnd\PostController@edit')->name('update-publication-post');
        Route::post('/{slug}/update', 'FrontEnd\PostController@update')->name('update-publication');
        Route::get('/{slug}/delete', 'FrontEnd\PublicationController@softDelete')->name('publication-delete');

        //COMMENT
        Route::post('/{slug}/comment/', 'FrontEnd\CommentController@store')->name('post-comment');
    });

    // TUTORIELS
    Route::prefix('tutorial')->group(function () {
        //VIEW
        Route::get('/{slug}/buy', 'FrontEnd\TutorialController@buy')->name('front-buy-tutorial');
        Route::get('/{slug}/summary', 'FrontEnd\TutorialController@summary')->name('front-tutorial');
        Route::get('/{slug}/show', 'FrontEnd\TutorialController@show')->name('affiche-publication');

        //MANAGE
        Route::get('/create', 'FrontEnd\TutorialController@create')->name('tuto-ajout');
        Route::post('/store', 'FrontEnd\TutorialController@store')->name('store-tuto');
        Route::get('/{slug}/edit', 'FrontEnd\TutorialController@edit')->name('update-publication-tutorial');
        Route::post('/{slug}/update', 'FrontEnd\TutorialController@update')->name('update-publication');
        Route::get('/{slug}/delete', 'FrontEnd\PublicationController@softDelete')->name('publication-delete');

        //COMMENT
        Route::post('/{slug}/comment/', 'FrontEnd\CommentController@store')->name('tutorial-comment');
        Route::post('/{slug}/rating', 'FrontEnd\RatingController@store')->name('tutorial.rating');

        Route::prefix('bought')->group(function () {
            Route::get('/', 'FrontEnd\BoughtController@index')->name('user-profil-bought');
            Route::get('/category', 'FrontEnd\BoughtController@categoryList')
                ->name('user-profil-category-bought');
            Route::get('/category/{name}', 'FrontEnd\BoughtController@show')
                ->name('user-profil-all-category-bought');
        });
    });

    //COMMENT DELETE
    Route::get('/comment/delete/{id}', 'FrontEnd\CommentController@softDelete')->name('comment-delete');
});


//PROFILE
Route::prefix('profil')->group(function () {
    //MANAGE
    Route::get('/', 'FrontEnd\UserController@index')->name('user-profil');
    Route::get('/edit', 'FrontEnd\UserController@edit')->name('user-profil-infos');
    Route::post('/update', 'FrontEnd\UserController@update')->name('user.update');

    //MANAGE PREFERENCE
    Route::get('/preference/', 'FrontEnd\UserController@preference')->name('user-profil-preference');

    //VIEW OTHER
    Route::get('/{slug}/visit', 'FrontEnd\UserController@otherProfil')->name('other-profil');

    //MESSAGERIE (je sais pas comment lecrire en anglais (lol))
    Route::prefix('message')->group(function () {
        Route::get('/{slug}', 'FrontEnd\MessageController@show')->name('conversation.show');
        Route::post('/{slug}', 'FrontEnd\MessageController@store');
        Route::get('/', 'FrontEnd\MessageController@index')->name('user-profil-message');
    });

    //SUBSCRIBE
    Route::get('/subscription', 'FrontEnd\UserController@subscription')->name('user-sub');
    Route::get('/unsubscription', 'FrontEnd\UserController@unsubscription')->name('user-unsub');

    //FOLLOW
    Route::get('/follow/{slug}', 'FrontEnd\FollowController@followUser')->name('follow');
    Route::get('/unfollow/{slug}', 'FrontEnd\FollowController@unFollowUser')->name('unfollow');

    //LIKE
    Route::get('/like/{slug}', 'FrontEnd\LikeController@store')->name('like');
    Route::get('/dislike/{slug}', 'FrontEnd\LikeController@destroy')->name('dislike');
});


//See this page
Route::get('/panier', 'HomeController@panier')->name('front-panier');


// USELESS
Route::get('/cgu', 'FrontEnd\ContentController@cgu')->name('front-cgu');
Route::get('/aboutus', 'FrontEnd\ContentController@aboutus')->name('front-aboutus');
Route::get('/contact', 'FrontEnd\ContentController@contact')->name('front-contact');
Route::post('/contact/sendRequest', 'FrontEnd\ContactRequestController@store')->name('contact-request');
Route::get('/rgpd', 'FrontEnd\ContentController@rgpd')->name('front-rgpd');
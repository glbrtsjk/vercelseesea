<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FunfactController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\LikeorDislikeController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommunityController;
use App\Http\Controllers\Admin\AdminTagController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Logout Route (accessible for authenticated users)
 Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| User Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard redirect based on user role
    Route::get('/dashboard', function() {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard.index'); // Or your user dashboard view
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
  Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin/users')->name('admin.users.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
    Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    Route::post('/{user}/ban', [AdminUserController::class, 'toggleBan'])->name('ban');
    Route::post('/{user}/unban', [AdminUserController::class, 'toggleBan'])->name('unban');
    Route::post('/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('toggle-admin');
    Route::get('/usermanage', [AdminUserController::class, 'usermanage'])->name('usermanage');
});

// Admin profile routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AdminDashboardController::class, 'editProfile'])->name('edit-profile');
    Route::put('/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('update-profile');
    Route::get('/profile/change-password', [AdminDashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/profile/update-password', [AdminDashboardController::class, 'updatePassword'])->name('update-password');

    // Dashboard routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/articles', [AdminDashboardController::class, 'articles'])->name('dashboard.article');
    Route::get('/dashboard/community', [AdminDashboardController::class, 'community'])->name('dashboard.community');
});


/*
|--------------------------------------------------------------------------
| User Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Dashboard home
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile management
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('edit-profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('update-profile');

    // Password management
    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::put('/change-password', [DashboardController::class, 'updatePassword'])->name('update-password');

    // User content management
    Route::get('/articles', [DashboardController::class, 'articles'])->name('articles');
    Route::get('/communities', [DashboardController::class, 'communities'])->name('communities');
});


/*
|--------------------------------------------------------------------------
| Community Routes
|--------------------------------------------------------------------------
*/

// Public & member community routes
Route::prefix('communities')->name('communities.')->group(function () {
    // Public routes
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::get('/{community}', [CommunityController::class, 'show'])->name('show');

    // Member-only routes (require auth)
    Route::middleware('auth')->group(function() {
        Route::get('/{community}/join', [CommunityController::class, 'showJoinForm'])->name('join.show');
        Route::post('/{community}/join', [CommunityController::class, 'join'])->name('join');
        Route::get('/{community}/chat', [CommunityController::class, 'chat'])->name('chat');
        Route::post('/{community}/leave', [CommunityController::class, 'leave'])->name('leave');
    });
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    // Show & manage communities
    Route::resource('communities', AdminCommunityController::class);
   });


/*
|--------------------------------------------------------------------------
|  Chat Routes
|--------------------------------------------------------------------------
*/
// Community chat routes
Route::middleware(['auth'])->prefix('communities')->name('communities.')->group(function () {
    // View chat
    Route::get('{community}/chat', [CommunityController::class, 'chat'])
        ->name('chat');

    // Message operations
    Route::post('{community}/messages', [CommunityController::class, 'storeMessage'])
        ->name('messages.store');
    Route::delete('{community}/messages/{message}', [CommunityController::class, 'deleteMessage'])
        ->name('messages.delete');

    // Moderation functions
    Route::post('{community}/lock-chat', [CommunityController::class, 'lockChat'])
        ->name('lock-chat');
    Route::get('{community}/moderation', [CommunityController::class, 'moderation'])
        ->name('moderation');

    // User management within community
    Route::post('{community}/ban/{user}', [CommunityController::class, 'banUser'])
        ->name('ban-user');
    Route::post('{community}/unban/{user}', [CommunityController::class, 'unbanUser'])
        ->name('unban-user');
    Route::post('{community}/mute/{user}', [CommunityController::class, 'muteUser'])
        ->name('mute-user');
    Route::post('{community}/unmute/{user}', [CommunityController::class, 'unmuteUser'])
        ->name('unmute-user');
    Route::post('{community}/promote/{user}', [CommunityController::class, 'promoteModerator'])
        ->name('promote-moderator');
    Route::post('{community}/demote/{user}', [CommunityController::class, 'demoteModerator'])
        ->name('demote-moderator');
});

/**--------------------------------------------------------------------------
| Article Routes
|--------------------------------------------------------------------------
*/
Route ::prefix('articles')->name('articles.')->group(function () {
    // Public article routes
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/search', [ArticleController::class, 'search'])->name('search');

// Protected article routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Article CRUD operations
    Route::middleware('auth')->group(function () {
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article:slug}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::put('/{article:slug}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article:slug}', [ArticleController::class, 'destroy'])->name('destroy');
    });
  Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');

    // Article reactions
    Route::post('/{article:slug}/reactions', [ArticleController::class, 'react'])->name('react');
    Route::delete('/{article:slug}/reactions', [ArticleController::class, 'unreact'])->name('unreact');

    // Article comments
    Route::post('/{article:slug}/comments', [ArticleController::class, 'comment'])->name('comment');
    Route::put('/{article:slug}/comments/{comment}', [ArticleController::class, 'updateComment'])->name('update-comment');
    Route::delete('/{article:slug}/comments/{comment}', [ArticleController::class, 'deleteComment'])->name('delete-comment');
});

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.articles.')->group(function () {
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('index');
    Route::get('/articles/pending', [AdminArticleController::class, 'pending'])->name('pending');
    Route::post('/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('approve');
    Route::post('/articles/{article}/reject', [AdminArticleController::class, 'reject'])->name('reject');
});


/**--------------------------------------------------------------------------
| FunFacts Routes
|--------------------------------------------------------------------------
*/

// Funfact Routes
Route::prefix('funfacts')->name('funfacts.')->group(function () {
    // Public routes
    Route::get('/', [FunfactController::class, 'index'])->name('index');
    Route::get('/{funfact}', [FunfactController::class, 'show'])->name('show');
});

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.funfacts.')->group(function () {
        Route::get('/create', [FunfactController::class, 'create'])->name('create');
        Route::post('/', [FunfactController::class, 'store'])->name('store');
        Route::get('/{funfact}/edit', [FunfactController::class, 'edit'])->name('edit');
        Route::put('/{funfact}', [FunfactController::class, 'update'])->name('update');
        Route::delete('/{funfact}', [FunfactController::class, 'destroy'])->name('destroy');
        Route::patch('/{funfact}/toggle-highlight', [FunfactController::class, 'toggleHighlight'])->name('toggle-highlight');
        Route::post('/manage/update-order', [FunfactController::class, 'updateOrder'])->name('update-order');
    });
/**--------------------------------------------------------------------------
| Comment and Comment Reply Routes
|--------------------------------------------------------------------------
*/
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('/comments/{comment}/replies', [CommentReplyController::class, 'store'])->name('comments.replies.store');
Route::put('/comments/{comment}/replies/{reply}', [CommentReplyController::class, 'update'])->name('comments.replies.update');
Route::delete('/comments/{comment}/replies/{reply}', [CommentReplyController::class, 'destroy'])->name('comments.replies.destroy');

/*
|--------------------------------------------------------------------------
| LikeDislike Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function() {
    Route::post('/likes', [LikeorDislikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [LikeorDislikeController::class, 'destroy'])->name('likes.destroy');
});


/*
|--------------------------------------------------------------------------
| Reaction Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function() {
    Route::post('/reactions', [ReactionController::class, 'store'])->name('reactions.store');
    Route::delete('/reactions', [ReactionController::class, 'destroy'])->name('reactions.destroy');
    Route::get('/reactions/{type}/{id}', [ReactionController::class, 'show'])->name('reactions.show');
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');


});

/*|--------------------------------------------------------------------------
| Tag Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('tags.destroy');
    Route::post('/tags/merge', [AdminTagController::class, 'merge'])->name('tags.merge');
});

/*|--------------------------------------------------------------------------
| Public  Tag Resources
|--------------------------------------------------------------------------
*/
Route::prefix('tags')->name('tags.')->group(function() {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/search', [TagController::class, 'search'])->name('search');
    Route::get('/cloud', [TagController::class, 'cloud'])->name('cloud');
    Route::get('/popular', [TagController::class, 'getPopular'])->name('popular');
    Route::get('/suggest', [TagController::class, 'suggestTags'])->name('suggest');
    Route::get('/{tag:slug}', [TagController::class, 'show'])->name('show');

    // Auth required routes
    Route::middleware('auth')->group(function() {
        Route::post('/{tag:slug}/follow', [TagController::class, 'follow'])->name('follow');
        Route::post('/{tag:slug}/unfollow', [TagController::class, 'unfollow'])->name('unfollow');
    });


});

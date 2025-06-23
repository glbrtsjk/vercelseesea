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
use App\Http\Controllers\CommunityEventsController;
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

Route::get('/csrf-refresh', function() {
    return response()->json(['token' => csrf_token()]);
})->middleware('web');

// Halaman beranda
Route::get('/', [HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Rute Autentikasi
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Rute Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Rute Pendaftaran
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Rute Reset Kata Sandi
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Rute Logout (dapat diakses untuk pengguna yang terautentikasi)
 Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rute Dashboard Pengguna
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Pengalihan dashboard berdasarkan peran pengguna
    Route::get('/dashboard', function() {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard.index'); // Atau tampilan dashboard pengguna Anda
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
  Rute Dashboard Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Rute dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute pengguna
    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/usermanage', [AdminUserController::class, 'usermanage'])->name('usermanage');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/ban', [AdminUserController::class, 'toggleBan'])->name('ban');
        Route::post('/{user}/unban', [AdminUserController::class, 'toggleBan'])->name('unban');
        Route::post('/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('toggle-admin');
    });
});

// Rute profil admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AdminDashboardController::class, 'editProfile'])->name('edit-profile');
    Route::put('/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('update-profile');
    Route::get('/profile/change-password', [AdminDashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/profile/update-password', [AdminDashboardController::class, 'updatePassword'])->name('update-password');

    // Rute dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/articles', [AdminDashboardController::class, 'articles'])->name('dashboard.article');
    Route::get('/dashboard/funfacts', [AdminDashboardController::class, 'funfacts'])->name('dashboard.funfacts');
    Route::get('/dashboard/community', [AdminDashboardController::class, 'community'])->name('dashboard.community');
});


/*
|--------------------------------------------------------------------------
| Rute Dashboard Pengguna
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Beranda dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengelolaan profil
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('edit-profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('update-profile');

    // Manajemen kata sandi
    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::put('/change-password', [DashboardController::class, 'updatePassword'])->name('update-password');

    // Pengelolaan konten pengguna
    Route::get('/articles', [DashboardController::class, 'articles'])->name('articles');
    Route::get('/communities', [DashboardController::class, 'communities'])->name('communities');
});


/*
|--------------------------------------------------------------------------
| Rute Komunitas
|--------------------------------------------------------------------------
*/

// Rute komunitas publik & anggota
Route::prefix('communities')->name('communities.')->group(function () {
    // Rute publik
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::get('/{community}', [CommunityController::class, 'show'])->name('show');
    Route::post('/', [CommunityController::class, 'store'])->name('store');

// Rute Acara Komunitas

// Tambahkan ini di bagian rute Acara Komunitas
Route::get('/{community}/events/create', [CommunityEventsController::class, 'create'])->name('events.create')->middleware('auth');
Route::get('/{community}/events/calendar', [CommunityEventsController::class, 'exportCalendar'])->name('events.calendar');
Route::get('/{community}/events', [CommunityEventsController::class, 'showEvents'])->name('events');
Route::get('/{community}/events/{event}', [CommunityEventsController::class, 'show'])->name('events.show');
Route::post('/{community}/events', [CommunityEventsController::class, 'store'])->name('events.store');
Route::put('/{community}/events/{event}', [CommunityEventsController::class, 'update'])->name('events.update');
Route::delete('/{community}/events/{event}', [CommunityEventsController::class, 'delete'])->name('events.delete');
Route::get('/{community}/events/{event}/edit', [CommunityEventsController::class, 'edit'])->name('events.edit');
    // Rute khusus anggota (memerlukan autentikasi)
    Route::middleware('auth')->group(function() {
        Route::get('/{community}/join', [CommunityController::class, 'showJoinForm'])->name('join.show');
        Route::post('/{community}/join', [CommunityController::class, 'join'])->name('join');
        Route::get('/{community}/chat', [CommunityController::class, 'chat'])->name('chat');
        Route::delete('/{community}/leave', [CommunityController::class, 'leave'])->name('leave');
        Route::post('/{community}/update-activity', [CommunityController::class, 'updateActivity'])->name('update-activity');
    });
});

Route::middleware([ 'auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    // Tampilkan & kelola komunitas
    Route::get('/communities', [AdminCommunityController::class, 'index'])->name('communities.index');
    Route::get('/communities/create', [AdminCommunityController::class, 'create'])->name('communities.create');
    Route::post('/communities', [AdminCommunityController::class, 'store'])->name('communities.store');
    Route::get('/communities/{community}/edit', [AdminCommunityController::class, 'edit'])->name('communities.edit');
    Route::put('/communities/{community}', [AdminCommunityController::class, 'update'])->name('communities.update');
    Route::delete('/communities/{community}', [AdminCommunityController::class, 'destroy'])->name('communities.destroy');
   // Route::resource('communities', AdminCommunityController::class);
    Route::get('/communities/{community}/initiatives/create', [AdminCommunityController::class, 'createInitiative'])->name('communities.initiatives.create');
    Route::post('/communities/{community}/initiatives', [AdminCommunityController::class, 'storeInitiative'])->name('communities.initiatives.store');
    Route::get('/communities/{community}/initiatives/{initiative}/edit', [AdminCommunityController::class, 'editInitiative']) ->name('communities.initiatives.edit');
    Route::put('/communities/{community}/initiatives/{initiative}', [AdminCommunityController::class, 'updateInitiative'])->name('communities.initiatives.update');
    Route::delete('/communities/{community}/initiatives/{initiative}', [AdminCommunityController::class, 'destroyInitiative']) ->name('communities.initiatives.destroy');
   });


/*
|--------------------------------------------------------------------------
|  Rute Obrolan
|--------------------------------------------------------------------------
*/
// Rute obrolan komunitas
Route::middleware(['auth'])->prefix('communities')->name('communities.')->group(function () {
    // Lihat obrolan
    Route::get('{community}/chat', [CommunityController::class, 'chat'])->name('chat');
    Route::get('{community}/anggota', [CommunityController::class, 'members'])->name('members');
    // Operasi pesan
    Route::post('{community}/messages', [CommunityController::class, 'storeMessage'])
        ->name('messages.store');
    Route::delete('{community}/messages/{message}', [CommunityController::class, 'deleteMessage'])
        ->name('messages.delete');

    // Fungsi moderasi
    Route::post('{community}/lock-chat', [CommunityController::class, 'lockChat'])
        ->name('lock-chat');
    Route::get('{community}/moderation', [CommunityController::class, 'moderation'])
        ->name('moderation');
   Route::post('{community}/mute-user-form', [CommunityController::class, 'muteUser'])
    ->name('mute-user-form');
Route::post('{community}/ban-user-form', [CommunityController::class, 'banUser'])
    ->name('ban-user-form');
Route::post('{community}/unmute-user/{user}', [CommunityController::class, 'unmute'])
    ->name('unmute-user-form');
Route::post('{community}/unban-user/{user}', [CommunityController::class, 'unban'])
    ->name('unban-user-form');

    // Pengelolaan pengguna dalam komunitas
    Route::post('{community}/ban/{user}', [CommunityController::class, 'BanUsers'])
        ->name('ban-user');
    Route::post('{community}/unban/{user}', [CommunityController::class, 'unBanUsers'])
        ->name('unban-user');
    Route::post('{community}/mute/{user}', [CommunityController::class, 'MuteUsers'])
        ->name('mute-user');
    Route::post('{community}/unmute/{user}', [CommunityController::class, 'unMuteUsers'])
        ->name('unmute-user');
    Route::post('{community}/promote/{user}', [CommunityController::class, 'promoteModerator'])
        ->name('promote-moderator');
    Route::post('{community}/demote/{user}', [CommunityController::class, 'demoteModerator'])
        ->name('demote-moderator');
});

/**--------------------------------------------------------------------------
| Rute Artikel
|--------------------------------------------------------------------------
*/
Route ::prefix('articles')->name('articles.')->group(function () {
    // Rute artikel publik
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/search', [ArticleController::class, 'search'])->name('search');

// Rute artikel terproteksi (memerlukan autentikasi)
Route::middleware(['auth'])->group(function () {
    // Operasi CRUD artikel
    Route::middleware('auth')->group(function () {
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article:slug}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::put('/{article:slug}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article:slug}', [ArticleController::class, 'destroy'])->name('destroy');
    });
  Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');

    // Reaksi artikel
    Route::post('/{article:slug}/reactions', [ArticleController::class, 'react'])->name('react');
    Route::delete('/{article:slug}/reactions', [ArticleController::class, 'unreact'])->name('unreact');

    // Komentar artikel
    Route::post('/{article:slug}/comments', [ArticleController::class, 'comment'])->name('comment');
    Route::put('/{article:slug}/comments/{comment}', [ArticleController::class, 'updateComment'])->name('update-comment');
    Route::delete('/{article:slug}/comments/{comment}', [ArticleController::class, 'deleteComment'])->name('delete-comment');
});

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.articles.')->group(function () {
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('index');
    Route::get('/articles/pending', [AdminArticleController::class, 'pending'])->name('pending');
    Route::match(['get', 'post'], '/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('approve');
    Route::post('/articles/{article}/reject', [AdminArticleController::class, 'reject'])->name('reject');
});


/**--------------------------------------------------------------------------
| Rute Fakta Menarik
|--------------------------------------------------------------------------
*/

// Rute Fakta Menarik
Route::prefix('funfacts')->name('funfacts.')->group(function () {
    // Rute publik
    Route::get('/', [FunfactController::class, 'index'])->name('index');
    Route::get('/{funfact}', [FunfactController::class, 'show'])->name('show');
    Route::get('/search', [FunfactController::class, 'search'])->name('search');
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
| Rute Komentar dan Balasan Komentar
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
| Rute Suka dan Tidak Suka
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function() {
    Route::post('/likes', [LikeorDislikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [LikeorDislikeController::class, 'destroy'])->name('likes.destroy');
});


/*
|--------------------------------------------------------------------------
| Rute Reaksi
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
| Rute Tag
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag:tag_id}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
     Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('tags.destroy');
    Route::post('/tags/merge', [AdminTagController::class, 'merge'])->name('tags.merge');
});

/*|--------------------------------------------------------------------------
| Rute Tag Publik
|--------------------------------------------------------------------------
*/
Route::prefix('tags')->name('tags.')->group(function() {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/search', [TagController::class, 'search'])->name('search');
    Route::get('/cloud', [TagController::class, 'cloud'])->name('cloud');
    Route::get('/popular', [TagController::class, 'getPopular'])->name('popular');
    Route::get('/suggest', [TagController::class, 'suggestTags'])->name('suggest');
    Route::get('/{tag:slug}', [TagController::class, 'show'])->name('show');

    // Rute yang memerlukan autentikasi
    Route::middleware('auth')->group(function() {
        Route::post('/{tag:slug}/follow', [TagController::class, 'follow'])->name('follow');
        Route::post('/{tag:slug}/unfollow', [TagController::class, 'unfollow'])->name('unfollow');
    });


});

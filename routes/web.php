<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// No Auth Panel
Route::group([], function (): void {
    Route::get('/', 'LandingController@index')->name('home');
    Route::get('{referral_id}', static function ($referral_id) {
        if (User::where('customer_id', $referral_id)->exists()) {
            $urlArray = urlHelper();
            Cookie::queue(cookie(
                'referral_id',
                $referral_id,
                60 * 24 * 30 * 3,
                null,
                '.' . $urlArray['baseDomain']
            ));
        }

        return redirect()->route('home');
    })->where('referral_id', '[0-9]{6}+')->name('referral:referral-link');
    Route::get('{referral_id}/{channel}', static function ($referral_id, $channel) {
        if (User::where('customer_id', $referral_id)->exists()) {
            $urlArray = urlHelper();
            Cookie::queue(cookie(
                'referral_id',
                $referral_id,
                60 * 24 * 30 * 3,
                null,
                '.' . $urlArray['baseDomain']
            ));
            Cookie::queue(cookie(
                'channel_id',
                $channel,
                60 * 24 * 30 * 3,
                null,
                '.' . $urlArray['baseDomain']
            ));
        }

        return redirect()->route('home');
    })->where('referral_id', '[0-9]{6}+')->name('referral:referral-link-channel');

    Route::get('deployment', function () {
        if ( ! app()->isProduction()) {
            return response()
                ->json(Storage::json('deployment.json'), 200, [], JSON_PRETTY_PRINT);
        }

        return redirect()->route('home');
    });
});

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Auth',
], function (): void {
    Route::post('verify', 'RegisterController@verify')->name('auth.verify');
    Route::post('address-filter', 'RegisterController@addressFilter')->name('address.search');
    Route::post('enquiry-send', 'RegisterController@sendEnquiry')->name('enquiry.send');
});

// Auth Panel
Route::group(['middleware' => ['auth']], function (): void {
    // Route::group(['middleware' => ['roles:admin']], function() {
    //     Route::get('/news/mine', 'NewsController@mine')->name('news.mine');
    //     Route::get('/news/create', 'NewsController@create')->name('news.create');
    //     Route::get('/news/edit/{id}', 'NewsController@edit')->name('news.edit');
    // });
    Route::group([
        'middleware' => ['roles:admin'],
        'namespace' => 'Admin',
    ], function (): void {
        Route::get('admin/db', fn () => redirect('adminer'));
        Route::get('admin/members/{userID?}', 'MembersController@index')->name('members.index');
        Route::post(
            'admin/members/update-detail-info',
            'MembersController@updateUserDetailInfo'
        )->name('admin.members.infoUpdate');
        Route::put(
            'admin/members/update_account_status',
            'MembersController@updateAccountStatus'
        )->name('admin.members.statusUpdate');
        Route::get('admin/joining-reports', 'ReportsController@index')->name('joining.reports.index');
        Route::get('admin/downline-reports', 'ReportsController@downline')->name('downline.reports.index');
        Route::get('admin/sales-reports', 'ReportsController@sales')->name('sales.reports.index');

        Route::get('admin/joiningReportFilters', 'ReportsController@filters')->name('joiningReport.filters');
        Route::post('admin/joiningReportTable', 'ReportsController@fetch')->name('joiningReport.fetch');
        Route::get('admin/downlineReportFilters', 'ReportsController@downlineFilters')->name('downlineReport.filters');
        Route::post('admin/downlineReportTable', 'ReportsController@downlineFetch')->name('downlineReport.fetch');
        Route::get('admin/salesReportFilters', 'ReportsController@salesFilters')->name('salesReport.filters');
        Route::post('admin/salesReportTable', 'ReportsController@salesFetch')->name('salesReport.fetch');

        Route::post(
            'admin/downloadJoiningReportPdf',
            'ReportsController@downloadJoiningReportPdf'
        )->name('joiningReport.download.pdf');
        Route::get(
            'admin/downloadJoiningReportExcel',
            'ReportsController@downloadJoiningReportExcel'
        )->name('joiningReport.download.excel');
        Route::post('admin/printJoiningReport', 'ReportsController@printJoiningReport')->name('joiningReport.print');

        Route::get('admin/products', 'ProductsController@index')->name('products.index');
        Route::get('admin/emails', 'EmailsController@index')->name('emails.index');
        Route::get('admin/finance', 'FinanceController@index')->name('finance.index');
        Route::get('admin/financeFilters', 'FinanceController@filters')->name('finance.filters');
        Route::post('admin/trasactionList', 'FinanceController@fetch')->name('finance.transaction.fetch');
        Route::get('admin/tickets', 'TicketsController@index')->name('tickets.index');
    });
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('user-verify', 'UserController@verify')->name('user.verify');

    Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
    Route::get('profile/detail', 'UserController@detail')->name('profile.detail');
    Route::get('profile/detail/edit', 'UserController@editDetail')->name('profile.detail.edit');
    Route::get('profile/setting', 'UserController@setting')->name('profile.setting');
    Route::get('profile/{userID?}', 'UserController@index')->name('profile');
    Route::post('city-filter', 'UserController@cityFilter')->name('city.filter');
    Route::post('profile/update-detail-info', 'UserController@updateUserDetailInfo')->name('update.detail');

    // Setting Route
    Route::put(
        'settings/profile-address-update',
        'UserController@updateProfileAddress'
    )->name('setting.profile.address');
    Route::put(
        'settings/other-interested-update',
        'UserController@updateOtherInterested'
    )->name('setting.other.interested');
    Route::put(
        'settings/main-interested-update',
        'UserController@updateMainInterested'
    )->name('setting.main.interested');
    Route::post('settings/profile-avatar-upload', 'UserController@uploadProfileAvatar')->name('setting.profile.avatar');
    Route::put('settings/profile-avatar-remove', 'UserController@removeProfileAvatar')->name('setting.remove.avatar');
    Route::put('settings/update_story', 'UserController@updateStoryContent')->name('setting.update.story');
    Route::put('settings/update_job_title', 'UserController@updateJobTitle')->name('setting.update.job_title');
    Route::put('settings/update_city', 'UserController@updateCity')->name('setting.update.city');
    Route::put('settings/update_country', 'UserController@updateCountry')->name('setting.update.country');
    Route::put('settings/update_street', 'UserController@updateStreet')->name('setting.update.street');
    Route::put('settings/update_code', 'UserController@updateCode')->name('setting.update.code');
    Route::put('settings/update_email', 'UserController@updateEmail')->name('setting.update.email');
    Route::put('settings/update_phone', 'UserController@updatePhone')->name('setting.update.phone');
    Route::put('settings/update_site', 'UserController@updateSite')->name('setting.update.site');

    // Connect Route
    Route::get('connect', 'ConnectController@index')->name('connect.index');
    Route::get('connect/{userID}', 'ConnectController@request')->name('connect.request');
    Route::post('connect/request', 'ConnectController@send')->name('connect.request.send');
    Route::post('connect/filter', 'ConnectController@filter')->name('connect.search.filter');
    Route::post('connect/address-filter', 'ConnectController@addressFilter')->name('connect.address.search');

    // Chat Route
    Route::get('chat', 'ChatController@index')->name('chat.index');
    Route::post('chat/filter', 'ChatController@filter')->name('chat.search.filter');
    Route::post('chat/create-chat-room', 'ChatController@chatRoomCreate')->name('chat.create.room');
    Route::get('chat/{ids?}', 'ChatController@chatting')->name('chat.chatting');
    Route::put('chat/update-channel', 'ChatController@updateConnectedStatus')->name('chat.connected.status');
    Route::put('chat/trash', 'ChatController@trashUser')->name('chat.trash.user');

    // Friends Route
    Route::get('friends', 'FriendsController@individuals')->name('friends.index');
    Route::get('friends/individuals', 'FriendsController@individuals')->name('friends.individuals');
    Route::get('friends/companies', 'FriendsController@companies')->name('friends.companies');
    Route::get('friends/coaches', 'FriendsController@coaches')->name('friends.coaches');
    Route::post('friends/accept', 'FriendsController@accept')->name('friend.accept');
    Route::post('friends/remove', 'FriendsController@remove')->name('friend.remove');

    // Teams Route
    Route::get('rooms', 'TeamsController@index')->name('teams.index');
    Route::get('rooms/own', 'TeamsController@showOwnTeams')->name('own.teams.index');
    Route::get('room', 'TeamsController@show')->name('team.create.index');
    Route::get('room/edit/{id}', 'TeamsController@edit')->name('team.edit.index');
    Route::get('rooms/friends', 'TeamsController@showFriendsTeams')->name('friends.teams.index');
    Route::post('room/create-chat-room', 'TeamsController@createTeamChatRoom')->name('team.create.chatroom');
    Route::put('room/update-info', 'TeamsController@updateTeamInfo')->name('team.info.update');
    Route::post('room/accept', 'TeamsController@accept')->name('team.invite.accept');
    Route::post('room/ban', 'TeamsController@ban')->name('team.member.ban');
    Route::post('room/unban', 'TeamsController@unban')->name('team.member.unban');
    Route::get('room-chatroom/{id}', 'TeamsController@chat')->name('team.chat.index');
    Route::delete('room/delete', 'TeamsController@delete')->name('team.delete');

    // Companies Route
    Route::get('companies', 'CompaniesController@index')->name('companies.index');
    Route::put('companies/likes', 'CompaniesController@likes')->name('company.likes');
    Route::get('companies/add', 'CompaniesController@add')->name('companies.add');
    Route::post('companies/add-new-company', 'CompaniesController@addNewCompany')->name('add.company');

    // Coach Route
    Route::get('coaches', 'CoachController@index')->name('coaches.index');
    Route::get('coaches/add', 'CoachController@add')->name('coaches.add');
    Route::post('coaches/add-new-coach', 'CoachController@addNewCoach')->name('add.coach');

    // Studio Route
    Route::get('studio', 'StudioController@index')->name('studio.index');
    Route::get('studios/edit', 'StudioController@edit')->name('studio.edit');
    Route::put('studio/update_mode1', 'StudioController@updateMode1')->name('studio.update.mode1');
    Route::put('studio/update_mode2', 'StudioController@updateMode2')->name('studio.update.mode2');
    Route::put('studio/update_mode3', 'StudioController@updateMode3')->name('studio.update.mode3');
    Route::put('studio/update_mode4', 'StudioController@updateMode4')->name('studio.update.mode4');
    Route::post('studio/image-upload', 'StudioController@uploadImage')->name('studio.image.upload');
    Route::put('studio/image-remove', 'StudioController@removeImage')->name('studio.remove.image');
    Route::post('studio/update', 'StudioController@update')->name('studio.update');
    Route::get('studio/download', 'StudioController@download')->name('studio.download');

    // Share Route
    Route::get('share', 'ShareController@index')->name('share.index');
    Route::get('share/link', 'ShareController@link')->name('share.link');
    Route::get('share/download', 'ShareController@download')->name('share.download');

    // Post Route
    Route::post('post/store', 'PostsController@store')->name('post.store');
    Route::post('post/update', 'PostsController@update')->name('post.update');
    Route::put('post/likes', 'PostsController@likes')->name('post.likes');
    Route::delete('post/delete', 'PostsController@delete')->name('post.delete');

    // Stories Route
    Route::get('stories', 'StoriesController@index')->name('stories.index')->middleware('auth');
    Route::get('stories/friends', 'StoriesController@friendsStory')->name('stories.friends')->middleware('auth');
    Route::get('stories/mine', 'StoriesController@myStory')->name('stories.mine')->middleware('auth');
    Route::get('stories/create', 'StoriesController@create')->name('stories.create')->middleware('auth');
    Route::get('stories/edit/{id}', 'StoriesController@edit')->name('stories.mine.edit')->middleware('auth');

    // News Route
    Route::get('news', 'NewsController@index')->name('news.index');
    Route::get('news/mine', 'NewsController@mine')->name('news.mine');
    Route::get('news/create', 'NewsController@create')->name('news.create');
    Route::get('news/edit/{id}', 'NewsController@edit')->name('news.edit');

    // Events Route
    Route::get('events/company', 'EventsController@company')->name('events.company');
    Route::get('events/coach', 'EventsController@coach')->name('events.coach');
    Route::get('events/distributor', 'EventsController@distributor')->name('events.distributor');
    Route::get('events/mine', 'EventsController@mine')->name('events.mine');
    Route::get('events/create', 'EventsController@create')->name('events.create');
    Route::get('events/edit/{id}', 'EventsController@edit')->name('events.mine.edit');

    // Brands Route
    Route::get('brands', 'TradeController@index')->name('trades.index');
    Route::get('brands/friends', 'TradeController@friend')->name('trades.friends');
    Route::get('brands/mine', 'TradeController@mine')->name('trades.mine');
    Route::get('brands/create', 'TradeController@create')->name('trades.create');
    Route::get('brands/edit/{id}', 'TradeController@edit')->name('trades.mine.edit');

    // Incentives Route
    Route::get('incentives', 'IncentivesController@index')->name('incentives.index');
    Route::get('incentives/shares', 'IncentivesController@shares')->name('incentives.shares');
    Route::get('incentives/teams', 'IncentivesController@teams')->name('incentives.teams');
    Route::post('incentives/teams/search', 'IncentivesController@fetch')->name('incentives.teams.search');

    // Wallet Route
    Route::get('wallet', 'WalletController@index')->name('wallet.index');

    // Wisdom Route
    Route::get('wisdom', 'WisdomContoller@index')->name('wisdom.index');
    Route::get('wisdom/mine', 'WisdomContoller@myStory')->name('wisdom.mine');
    Route::get('wisdom/create', 'WisdomContoller@create')->name('wisdom.create');
    Route::get('wisdom/edit/{id}', 'WisdomContoller@edit')->name('wisdom.mine.edit');

    // Files Route
    Route::get('files/manual', 'FilesController@manual')->name('files.manual');
    Route::get('files/marketing', 'FilesController@marketing')->name('files.marketing');
    Route::get('files/invoices', 'FilesController@invoices')->name('files.invoices');

    // Info Route
    Route::get('info', 'InfoController@index')->name('info.index');
});

// Join Route
Route::get('join', 'ContactController@join')->name('join');

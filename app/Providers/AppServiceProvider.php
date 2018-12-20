<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Topic;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        //监听话题模型
        Topic::observe(TopicObserver::class);
        //监听回复模型
        Reply::observe(ReplyObserver::class);
        //回帖周榜视图注入
        \View::composer('index.layouts._reply_rank', function ($view){
            $carbon=new Carbon();
            $prevWeek=$carbon->previous()->toDateTimeString();
            $data=DB::select('select uid, name,avatar, count(uid) as reply_count from (SELECT u.id as uid, u.avatar, u.name, r.content, r.created_at from users u INNER JOIN replies r ON u.id=r.user_id where r.created_at > ?) as userReply GROUP BY uid order by reply_count desc limit 8', [$prevWeek]);
            $view->with('activeUsers', $data);
        });
        //话题周榜视图注入
        \View::composer('index.layouts._topic_hot', function ($view){
            $carbon=new Carbon();
            $prevWeek=$carbon->previous()->toDateTimeString();
            $topics=DB::table('topics')->where('created_at', '>', $prevWeek)->take(15)->orderBy('reply_count', 'desc')->get();
            $view->with('topics', $topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //多用户切换
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
        //404异常
        \API::error(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            abort(404);
        });

        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });
    }
}

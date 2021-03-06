<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
//生成用户token

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weapp:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速为用户生成token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //输入前提示语
        $userId = $this->ask('输入用户 id');
        $user = User::find($userId);
        if (!$user) {
            return $this->error('您输入的用户不存在');
        }
        // 一年以后过期
        $ttl = 365*24*60;
        $this->info(\Auth::guard('api')->setTTL($ttl)->fromUser($user));
    }
}

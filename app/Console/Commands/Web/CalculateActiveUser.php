<?php

namespace App\Console\Commands\Web;

use App\Models\User;
use Illuminate\Console\Command;

class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成活跃用户并且缓存';

    /**
     *
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
       #有了这个就有命令提示
       parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(User $user)
    {
        $this->info("开始计算中...");
        $user->calculateAndCacheActiveUsers();
        $this->info("计算成功!");
    }
}

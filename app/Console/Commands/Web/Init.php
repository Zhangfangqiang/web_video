<?php

namespace App\Console\Commands\Web;

use Illuminate\Console\Command;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化 bbs 系统 创建表 填充数据等操作';

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
        $this->info("创建表格开始...");
        \Artisan::call('migrate');

        $this->info("测试数据填充开始...");
        \Artisan::call('db:seed');

        $this->info("用户活跃度计算开始...");
        \Artisan::call('web:calculate-active-user');

        $this->info("清除重复数据开始...");
        \Artisan::call('web:data-check');

        $this->info("计算数据关联数据统计...");
        \Artisan::call('web:calculate-data');
    }
}

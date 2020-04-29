<?php

namespace App\Console\Commands\Web;

use Illuminate\Console\Command;

class DataCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:data-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '数据检查的方法 主要去重';

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
        $this->info("检查中...");

        #删除category_has_contents 的重复数据
        \DB::select('
delete from category_has_contents where (category_id,content_id) in
    (select category_id,content_id from
        (select category_id,content_id from category_has_contents group by category_id,content_id having count(category_id)>1) as tmp1)
and id not in
    (select id from
        (select min(id) id from category_has_contents group by category_id,content_id having count(category_id)>1) as tmp2);
       ');

        #删除user_has_upload_records 的重复数据
        \DB::select('
delete from user_has_upload_records where (user_id,upload_record_id) in
    (select user_id,upload_record_id from
        (select user_id,upload_record_id from user_has_upload_records group by user_id,upload_record_id having count(user_id)>1) as tmp1)
and id not in
    (select id from
        (select min(id) id from user_has_upload_records group by user_id,upload_record_id having count(user_id)>1) as tmp2);
       ');

        #删除user_has_users 的重复数据
        \DB::select('
delete from user_has_users where (user_id,follow_user_id) in
    (select user_id,follow_user_id from
        (select user_id,follow_user_id from user_has_users group by user_id,follow_user_id having count(user_id)>1) as tmp1)
and id not in
    (select id from
        (select min(id) id from user_has_users group by user_id,follow_user_id having count(user_id)>1) as tmp2);
       ');

        #删除user_has_contents 的重复数据
        \DB::select('
delete from user_has_contents where (user_id,content_id) in
    (select user_id,content_id from
        (select user_id,content_id from user_has_contents group by user_id,content_id having count(user_id)>1) as tmp1)
and id not in
    (select id from
        (select min(id) id from user_has_contents group by user_id,content_id having count(user_id)>1) as tmp2);
       ');

        $this->info("检查完毕已删除重复关联数据");
    }
}

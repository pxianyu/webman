<?php

namespace process;
use support\Db;
use Workerman\Crontab\Crontab;
class CrontabTask
{
    public function onWorkerStart()
    {
//        new Crontab('*/1 * * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//
//        new Crontab('*/5 * * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//        new Crontab('*/1 * * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//        new Crontab('*/1 * * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//
//        // 每5秒执行一次
//        new Crontab('*/20 * * * * *', function(){
//            $db=Db::table('tests')->inRandomOrder()->limit(1000)->get(['text','menu_id'])->toJson();
//            $db=json_decode($db,true);
//            for ($i=0;$i<5000;$i++){
//                Db::table('tests')->insert($db);
//            }
//            echo date('Y-m-d H:i:s')."\n";
//        });
//
//        // 每分钟执行一次
//        new Crontab('0 */1 * * * *', function(){
//
//        });

//        // 每5分钟执行一次
//        new Crontab('0 */5 * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//
//        // 每分钟的第一秒执行
//        new Crontab('1 * * * * *', function(){
//            echo date('Y-m-d H:i:s')."\n";
//        });
//
//        // 每天的7点50执行，注意这里省略了秒位

    }
}
<?php
namespace app\admin\behavior;

use think\Db;
use think\Backup;

class Optimize
{
    public function run(&$param)
    {
        function_exists('set_time_limit') && set_time_limit(0);
        $tables = Db::query('SHOW TABLE STATUS');
        $tables = array_column($tables, 'Name');
        $config = $this->getConfig();
        $file = array(
            'name' => $param['filename'],
            'part' => 1,
        );
        
        $dataBase = new Backup($file, $config);

        if (false == $dataBase->create()) {
            throw new \Exception('hh');
            return false;
        }
        
        if (!is_writeable($config['path'])) {
            throw new \Exception('hh');
            return false;
        }

        //检查是否有正在执行的任务
        $lock = "{$config['path']}backup.lock";

        if (is_file($lock)) {
            return false;
        } else {
            //创建锁文件
            file_put_contents($lock, NOW_TIME);
        }
        $start = 0;
        foreach ($tables as $key => $value) {
            
            do {
                $res = $dataBase->backup($value, $start);
                if (is_array($res)) {
                    $start = $res[0];
                }
            } while (!empty($res));
            $start = 0;
        }
        unlink("{$config['path']}backup.lock");
        return true;
    }

    protected function getConfig()
    {
        $path = C('DATA_BACKUP_PATH');
        if (!is_dir($path)) {
            @mkdir($path, 0755, true);
        }
        //读取备份配置
        $config = array(
            'path' => realpath($path) . DIRECTORY_SEPARATOR,
            'part' => C('DATA_BACKUP_PART_SIZE'),
            'compress' => C('DATA_BACKUP_COMPRESS'),
            'level' => C('DATA_BACKUP_COMPRESS_LEVEL'),
        );
        return $config;
    }
}

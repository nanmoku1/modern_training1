<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class DebugClass
{
    /**
     * @param $in_var
     * @return false|string
     */
    public static function dump_str($in_var)
    {
        $message = '';

        // 1.データの処理：配列、オブジェクトは自動展開する
        if (is_array($in_var) || is_object($in_var))
        {
            // $message = print_r($in_var, true) . "\n";
            ini_set('html_errors', 0); // このphp.ini設定を0にしないと、var_dumpメソッドで出力されるダンプの内容がhtmlで整形された状態で出力される
            ob_start();
            var_dump($in_var);
            $message = ob_get_contents() . "\n";
            ob_end_clean();
        }
        else
        {
            $message = gettype($in_var) . ':::' . $in_var .':::';
        }

        // 3.デバッグ情報の付与
        $tmp_debug_backtrace = debug_backtrace();

        // 呼び出し元ファイル名、行番号、メソッド名を追記
        $fname = (isset($tmp_debug_backtrace[1]['file'])) ? 'FILE:' . $tmp_debug_backtrace[1]['file'] : '';
        $line = (isset($tmp_debug_backtrace[1]['line'])) ? ',LINE:' . $tmp_debug_backtrace[1]['line'] : '';
        $func = (isset($tmp_debug_backtrace[2]['function'])) ? ',FUNCTION:' . $tmp_debug_backtrace[2]['function'] : '';
        $message = ' ' . $message . '[' . $fname . $line . $func . ']';

        return $message;
    }

    /**
     * @param $in_var
     * @return vold
     */
    public static function clog($in_var)
    {
        Log::info(self::dump_str($in_var));
    }

    /**
     * @return void
     */
    public static function laravel_exe_sql_log_on()
    {
        DB::listen(function ($query): void {
            $sql = $query->sql;

            foreach ($query->bindings as $binding)
            {
                if (is_string($binding))
                {
                    $binding = "'{$binding}'";
                } elseif (is_bool($binding)) {
                    $binding = $binding ? '1' : '0';
                } elseif (is_int($binding)) {
                    $binding = (string) $binding;
                } elseif ($binding === null) {
                    $binding = 'NULL';
                } elseif ($binding instanceof Carbon) {
                    $binding = "'{$binding->toDateTimeString()}'";
                } elseif ($binding instanceof DateTime) {
                    $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                }

                $sql = preg_replace('/\\?/', $binding, $sql, 1);
            }

            Log::info('SQL', ['sql' => $sql, 'time' => "{$query->time} ms"]);
        });
    }
}


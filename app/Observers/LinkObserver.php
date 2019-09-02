<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2019/9/3
 * Time: 2:47
 */

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;


class LinkObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}
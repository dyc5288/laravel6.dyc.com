<?php
/**
 * 活动
 * @copyright qisuda.cn
 * @package Activity.php
 * @author duanyunchao
 * @since 2020/10/6
 * @version $Id$
 */
 namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Activity
{
    /**
     * 处理
     *
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (time() < strtotime('2020-10-06'))
        {
            return redirect('activity0');
        }

        $res = $next($request);
        echo $res->original."<br>";
        echo '后置逻辑<br>';
        return $res;
    }
}
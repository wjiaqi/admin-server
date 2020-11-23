<?php
declare (strict_types=1);
/**
 * @copyright 深圳市乐悠悠网络科技有限公司
 * @version   1.0.0
 * @link
 */

namespace App\Service\DAO;

use App\Common\Base;
use App\Model\User;

/**
 * UserDAO
 *
 * @author  小琪(991010625.com)
 * @package App\Service\DAO
 */
class UserDAO extends Base
{
    /**
     * 获取菜单列表
     *
     * @param array $maps
     * @return mixed
     */
    public function get(array $maps = [])
    {
        $model = User::query();

        if (isset($maps['status'])) {
            $model = $model->where('status', $maps['status']);
        }
        if (isset($maps['mobile'])) {
            $model = $model->where('mobile', $model['mobile']);
        }
        if (isset($maps['reg_time'])) {
            $model = $model->where('reg_time', '>=', strtotime($maps['reg_time'][0]));
            $model = $model->where('reg_time', '<=', strtotime($maps['reg_time'][1]));
        }
        if (isset($maps['login_time'])) {
            $model = $model->where('login_time', '>=', strtotime($maps['login_time'][0]));
            $model = $model->where('login_time', '<=', strtotime($maps['login_time'][1]));
        }

        $model = $model->with('userLoginRecord');

        $model = $model->orderBy('id');

        return isset($maps['perPage']) ? $model->paginate((int)$maps['perPage']) : $model->get();
    }

}
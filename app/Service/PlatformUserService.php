<?php
declare (strict_types=1);
/**
 * @copyright 深圳市乐悠悠网络科技有限公司
 * @version   1.0.0
 * @link
 */

namespace App\Service;

use App\Common\Base;
use App\Kernel\Utils\XLSWrite;
use App\Model\User;
use App\Service\DAO\UserDAO;
use Hyperf\Di\Annotation\Inject;

/**
 * PlatformUserService
 *
 * @author  小琪(991010625.com)
 * @package App\Service
 */
class PlatformUserService extends Base
{
    /**
     * 平台用户dao
     *
     * @Inject()
     * @var UserDAO
     */
    private $userDAO;

    public function get(array $params)
    {
        return $this->userDAO->get($params);
    }

    /**
     * 导出xls
     *
     * @param array $params
     *
     * @return array
     */
    public function exportToXLS(array $params): array
    {
        $userList = $this->userDAO->get($params);
        if (empty($userList)) {
            $this->error('logic.NOT_FOUNT_EXPORT_DATA');
        }
        $exportData = [];

        /** @var User $user */
        foreach ($userList as $user) {
            $exportData[] = [
                $user->id,
                $user->nickname,
                $user->mobile,
                $user->status === 1 ? 'OPEN' : 'CLOSE',
                $user->reg_ip,
                date('Y-m-d H:i:s', $user->reg_time),
                $user->login_ip,
                date('Y-m-d H:i:s', $user->login_time),
                $user->userLoginRecord->device
            ];
        }
        return di(XLSWrite::class)->createXLS(XLSWrite::USER_MODULE, $exportData);
    }
}
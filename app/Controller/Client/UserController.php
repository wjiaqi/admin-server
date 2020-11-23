<?php
declare (strict_types=1);
/**
 * @copyright 深圳市乐悠悠网络科技有限公司
 * @version   1.0.0
 * @link
 */

namespace App\Controller\Client;

use App\Controller\AbstractController;
use App\Service\PlatformUserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * UserController
 *
 * @Controller()
 *
 * @author  小琪(991010625.com)
 * @package App\Controller\Client
 */
class UserController extends AbstractController
{

    /**
     * 平台用户
     *
     * @Inject()
     * @var PlatformUserService
     */
    private PlatformUserService $platformUserService;

    /**
     * @GetMapping(path="")
     */
    public function get(): void
    {
        $params = $this->request->all();

        $result = $this->platformUserService->get($params);

        $this->success($result);
    }

    /**
     * @GetMapping(path="exportXLS")
     */
    public function exportXLS(): void
    {
        $params = $this->request->all();
        unset($params['perPage']);

        $result = $this->platformUserService->exportToXLS($params);

        $this->success($result);
    }


}
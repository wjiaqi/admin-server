<?php
declare (strict_types=1);
/**
 * @copyright 深圳市乐悠悠网络科技有限公司
 * @version   1.0.0
 * @link
 */

namespace App\Kernel\Utils;

use App\Common\Base;
use App\Service\UploadService;
use Hyperf\Contract\ConfigInterface;
use Vtiful\Kernel\Excel;
/**
 * XLSWrite
 *
 * @author  小琪(991010625.com)
 * @package App\Kernel\Utils
 */
class XLSWrite extends Base
{
    public const USER_MODULE = 'user';

    /**
     * @param string $module
     * @param array  $data
     *
     * @return array
     */
    public function createXLS(string $module, array $data): array
    {
        $excel = new Excel([
            'path' => UPLOAD_TMP_PATH
        ]);

        $config = $this->container->get(ConfigInterface::class)->get('xls_table');

        switch ($module) {
            case 'user':
                $fileArgs = [md5((string)time())];
                break;
            default:
                return [];
        }
        $fileName = sprintf($config[$module]['fileName'], ...$fileArgs);

        $filePath = $excel->fileName($fileName, 'sheet1')
            ->header($config[$module]['header'])
            ->data(
                $data
            )
            ->output();
        return  di(UploadService::class)->filePathHandle($filePath, $module);
    }
}
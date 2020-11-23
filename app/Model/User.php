<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $mobile 
 * @property string $password 
 * @property string $nickname 
 * @property string $avatar 
 * @property string $email 
 * @property int $sex 
 * @property int $birthday 
 * @property int $reg_time 
 * @property int $reg_ip 
 * @property int $status 
 * @property int $channel_id 
 * @property int $login_time 
 * @property int $login_ip
 * @property-read UserLoginRecord $userLoginRecord
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $hidden = ['password'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sex' => 'integer', 'birthday' => 'integer', 'reg_time' => 'integer', 'reg_ip' => 'integer', 'status' => 'integer', 'channel_id' => 'integer', 'login_time' => 'integer', 'login_ip' => 'integer'];


    /**
     * 自动转换为IP
     *
     * @param $value
     * @return string|void
     */
    public function getRegIpAttribute($value)
    {
        return long2ip($value);
    }

    /**
     * 自动转换为IP
     *
     * @param $value
     * @return string|void
     */
    public function getLoginIpAttribute($value)
    {
        return long2ip($value);
    }

    /**
     * 用户登录记录
     *
     * @return \Hyperf\Database\Model\Relations\HasOne
     */
    public function userLoginRecord()
    {
        return $this->hasOne(UserLoginRecord::class, 'user_id', 'id')->orderBy('id')->select(['id', 'user_id', 'device']);
    }
}
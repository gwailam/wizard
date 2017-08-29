<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Repositories;

use Carbon\Carbon;

/**
 * Class Group
 *
 * @property integer $id
 * @property string  $name
 * @property integer $user_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @package App\Repositories
 */
class Group extends Repository
{
    protected $table = 'wz_groups';
    protected $fillable
        = [
            'name',
            'user_id',
        ];

    /**
     * 分组包含的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'wz_user_group_ref', 'group_id', 'user_id');
    }

    /**
     * 分组创建者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 分组包含的项目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'wz_project_group_ref', 'group_id', 'project_id')
            ->withPivot('created_at', 'updated_at', 'privilege');
    }
}
<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserChangeLog Entity
 *
 * @property int $id
 * @property string $action
 * @property string $before_value
 * @property string $after_value
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $modified_user
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $created_user
 */
class UserChangeLog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'action' => true,
        'before_value' => true,
        'after_value' => true,
        'modified' => true,
        'modified_user' => true,
        'created' => true,
        'created_user' => true,
    ];
}

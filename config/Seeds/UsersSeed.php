<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()

     {
         $datetime = date('Y-m-d H:i:s');
         $data = [

             'username' => 'gong',
             'password' => $this->_setPassword('123456'),
             'role' => '1',
             'created' => $datetime,
             'modified' => $datetime,
         ];

         $table = $this->table('users');
         $table->insert($data)->save();
     }
    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}

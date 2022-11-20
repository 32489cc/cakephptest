<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class UserCommand extends Command
{
    public function initialize(): void
    {
        parent::initialize(); // TODO: Change the autogenerated stub

    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
               $datas=$this->fetchTable('Users')->find()->leftJoinWith('Rosters')->select(['Users.id','Users.username','Rosters.start_time'])->whereNotNull('Rosters.start_time');

                   $io->out(print_r($datas->toList()));

      // $io->out(print_r($data->toArray()));
    }
}

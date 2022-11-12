<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserChangeLog $userChangeLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User Change Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userChangeLogs form content">
            <?= $this->Form->create($userChangeLog) ?>
            <fieldset>
                <legend><?= __('Add User Change Log') ?></legend>
                <?php
                    echo $this->Form->control('action');
                    echo $this->Form->control('before_value');
                    echo $this->Form->control('after_value');
                    echo $this->Form->control('modified_user');
                    echo $this->Form->control('created_user');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

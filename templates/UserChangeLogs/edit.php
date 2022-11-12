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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userChangeLog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userChangeLog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List User Change Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userChangeLogs form content">
            <?= $this->Form->create($userChangeLog) ?>
            <fieldset>
                <legend><?= __('Edit User Change Log') ?></legend>
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

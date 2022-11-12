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
            <?= $this->Html->link(__('Edit User Change Log'), ['action' => 'edit', $userChangeLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Change Log'), ['action' => 'delete', $userChangeLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userChangeLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Change Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Change Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userChangeLogs view content">
            <h3><?= h($userChangeLog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Action') ?></th>
                    <td><?= h($userChangeLog->action) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified User') ?></th>
                    <td><?= h($userChangeLog->modified_user) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created User') ?></th>
                    <td><?= h($userChangeLog->created_user) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userChangeLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($userChangeLog->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($userChangeLog->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Before Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($userChangeLog->before_value)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('After Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($userChangeLog->after_value)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

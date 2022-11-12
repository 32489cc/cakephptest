<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\UserChangeLog> $userChangeLogs
 */
?>
<div class="userChangeLogs index content">
    <?= $this->Html->link(__('New User Change Log'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Change Logs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('action') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('modified_user') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('created_user') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userChangeLogs as $userChangeLog): ?>
                <tr>
                    <td><?= $this->Number->format($userChangeLog->id) ?></td>
                    <td><?= h($userChangeLog->action) ?></td>
                    <td><?= h($userChangeLog->modified) ?></td>
                    <td><?= h($userChangeLog->modified_user) ?></td>
                    <td><?= h($userChangeLog->created) ?></td>
                    <td><?= h($userChangeLog->created_user) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userChangeLog->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userChangeLog->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userChangeLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userChangeLog->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

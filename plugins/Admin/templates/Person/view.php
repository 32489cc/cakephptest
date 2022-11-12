<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Person'), ['action' => 'edit', $person->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Person'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Person'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="person view content">
            <h3><?= h($person->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($person->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($person->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comment') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($person->comment)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Boards') ?></h4>
                <?php if (!empty($person->boards)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Person Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Content') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->boards as $boards) : ?>
                        <tr>
                            <td><?= h($boards->id) ?></td>
                            <td><?= h($boards->person_id) ?></td>
                            <td><?= h($boards->title) ?></td>
                            <td><?= h($boards->content) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Boards', 'action' => 'view', $boards->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Boards', 'action' => 'edit', $boards->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Boards', 'action' => 'delete', $boards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $boards->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

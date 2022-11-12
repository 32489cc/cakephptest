<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $board
 * @var \Cake\Collection\CollectionInterface|string[] $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Boards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="boards form content">
            <?= $this->Form->create($board) ?>
            <fieldset>
                <legend><?= __('Add Board') ?></legend>
                <?php
                    echo $this->Form->control('person_id', ['options' => $person]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('content');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

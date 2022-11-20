<form method="post">
        <fieldset>
            <legend><?= __('Please enter your email') ?></legend>
            <?= $this->Form->control('email', ['required' => true]) ?>
            <?= $this->Form->hidden('_csrfToken' ,['autocomplete'=> 'off','value'=>$this->request->getAttribute('csrfToken') ]) ; ?>
        </fieldset>
        <?= $this->Form->submit(__('メール送信')); ?>
        <?= $this->Form->end() ?>
</form>

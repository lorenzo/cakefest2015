<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $country->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Official Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Official Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="countries form large-10 medium-9 columns">
    <?= $this->Form->create($country) ?>
    <fieldset>
        <legend><?= __('Edit Country') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('continent');
            echo $this->Form->input('region');
            echo $this->Form->input('surface_area');
            echo $this->Form->input('independence_year');
            echo $this->Form->input('population');
            echo $this->Form->input('life_expectancy');
            echo $this->Form->input('gnp');
            echo $this->Form->input('gnp_oid');
            echo $this->Form->input('local_name');
            echo $this->Form->input('government_form');
            echo $this->Form->input('head_of_state');
            echo $this->Form->input('capital_id');
            echo $this->Form->input('code');
            echo $this->Form->input('is_active');
            echo $this->Form->input('quote');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

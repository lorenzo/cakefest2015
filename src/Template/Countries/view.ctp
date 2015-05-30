<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Official Languages'), ['controller' => 'Languages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Official Language'), ['controller' => 'Languages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="countries view large-10 medium-9 columns">
    <h2><?= h($country->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= h($country->id) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($country->name) ?></p>
            <h6 class="subheader"><?= __('Region') ?></h6>
            <p><?= h($country->region) ?></p>
            <h6 class="subheader"><?= __('Local Name') ?></h6>
            <p><?= h($country->local_name) ?></p>
            <h6 class="subheader"><?= __('Government Form') ?></h6>
            <p><?= h($country->government_form) ?></p>
            <h6 class="subheader"><?= __('Head Of State') ?></h6>
            <p><?= h($country->head_of_state) ?></p>
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($country->code) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Surface Area') ?></h6>
            <p><?= $this->Number->format($country->surface_area) ?></p>
            <h6 class="subheader"><?= __('Independence Year') ?></h6>
            <p><?= $this->Number->format($country->independence_year) ?></p>
            <h6 class="subheader"><?= __('Population') ?></h6>
            <p><?= $this->Number->format($country->population) ?></p>
            <h6 class="subheader"><?= __('Life Expectancy') ?></h6>
            <p><?= $this->Number->format($country->life_expectancy) ?></p>
            <h6 class="subheader"><?= __('Gnp') ?></h6>
            <p><?= $this->Number->format($country->gnp) ?></p>
            <h6 class="subheader"><?= __('Gnp Oid') ?></h6>
            <p><?= $this->Number->format($country->gnp_oid) ?></p>
            <h6 class="subheader"><?= __('Capital Id') ?></h6>
            <p><?= $this->Number->format($country->capital_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($country->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($country->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Is Active') ?></h6>
            <p><?= $country->is_active ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Continent') ?></h6>
            <?= $this->Text->autoParagraph(h($country->continent)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Quote') ?></h6>
            <?= $this->Text->autoParagraph(h($country->quote)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Cities') ?></h4>
    <?php if (!empty($country->cities)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Country Id') ?></th>
            <th><?= __('District') ?></th>
            <th><?= __('Population') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($country->cities as $cities): ?>
        <tr>
            <td><?= h($cities->id) ?></td>
            <td><?= h($cities->name) ?></td>
            <td><?= h($cities->country_id) ?></td>
            <td><?= h($cities->district) ?></td>
            <td><?= h($cities->population) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Cities', 'action' => 'view', $cities->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Cities', 'action' => 'edit', $cities->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cities', 'action' => 'delete', $cities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cities->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Languages') ?></h4>
    <?php if (!empty($country->languages)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Country Id') ?></th>
            <th><?= __('Language') ?></th>
            <th><?= __('Is Official') ?></th>
            <th><?= __('Percentage') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($country->languages as $languages): ?>
        <tr>
            <td><?= h($languages->country_id) ?></td>
            <td><?= h($languages->language) ?></td>
            <td><?= h($languages->is_official) ?></td>
            <td><?= h($languages->percentage) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Languages', 'action' => 'view', $languages->country_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Languages', 'action' => 'edit', $languages->country_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Languages', 'action' => 'delete', $languages->country_id], ['confirm' => __('Are you sure you want to delete # {0}?', $languages->country_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

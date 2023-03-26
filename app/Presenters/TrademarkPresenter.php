<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\TrademarksModel;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;
use Nette\Forms\Container;
use Dibi\Row;

final class TrademarkPresenter extends BasePresenter
{
    public function __construct(
        private TrademarksModel $trademarks
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
    }

    public function createComponentTrademarkGrid(): DataGrid
    {
        $grid = new DataGrid();

        $grid->setDataSource($this->dibiConnection->select('*')->from('trademarks'));
        $grid->setItemsPerPageList([10, 20, 30]);

        $grid->addColumnText('name', 'Nazev')
            ->setAlign('left')
            ->setSortable();

        $grid->addAction('delete', '', 'delete!')
            ->setIcon('trash')
            ->setTitle('Smazat')
            ->setClass('btn btn-xs btn-danger ajax')
            ->setConfirmation(
                new StringConfirmation('Zda skutečně chcete smazat značku %s?', 'name')
            );

        $inlineEdit = $grid->addInlineEdit();

        $inlineEdit->onControlAdd[] = function ($container): void {
            $container->addText('name', '')
                ->setRequired('Name is required!');
        };

        $inlineEdit->onSetDefaults[] = function (Container $container, Row $row): void {
            $container->setDefaults([
                'id' => $row['id'],
                'name' => $row['name']
            ]);
        };

        $inlineEdit->onSubmit[] = function ($id, $values): void {
            $this->flashMessage('Zaznam byl uložen!', 'success');
            $this->trademarks->updateTrademarks($id,$values);
            $this->redrawControl('flashes');
        };

        $inlineEdit->setShowNonEditingColumns();


        $inlineAdd = $grid->addInlineAdd();

        $inlineAdd->setPositionTop()->setText('PŘIDAT ZNAČKU')
            ->onControlAdd[] = function ($container): void {
            $container->addText('name', '')
                ->setRequired('Field is required');
        };


        $inlineAdd->onSubmit[] = function ($values): void {
            if ($this->trademarks->insertTrademarks($values)){
                $this->flashMessage('Záznam byl uložen!', 'success');
            } else {
                $this->flashMessage('Záznam jíž existuje!', 'warning');
            }
            $this->redrawControl('flashes');
        };

        $inlineAdd->setShowNonEditingColumns();

        return $grid;
    }


    /**
     * Delete record
     *
     * @param $id
     * @return void
     */
    public function handleDelete($id): void
    {
        $this->flashMessage('Deleted!', 'info');
        $this->trademarks->deleteRecord($id);
        $this->redrawControl('flashes');
    }

}

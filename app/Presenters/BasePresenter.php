<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\DI\Attributes\Inject;
use Contributte\MenuControl\UI\MenuComponentFactory;
use Contributte\MenuControl\UI\MenuComponent;
use Nette\Application\UI\Presenter;
use Dibi\Connection;

abstract class BasePresenter extends Presenter
{
    #[Inject]
    public Connection $dibiConnection;

    /**
     * @var MenuComponentFactory
     */
    private MenuComponentFactory $menuFactory;

    public function  injectMenuComponentFactory(MenuComponentFactory $menuFactory)
    {
        $this->menuFactory = $menuFactory;
    }

    protected function createComponentMenu(): MenuComponent
    {
        return $this->menuFactory->create('default');
    }
}
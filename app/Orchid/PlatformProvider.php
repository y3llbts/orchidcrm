<?php

  declare(strict_types=1);

  namespace App\Orchid;

  use Orchid\Platform\Dashboard;
  use Orchid\Platform\ItemPermission;
  use Orchid\Platform\OrchidServiceProvider;
  use Orchid\Screen\Actions\Menu;
  use Orchid\Support\Color;

  class PlatformProvider extends OrchidServiceProvider
  {
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
      parent::boot($dashboard);

      // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
      return [
        Menu::make('Проекты')
          ->icon('bs.columns-gap')
          ->title('Навигация')
          ->route('platform.projects.list'),

        Menu::make(__('Задачи'))
          ->icon('bs.list-task')
          ->route('platform.tasks.list')
          ->permission('platform.systems.users')
          ->divider(),

        Menu::make(__('Пользователи'))
          ->icon('bs.people')
          ->route('platform.systems.users')
          ->permission('platform.systems.users')
          ->title(__('Администрирование')),

        Menu::make(__('Организации'))
          ->icon('bs.building')
          ->route('platform.organizations.list')
          ->permission('platform.systems.users'),

        Menu::make(__('Роли'))
          ->icon('bs.lock')
          ->route('platform.systems.roles')
          ->permission('platform.systems.roles')
          ->divider(),

        Menu::make('Get Started')
          ->icon('bs.book')
          ->title('Примеры')
          ->route(config('platform.index')),

        Menu::make('Example Screen')
          ->icon('bs.collection')
          ->route('platform.example')
          ->badge(fn() => 6),

        Menu::make('Form Elements')
          ->icon('bs.journal')
          ->route('platform.example.fields')
          ->active('*/form/examples/*'),

        Menu::make('Overview Layouts')
          ->icon('bs.columns-gap')
          ->route('platform.example.layouts')
          ->active('*/layout/examples/*'),

        Menu::make('Charts')
          ->icon('bs.bar-chart')
          ->route('platform.example.charts'),

        Menu::make('Cards')
          ->icon('bs.card-text')
          ->route('platform.example.cards')
      ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
      return [
        ItemPermission::group(__('System'))
          ->addPermission('platform.systems.roles', __('Roles'))
          ->addPermission('platform.systems.users', __('Users')),
      ];
    }
  }

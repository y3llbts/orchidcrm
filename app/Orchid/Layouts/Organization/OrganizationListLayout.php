<?php

namespace App\Orchid\Layouts\Organization;

use App\Models\Organization;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class OrganizationListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'organizations';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Наименование')
                ->cantHide()
                ->render(function (Organization $organization) {
                    return Link::make($organization->name)
                        ->route('platform.organizations.edit', $organization);
                }),

            TD::make('key', 'Символьный ключ')
                ->cantHide(),

            TD::make('tax_rate', 'Налоговая ставка'),

            TD::make('created_at', 'Создан')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),
            TD::make('updated_at', 'Обновлен')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),
        ];
    }
}

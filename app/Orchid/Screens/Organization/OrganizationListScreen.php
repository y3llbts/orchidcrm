<?php

namespace App\Orchid\Screens\Organization;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

use App\Orchid\Layouts\Organization\OrganizationListLayout;
use App\Models\Organization;

class OrganizationListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'organizations' => Organization::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список организаций';
    }

    public function description(): ?string
    {
        return 'Все организации, которые зарегистрированы в системе.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать организацию')
                ->icon('bs.plus-circle')
                ->route('platform.organizations.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OrganizationListLayout::class
        ];
    }
}

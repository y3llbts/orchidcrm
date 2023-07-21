<?php

namespace App\Orchid\Screens\Organization;

use App\Models\Organization;
use App\Models\User;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrganizationEditScreen extends Screen
{

    /**
     * @var Organization
     */
    public ?Organization $organization = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Organization $organization): iterable
    {
        return [
            'organization' => $organization
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->organization->exists ? 'Редактирование организации' : 'Создание организации';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать организацию')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->organization->exists),

            Button::make('Сохранить изменения')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->organization->exists),

            Button::make('Удалить организацию')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->organization->exists),
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
            Layout::rows([
                Group::make([
                    Input::make('organization.name')
                        ->title('Наименование')
                        ->placeholder('Введите название организации...'),

                    Input::make('organization.tax_rate')
                        ->title('Налоговая ставка')
                        ->placeholder('Введите налоговую ставку...'),
                ]),
                Group::make([
                    Input::make('organization.key')
                        ->title('Символьный ключ')
                        ->placeholder('Введите символьный ключ...')
                        ->help('Буквенное обозначение из трех-четырех латинских букв'),

                    Relation::make('organization.user_admin')
                        ->title('Ответственный организации')
                        ->fromModel(User::class, 'id')
                ])
            ])
        ];
    }

    public function createOrUpdate(Organization $organization, Request $request)
    {
        $organization->fill($request->get('organization'))->save();

        Toast::success(__('Операция успешно выполнена'));

        return redirect()->route('platform.organizations.list');
    }

    public function remove(Organization $organization)
    {
        $organization->delete();

        Toast::success(__('Организация успешно удалена'));

        return redirect()->route('platform.organizations.list');
    }
}

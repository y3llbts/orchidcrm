<?php

  namespace App\Orchid\Screens\Project;

  use App\Models\Organization;
  use App\Models\Project;

  use Orchid\Screen\Fields\DateTimer;
  use Orchid\Screen\Fields\Quill;
  use Orchid\Screen\Screen;
  use Illuminate\Http\Request;
  use Orchid\Screen\Actions\Button;
  use Orchid\Screen\Fields\Group;
  use Orchid\Screen\Fields\Input;
  use Orchid\Screen\Fields\Relation;
  use Orchid\Support\Facades\Layout;
  use Orchid\Support\Facades\Toast;

  class ProjectEditScreen extends Screen
  {

    /**
     * @var Project
     */
    public ?Project $project = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Project $project): iterable
    {
      return [
        'project' => $project
      ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
      return $this->project->exists ? 'Редактирование проекта' : 'Создание проекта';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
      return [
        Button::make('Создать проект')
          ->icon('pencil')
          ->method('createOrUpdate')
          ->canSee(!$this->project->exists),

        Button::make('Сохранить изменения')
          ->icon('pencil')
          ->method('createOrUpdate')
          ->canSee($this->project->exists),

        Button::make('Удалить проект')
          ->icon('trash')
          ->method('remove')
          ->canSee($this->project->exists),
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
            Input::make('project.name')
              ->title('Наименование')
              ->placeholder('Введите наименование проекта...'),

            Input::make('project.key')
              ->title('Символьный ключ')
              ->placeholder('Введите символьный ключ...'),

            Relation::make('project.org')
              ->title('Организация')
              ->fromModel(Organization::class, 'name'),

            DateTimer::make('project.start_date')
              ->title('Дата начала')
              ->placeholder('Введите дату начала работ...'),

            DateTimer::make('project.finish_date')
              ->title('Дата окончания')
              ->placeholder('Введите дату окончания работ...')
          ]),

          Group::make([
            Quill::make('project.description')
              ->title('Описание проекта'),
          ]),
        ])
      ];
    }

    public function createOrUpdate(Project $project, Request $request)
    {
      $project->fill($request->get('project'))->save();

      Toast::success(__('Операция успешно выполнена'));

      return redirect()->route('platform.projects.list');
    }

    public function remove(Project $project)
    {
      $project->delete();

      Toast::success(__('Проект успешн удален'));

      return redirect()->route('platform.projects.list');
    }
  }

<?php

  namespace App\Orchid\Screens\Tasks;

  use App\Models\Project;
  use App\Models\Task;

  use Illuminate\Http\Request;
  use Orchid\Screen\Actions\Button;
  use Orchid\Screen\Fields\Group;
  use Orchid\Screen\Fields\Input;
  use Orchid\Screen\Fields\Quill;
  use Orchid\Screen\Fields\Relation;
  use Orchid\Screen\Screen;
  use Orchid\Support\Facades\Layout;
  use Orchid\Support\Facades\Toast;

  class TasksEditScreen extends Screen
  {

    /**
     * @var Task
     */
    public ?Task $task = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Task $task): iterable
    {
      return [
        'task' => $task
      ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
      return $this->task->exists ? 'Редактирование задачи' : 'Создание задачи';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
      return [
        Button::make('Создать задачу')
          ->icon('pencil')
          ->method('createOrUpdate')
          ->canSee(!$this->task->exists),

        Button::make('Сохранить изменения')
          ->icon('pencil')
          ->method('createOrUpdate')
          ->canSee($this->task->exists),

        Button::make('Удалить задачу')
          ->icon('trash')
          ->method('remove')
          ->canSee($this->task->exists),
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
            Input::make('task.name')
              ->title('Наименование')
              ->placeholder('Введите наименование задачи...'),

            Relation::make('task.project')
              ->title('Проект')
              ->fromModel(Project::class, 'name')
          ]),

          Group::make([
            Quill::make('task.description')
              ->title('Описание')
              ->placeholder('Введите описание задачи...'),
          ])
        ])
      ];
    }

    public function createOrUpdate(Task $task, Request $request)
    {
      $task->fill($request->get('task'))->save();

      Toast::success(__('Операция успешно выполнена'));

      return redirect()->route('platform.tasks.list');
    }

    public function remove(Task $task)
    {
      $task->delete();

      Toast::success(__('Задача успешно удалена'));

      return redirect()->route('platform.tasks.list');
    }
  }

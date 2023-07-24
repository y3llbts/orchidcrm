<?php

  namespace App\Orchid\Layouts\Task;

  use App\Models\Task;

  use Orchid\Screen\Layouts\Table;
  use Orchid\Screen\TD;
  use Orchid\Screen\Actions\Link;

  class TaskListLayout extends Table
  {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'task';

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
          ->render(function (Task $task) {
            return Link::make($task->name)
              ->route('platform.tasks.edit', $task);
          }),

        TD::make('project', 'Проект')
          ->render(function (Task $task) {
            return Link::make($task->project)
              ->route('platform.projects.edit', $task->project);
          }),

        TD::make('status', 'Статус')
      ];
    }
  }

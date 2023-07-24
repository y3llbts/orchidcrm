<?php

  namespace App\Orchid\Layouts\Project;

  use App\Models\Organization;
  use App\Models\Project;
  use Orchid\Screen\Components\Cells\DateTimeSplit;
  use Orchid\Screen\Layouts\Table;
  use Orchid\Screen\TD;
  use Orchid\Screen\Actions\Link;

  class ProjectListLayout extends Table
  {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'project';

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
          ->render(function (Project $project) {
            return Link::make($project->name)
              ->route('platform.projects.edit', $project);
          }),

        TD::make('key', 'Символьный ключ')
          ->cantHide(),

        TD::make('org', 'Организация')
          ->render(function (Project $project) {
            return Link::make($project->org)
              ->route('platform.organizations.edit', $project->org);
          }),

        TD::make('start_date', 'Дата начала работ')
          ->usingComponent(DateTimeSplit::class)
          ->align(TD::ALIGN_RIGHT)
          ->sort(),

        TD::make('finish_date', 'Дата окончания работ')
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

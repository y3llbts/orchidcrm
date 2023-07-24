<?php

  namespace App\Orchid\Screens\Project;

  use App\Orchid\Layouts\Project\ProjectListLayout;
  use Orchid\Screen\Actions\Link;
  use Orchid\Screen\Screen;
  use App\Models\Project;

  class ProjectListScreen extends Screen
  {
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
      return [
        'project' => Project::paginate()
      ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
      return 'Список проектов';
    }

    public function description(): ?string
    {
      return 'Все проекты, добавленные в систему.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
      return [
        Link::make('Создать проект')
          ->icon('bs.plus-circle')
          ->route('platform.projects.create')
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
        ProjectListLayout::class
      ];
    }
  }

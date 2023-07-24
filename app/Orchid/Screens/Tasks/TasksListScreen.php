<?php

namespace App\Orchid\Screens\Tasks;

use App\Models\Task;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

use App\Orchid\Layouts\Task\TaskListLayout;

class TasksListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tasks' => Task::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список задач';
    }

    public function description(): ?string
    {
        return 'Все задачи, созданные в системе.';
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
                ->route('platform.tasks.create')
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
            TaskListLayout::class
        ];
    }
}

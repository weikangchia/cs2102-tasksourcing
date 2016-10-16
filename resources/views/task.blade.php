    @extends('master')

    @section('title', 'Task')

    @section('sidebar-active-item')
    <a class="active item">Task</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="sixteen wide column">
          <h2>{{ $task->task_name }}</h2>
          <a class="ui image label">
            <img src="{{ asset('img/users/'.$task->posted_by_profile_photo) }}"> {{ $task->posted_by_username }}
          </a>
          <div class="ui label">{{ $task->category_name }}</div>
          <div class="ui hidden divider"></div>
          <p>{{ $task->task_description }}</p>
          <p>Cash value: ${{ number_format($task->cash_value, 2) }}</p>
          <p>Location: {{ $task->location}}</p>
          <img src="{{ 'https://maps.googleapis.com/maps/api/staticmap?center='.$task->postal_code.'&zoom=14&markers=color:blue%7Clabel:S%7C'.$task->postal_code.'&size=380x280&key=AIzaSyBBWn7y_jI3CPCuXJ5KE6VdsVXcp2X6p9c' }}">
          <div class="ui hidden divider"></div>
          @if(Auth::id() == $task->posted_by_id or Auth::user()-> role == 1)
            {{ link_to_route('tasks.edit', 'Edit', $task->t_id, array('class' => 'ui blue button')) }}
            <a href="javascript: $('.ui.small.modal').modal('show');" class="ui red button">Delete</a>
          @else
          <button class="ui blue button">Bid</button>
          @endif
        </div>
      </div>
    </div>

    <div class="ui small modal">
      <div class="header">
        <i class="warning sign icon"></i>
        Delete Task: {{ $task->task_name }}
      </div>
      <div class="content">
        Are you sure you want to delete this task? This action cannot be undone.
      </div>
      <div class="actions">
        {{ Form::open(array('route' => array('tasks.destroy', $task->t_id), 'method' => 'delete')) }}
          {{ Form::button('Cancel', array('class' => 'ui cancel button')) }}
          {{ Form::submit('Delete', array('class' => 'ui red button')) }}
        {{ Form::close() }}
      </div>
    </div>

    @stop

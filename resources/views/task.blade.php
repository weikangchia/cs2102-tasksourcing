    @extends('master')

    @section('title', 'Task')

    @section('sidebar-active-item')
    <a class="active item">Task</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="sixteen wide column">
          <h2>{{ $task[0]->task_name }}</h2>
          <a class="ui image label">
            <img src="{{ asset('img/users/'.$task[0]->profile_photo) }}"> {{ $task[0]->username }}
          </a>
          <div class="ui label">{{ $task[0]->category_name }}</div>
          <div class="ui hidden divider"></div>
          <p>{{ $task[0]->task_description }}</p>
          <p>Cash value: ${{ number_format($task[0]->cash_value, 2) }}</p>
          <p>Location: {{ $task[0]->location}}</p>
          <img src="{{ 'https://maps.googleapis.com/maps/api/staticmap?center='.$task[0]->postal_code.'&zoom=14&markers=color:blue%7Clabel:S%7C'.$task[0]->postal_code.'&size=380x280&key=AIzaSyBBWn7y_jI3CPCuXJ5KE6VdsVXcp2X6p9c' }}">
          <div class="ui hidden divider"></div>
          @if(Auth::id() == $task[0]->user_id)
            <button class="ui blue button">Edit</button>
            <button class="ui red button">Delete</button>
          @else
          <button class="ui blue button">Bid</button>
          @endif
        </div>
      </div>
    </div>

    @stop

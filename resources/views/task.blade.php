    @extends('master')

    @section('title', 'Task')

    @section('sidebar-active-item')
    <a class="active item">Task</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="eight wide column">
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
          
          <div class="ui comments">
            <h4 class="ui dividing header">Comments</h4>
            <div class="comment">
              <a class="avatar">
                <img src="{{ asset('img/square-image.png') }}">
              </a>
              <div class="content">
                <a class="author">Author</a>
                <div class="metadata">
                  <div class="date">1 day ago</div>
                </div>
                <div class="text">
                  <p>Comments</p>
                </div>
              </div>
            </div>
            <div class="comment">
              <a class="avatar">
                <img src="{{ asset('img/square-image.png') }}">
              </a>
              <div class="content">
                <a class="author">Author</a>
                <div class="metadata">
                  <div class="date">1 day ago</div>
                </div>
                <div class="text">
                  <p>Comments</p>
                </div>
              </div>
            </div>
            <form class="ui reply form">
              <div class="field">
                <textarea></textarea>
              </div>
              <div class="ui primary submit labeled icon button">
                <i class="icon edit"></i> Add Comment
              </div>
            </form>
          </div>
        </div>
        @if(Auth::id() == $task->posted_by_id or Auth::user()-> role == 1)
        <div class="eight wide column">
          <h3>Bid Logs</h3>
          <table class="ui very basic collapsing celled table">
            <thead>
              <tr><th>Bidders</th>
              <th>Amount</th>
              <th>Action</th>
            </tr></thead>
            <tbody>
              <tr>
                <td>
                  <h4 class="ui image header">
                    <img src="{{ asset('img/square-image.png') }}" class="ui mini rounded image">
                    <div class="content">
                      Bidders name
                      <div class="sub header">Reputation here
                    </div>
                  </div>
                </h4></td>
                <td>
                  20
                </td>
                <td>
                  <button class="ui green button">Accept</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        @endif
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

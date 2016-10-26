    @extends('master')

    @section('title', 'Tasks')

    @section('sidebar-active-item')
    <a class="active item">Tasks</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="twelve wide column">
          <h2>Available Tasks</h2>
          {{ link_to_route('tasks.create', 'Create a task', '', array('class' => 'ui blue button')) }}

          @if($tasks)
          <table class="ui celled table green">
            <thead>
              <tr><th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Posted by</th>
              </tr></thead>
              <tbody>
                @foreach($tasks as $task)
                <tr class="top aligned">
                  <td>{{ link_to_route('tasks.show', $task->task_name, $task->t_id)}}</td>
                  <td>{!! $task->task_description !!}<br><br>Location: {{ $task->location }}</td>
                  <td>{{ $task->category_name }}</td>
                  <td>
                    <h4 class="ui image header">
                      <div class="content">
                        {{ $task->username }}
                        <div class="sub header">{{ $task->reputation }}</div>
                      </div>
                    </h4>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h4>No tasks found.</h4>
            @endif
        </div>
        <div class="four wide column">
          <h4>Refine search</h4>

          @if($request)
          {{ Form::model($request, array('route' => 'tasks.search', 'class' => 'ui form', 'method' => 'get')) }}
          @else
          {{ Form::open(array('route' => 'tasks.search', 'class' => 'ui form', 'method' => 'get')) }}
          @endif
            <div class="field">
              {{ Form::label('category_id', 'Filter by categories:') }}
              {{ Form::select('category_id[]', $categories, null, array('class' => 'ui fluid dropdown', 'multiple' => '')) }}
            </div>
            <div class="field">
              {{ Form::label('date', 'Only show tasks after:') }}
              <div class="ui calendar">
                <div class="ui input left icon" style="width: 100%">
                  <i class="calendar icon"></i>
                  {{ Form::text('date', null, array('placeholder' => 'Date'))}}
                </div>
              </div>
            </div>
            <div class="field">
            {!! Form::submit('Search', array('class' => 'ui primary submit button')) !!}
            {{ link_to_route('tasks.index', 'Reset', '', array('class' => 'ui button')) }}
            </div>
          {{ Form::close() }}


        </div>
      </div>
    </div>

    @stop

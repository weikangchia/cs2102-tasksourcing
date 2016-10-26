    @extends('master')

    @section('title', 'Tasks')

    @section('sidebar-active-item')
    <a class="active item">Edit Task</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="twelve wide column">
          <h2>Edit Task</h2>

          {{ Form::model($task, array('route' => array('tasks.update', $task->t_id), 'method' => 'PUT', 'class' => 'ui form', 'files' => true)) }}

          <div class="fields">
            <!-- name -->
            <div class="nine wide field">
              {{ Form::label('task_name', 'Name') }}
              {{ Form::text('task_name', null, array('placeholder' => 'Name')) }}
            </div>

            <!-- category -->
            <div class="seven wide field">
              {{ Form::label('category_id', 'Category') }}
              {{ Form::select('category_id', $categories, null, array('class' => 'ui fluid dropdown')) }}
            </div>
          </div>

          <!-- description -->
          <div class="field">
            {{ Form::label('task_description', 'Description') }}
            {{ Form::textarea('task_description', null, array('rows' => '2', 'placeholder' => 'Description')) }}
          </div>

          <div class="fields">
            <!-- start date -->
            <div class="seven wide field">
              {{ Form::label('start_date', 'Start Date') }}
              <div class="ui calendar">
                <div class="ui input left icon" style="width: 100%">
                  <i class="calendar icon"></i>
                  {{ Form::text('start_date', null, array('placeholder' => 'Date'))}}
                </div>
              </div>
            </div>

            <!-- start time -->
            <div class="three wide field">
              {{ Form::label('start_time', 'Start Time') }}
              <div class="fields">
                <!-- hour -->
                <div class="field">
                  {{ Form::select('start_hour', $hours, null, array('class' => 'ui fluid search dropdown')) }}
                </div>
                <!-- minute -->
                <div class="field">
                  {{ Form::select('start_minute', $minutes, null, array('class' => 'ui fluid search dropdown')) }}
                </div>
              </div>
            </div>

            <!-- duration -->
            <div class="six wide field">
              {{ Form::label('duration', 'Duration (in minutes)') }}
              {{ Form::text('duration', null, array('placeholder' => 'Duration (in minutes)')) }}
            </div>
          </div>

          <div class="fields">
            <!-- location -->
            <div class="eight wide field">
              {{ Form::label('location', 'Location') }}
              {{ Form::text('location', null, array('placeholder' => 'Location')) }}
            </div>

            <!-- postal code -->
            <div class="four wide field">
              {{ Form::label('postal_code', 'Postal Code') }}
              {{ Form::text('postal_code', null, array('placeholder' => 'Postal Code')) }}
            </div>

            <div class="four wide field">
              {{ Form::label('cash_value', "Cash Value") }}
              <div class="ui labeled input">
                <div class="ui label">$</div>
                {{ Form::text('cash_value', null, array('placeholder' => 'Amount')) }}
              </div>
            </div>
          </div>

          <div class="field">
            {!! Form::submit('Save Changes', array('class' => 'ui primary submit button')) !!}
          </div>

          @if(count($errors))
          <div class="ui form error">
            <div class="ui error message">
              <ul class="list">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif

          {{ Form::close() }}
        </div>
      </div>
    </div>

    @stop

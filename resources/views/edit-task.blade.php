    @extends('master')

    @section('title', 'Tasks')

    @section('sidebar-active-item')
    <a class="active item">Edit Task</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="column">
          <h2>Edit Task</h2>

          {{ Form::model($task, array('route' => array('tasks.update', $task->id), 'method' => 'PUT', 'class' => 'ui form', 'files' => true)) }}

          <div class="fields">
            <!-- name -->          
            <div class="nine wide field">
              {{ Form::label('name', 'Name') }}
              {{ Form::text('name', null, array('placeholder' => 'Name')) }}
            </div>

            <!-- category -->
            <div class="seven wide field">
              {{ Form::label('category', 'Category') }}
              {{ Form::select('category', array(1 => 'Everything Else', 2 => 'Delivery and Removals', 3 => 'Cleaning', 4 => 'Fix Stuff'), null, array('class' => 'ui fluid dropdown')) }}
            </div>
          </div>

          <!-- description -->
          <div class="field">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('rows' => '2', 'placeholder' => 'Description')) }}
          </div>

          <div class="fields">
            <!-- start date -->
            <div class="six wide field">
              {{ Form::label('start_date', 'Start Date') }}
              <div class="ui buttons">
                <div class="ui scrolling dropdown search button">
                  <span class="text">{{ $task->start_day }}</span>
                  <div class="menu">
                    @foreach($days as $day)
                    <div class="item">{{ $day }}</div>
                    @endforeach
                  </div>
                </div>

                <div class="ui scrolling dropdown search button">
                  <span class="text">{{ $months[$task->start_month] }}</span>
                  <div class="menu">
                    @foreach($months as $month)
                    <div class="item">{{ $month }}</div>
                    @endforeach
                  </div>
                </div>

                <div class="ui scrolling dropdown search button">
                  <span class="text">{{ $task->start_year }}</span>
                  <div class="menu">
                    @foreach($years as $year)
                    <div class="item">{{ $year }}</div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            <!-- start time -->
            <div class="four wide field">
              {{ Form::label('start_time', 'Start Time') }}
              <div class="ui buttons">
                <div class="ui scrolling dropdown search button">
                  <span class="text">{{ sprintf('%02d', $task->start_hour) }}</span>
                  <div class="menu">
                    @foreach($hours as $hour)
                    <div class="item">{{ sprintf('%02d', $hour) }}</div>
                    @endforeach
                  </div>
                </div>

                <div class="ui scrolling dropdown search button">
                  <span class="text">{{ sprintf('%02d', $task->start_minute) }}</span>
                  <div class="menu">
                    @foreach($minutes as $minute)
                    <div class="item">{{ sprintf('%02d', $minute) }}</div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            <div class="six wide field">
              {{ Form::label('duration', 'Duration (in minutes)') }}
              {{ Form::text('duration', null, array('placeholder' => 'Duration')) }}
            </div>

          </div>

          <div class="fields">
            <!-- location -->
            <div class="seven wide field">
              {{ Form::label('location', 'Location') }}
              {{ Form::text('location', null, array('placeholder' => 'Location')) }}
            </div>

            <!-- postal code -->
            <div class="four wide field">
              {{ Form::label('postal_code', 'Postal Code') }}
              {{ Form::text('postal_code', null, array('placeholder' => 'Postal Code')) }}
            </div>

            <div class="five wide field">
              {{ Form::label('cash_value', "Cash Value") }}
              <div class="ui labeled input">
                <div class="ui label">$</div>
                {{ Form::text('cash_value', null, array('placeholder' => 'Amount')) }}
              </div>
            </div>
          </div>

          {{ Form::submit('Save Changes', array('class' => 'ui primary submit button')) }}

          {{ Form::close() }}
        </div>
      </div>
    </div>

    @stop

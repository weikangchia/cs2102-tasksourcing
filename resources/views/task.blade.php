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
            @if($task->posted_by_profile_photo == '')
              <img src="{{ asset('img/square-image.png') }}">{{ $task->posted_by_username }}
            @else
              <img src="{{ asset('img/users/'.$task->posted_by_profile_photo) }}">{{ $task->posted_by_username }}
            @endif
          </a>
          <div class="ui label">{{ $task->category_name }}</div>
          <div class="ui hidden divider"></div>
          <p>{{ $task->task_description }}</p>
          <p>Cash value: ${{ number_format($task->cash_value, 2) }}</p>
          <p>Location: {{ $task->location}}</p>
          <p>Date: {{ $task->start_date }}</p>
          <p>Time: {{ date('h:i A', strtotime($task->start_time)) }} - {{ date('h:i A', strtotime("+".$task->duration." minutes", strtotime($task->start_time))) }}</p>
          <img src="{{ 'https://maps.googleapis.com/maps/api/staticmap?center='.$task->postal_code.'&zoom=14&markers=color:blue%7Clabel:S%7C'.$task->postal_code.'&size=380x280&key=AIzaSyBBWn7y_jI3CPCuXJ5KE6VdsVXcp2X6p9c' }}">
          <div class="ui hidden divider"></div>
          @if(Auth::id() == $task->posted_by_id or Auth::user()-> role == 1)
            {{ link_to_route('tasks.edit', 'Edit', $task->t_id, array('class' => 'ui blue button')) }}
            <a href="javascript: $('.ui.small.modal').modal('show');" class="ui red button">Delete</a>
          @else
            @if($hasBidded)
              {{ Form::model($bids[0], array('route' => array('bid.update', $bids[0]->id), 'method' => 'PUT', 'class' => 'ui form', 'files' => true)) }}
                <div class="four wide field">
                  {{ Form::label('bid_amount', "Bid Value") }}
                  <div class="ui labeled input">
                    <div class="ui label">$</div>
                    {{ Form::text('bid_amount', null, array('placeholder' => 'Amount')) }}
                  </div>
                </div>
                {{ Form::hidden('t_id', $task->t_id) }}
                {{ Form::submit('Update', array('class' => 'ui blue button')) }}
              {!! Form::close() !!}
            @else
              {!! Form::open(array('route' => 'bid.store', 'class' => 'ui form')) !!}
                <div class="four wide field">
                  {{ Form::label('bid_amount', "Bid Value") }}
                  <div class="ui labeled input">
                    <div class="ui label">$</div>
                    {{ Form::text('bid_amount', null, array('placeholder' => 'Amount')) }}
                  </div>
                </div>
                {{ Form::hidden('t_id', $task->t_id) }}
                {{ Form::submit('Bid', array('class' => 'ui blue button')) }}
              {!! Form::close() !!}
            @endif
          @endif
          <div class="ui comments">
            <h4 class="ui dividing header">Comments</h4>
            @foreach($comments as $comment)
            <div class="comment">
              <a class="avatar">
                @if($comment->profile_photo == '')
                  <img src="{{ asset('img/square-image.png') }}" class="ui mini rounded image">
                @else
                  <img src="{{ asset('img/users/'.$comment->profile_photo) }}" class="ui mini rounded image">
                @endif
              </a>
              <div class="content">
                <a class="author">{{ $comment->username }}</a>
                <div class="metadata">
                  <div class="date">{{ $comment-> posted_date }}</div>
                </div>
                <div class="text">
                  <p>{{ $comment->detail }}</p>
                </div>
              </div>
            </div>
            @endforeach
            {!! Form::open(array('method' => 'post', 'route' => 'comment.store', 'class' => 'ui reply form')) !!}
              <div class="field">
                {!! Form::textarea('comment', null) !!}
                {{ Form::hidden('t_id', $task->t_id) }}
              </div>
            {!! Form::token() !!}
            {!! Form::button('<i class="icon edit"></i> Add Comments', array('type' => 'submit', 'class' => 'ui primary submit labeled icon button')) !!}
            {!! Form::close() !!}
          </div>
        </div>
        @if(Auth::id() == $task->posted_by_id or Auth::user()-> role == 1)
        <div class="eight wide column">
          <h3>Bid Logs</h3>

          @if($bids)
          <table class="ui very basic collapsing celled table">
            <thead>
              <tr><th>Bidders</th>
              <th>Amount</th>
              <th>Action</th>
            </tr></thead>
            <tbody>
              @foreach($bids as $bid)
                <tr>
                  <td>
                    <h4 class="ui image header">
                      @if($bid->profile_photo == '')
                        <img src="{{ asset('img/square-image.png') }}" class="ui mini rounded image">
                      @else
                        <img src="{{ asset('img/users/'.$bid->profile_photo) }}" class="ui mini rounded image">
                      @endif
                      <div class="content">
                        {{ $bid->username }}
                        <div class="sub header">{{ $bid->reputation }}
                      </div>
                    </div>
                  </h4></td>
                  <td>
                    ${{ number_format($bid->bid_amount, 2) }}
                  </td>
                  <td>
                    @if(strcmp($bid->status, 'accepted') == 0)
                      {!! Form::open(array('route' => array('handleRejectBid', ''), 'method' => 'post', 'class' => 'ui form')) !!}
                      {{ Form::hidden('b_id', $bid->b_id) }}
                      {{ Form::hidden('t_id', $task->t_id) }}
                      {{ Form::submit('Reject', array('class' => 'ui red button')) }}
                      {!! Form::close() !!}
                    @else
                      {!! Form::open(array('route' => array('handleAcceptBid', ''), 'method' => 'post', 'class' => 'ui form')) !!}
                      {{ Form::hidden('b_id', $bid->b_id) }}
                      {{ Form::hidden('t_id', $task->t_id) }}
                      {{ Form::submit('Accept', array('class' => 'ui green button')) }}
                      {!! Form::close() !!}
                    @endif

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <h4>No bids yet.</h4>
          @endif
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

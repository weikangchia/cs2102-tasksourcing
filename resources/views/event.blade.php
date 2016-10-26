    @extends('master')

    @section('title', 'Event')

    @section('sidebar-active-item')
    <a class="active item">Event</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="sixteen wide column">
        <h2>Events</h2>
            <table class="ui fixed table">
            <thead>
                <tr><th>Name</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Contact</th>
            </tr></thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                <td>{{ link_to_route('tasks.show', $event->task_name, $event->t_id)}}</td>
                <td>{{ $event->status }}</td>
                <td>${{ number_format($event->bid_amount, 2) }}</td>
                <td><a href="{{ 'mailto:'.$event->posted_by_email }}">{{ $event->posted_by_username }}</a></td>
                </tr>
                @endforeach
            </tbody>
            </table>
          <div style="height: 180px"></div>
        </div>
      </div>
    </div>

    @stop

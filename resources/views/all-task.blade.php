    @extends('master')

    @section('title', 'Tasks')

    @section('sidebar-active-item')
    <a class="active item">Tasks</a>
    @stop

    @section('content')
    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="sixteen wide column">
          <h2>Available Tasks</h2>
          <table class="ui celled table green">
            <thead>
              <tr><th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Posted by</th>
              </tr></thead>
              <tbody>
                <tr class="top aligned">
                  <td>{{ $task->name }}</td>
                  <td>{!! $task->description !!}</td>
                  <td>{{ $task->category }}</td>
                  <td>
                    <h4 class="ui image header">
                      <img src="{{ asset('img/users/'.$task->posted_by_url) }}" class="ui mini avatar image">
                      <div class="content">
                        {{ $task->posted_by }}
                      </div>
                    </h4>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr><th colspan="5">
                  <div class="ui right floated pagination menu">
                    <a class="icon item">
                      <i class="left chevron icon"></i>
                    </a>
                    <a class="item">1</a>
                    <a class="item">2</a>
                    <a class="item">3</a>
                    <a class="item">4</a>
                    <a class="icon item">
                      <i class="right chevron icon"></i>
                    </a>
                  </div>
                </th>
              </tr></tfoot>
            </table>
        </div>
      </div>
    </div>

    @stop

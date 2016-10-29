    @extends('master')

    @section('title', 'Tasks')

    @section('sidebar-active-item')
    <a class="active item">Profile</a>
    @stop

    @section('content')

    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="four wide column center aligned">
          @if($user->profile_photo == '')
          <img class="ui small circular image centered" src="{{ asset('img/square-image.png') }}">
          @else
          <img class="ui small circular image centered" src="{{ asset('img/users/'.$user->profile_photo) }}">
          @endif
          <div class="ui hidden divider"></div>

          <div class="ui big label blue">
            {{ $user->username }}
          </div>

        </div>
        <div class="ten wide column">
          <h2>Edit Profile</h2>
          Joined TaskHopper @ {{ date('M d, Y', strtotime($user->created_at)) }}

          <br/><br/>
          @if($user->completed_all)
          <i class="trophy icon"></i> Posted tasks from all category
          @endif

          <br/><br/>

          {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'ui form', 'files' => true)) }}
          <div class="field">
            <label>Name</label>
            <div class="two fields">
              <div class="field">
                {{ Form::text('first_name', $value = null, array('placeholder' => 'First Name')) }}
              </div>
              <div class="field">
                {{ Form::text('last_name', null, array('placeholder' => 'Last Name')) }}
              </div>
            </div>
          </div>

          <div class="field">
            {{ Form::label('profile_photo', 'Profile photo') }}
            {{ Form::file('profile_photo', array('accept' => '.jpeg,.jpg,.png')) }}
          </div>

          <div class="field">
            {{ Form::label('bio', 'Bio') }}
            {{ Form::textarea('bio', null, array('rows' => '2')) }}
          </div>

          <div class="field">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, array('placeholder' => 'Email')) }}
          </div>

          <div class="field">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', null, array('placeholder' => 'Password')) }}
          </div>

          <div class="field">
            {{ Form::label('password_confirm', 'Confirm password') }}
            {{ Form::password('password_confirm', null, array('placeholder' => 'Confirm Password')) }}
          </div>

          {!! Form::submit('Save', array('class' => 'ui large teal submit button')) !!}

          @if(count($errors))
          <div class="ui hidden divider"></div>

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

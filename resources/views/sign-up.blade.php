<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Sign Up - TaskHopper</title>
  <link rel="stylesheet" type="text/css" href="../css/semantic.min.css">

  <script src="../js/jquery.min.js"></script>
  <script src="../js/semantic.min.js"></script>

  <style type="text/css">
  body {
    background-color: #DADADA;
  }
  body > .grid {
    height: 100%;
  }
  .image {
    margin-top: -100px;
  }
  .column {
    max-width: 450px;
  }
  </style>
  <script>

  </script>
</head>
<body>

  <div class="ui middle aligned center aligned grid container">
    <div class="column">
      <h2 class="ui teal header">
        <div class="content">
          Sign Up
        </div>
      </h2>
      {!! Form::open(array('route' => 'users.store', 'class' => 'ui form')) !!}
      <div class="ui stacked segment">
        <h3 class="left aligned">
          Get Started Now
        </h3>
        <p>Create an account to submit and pick a task in our community!</p>
        <div class="field">
          <div class="ui left icon input">
            <i class="mail icon"></i>
            {!! Form::text('email', null, array('placeholder' => 'Email')) !!}
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            {!! Form::text('username', null, array('placeholder' => 'Username')) !!}
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            {!! Form::password('password', array('placeholder' => 'Password')) !!}
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            {!! Form::password('password_confirm', array('placeholder' => 'Confirm password')) !!}
          </div>
        </div>
        {!! Form::token() !!}
        {!! Form::submit('Sign Up', array('class' => 'ui fluid large teal submit button')) !!}
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
      {!! Form::close() !!}

      <div class="ui message">
        <p>If you already have an account, {{ link_to_route('login', 'Log In') }} here</p>
      </div>
    </div>
  </div>
</body>
</html>

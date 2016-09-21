<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login - TaskHopper</title>
  <link rel="stylesheet" type="text/css" href="css/semantic.min.css">

  <script src="js/jquery.min.js"></script>
  <script src="js/semantic.min.js"></script>

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
  $(document).ready(function() {
    $('.ui.form').form({
      fields: {
        email: {
          identifier  : 'email',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter your e-mail'
            },
            {
              type   : 'email',
              prompt : 'Please enter a valid e-mail'
            }
          ]
        },
        password: {
          identifier  : 'password',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter your password'
            },
            {
              type   : 'length[6]',
              prompt : 'Your password must be at least 6 characters'
            }
          ]
        }
      }
    });
  });
  </script>
</head>
<body>

  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <img src="assets/images/logo.png" class="image">
        <div class="content">
          Log In to your account
        </div>
      </h2>
      {!! Form::open(array('route' => 'handleLogin', 'class' => 'ui form')) !!}
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            {!! Form::text('email', null, array('placeholder' => 'Email')) !!}
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            {!! Form::password('password', array('placeholder' => 'Password')) !!}
          </div>
        </div>
        {!! Form::token() !!}
        {!! Form::submit('Login', array('class' => 'ui fluid large teal submit button')) !!}
      </div>

      <div class="ui error message"></div>
      {!! Form::close() !!}
      <div class="ui message">
        New to us? <a href="join">Sign Up</a>
      </div>
    </div>
  </div>

</body>
</html>

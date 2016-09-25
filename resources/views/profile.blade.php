<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Homepage - TaskHopper</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">

  <style type="text/css">

  .hidden.menu {
    display: none;
  }

  .masthead.segment {
    padding: 1em 0em;
  }
  .masthead .logo.item img {
    margin-right: 1em;
  }
  .masthead .ui.menu .ui.button {
    margin-left: 0.5em;
  }
  .masthead h1.ui.header {
    margin-top: 3em;
    margin-bottom: 0em;
    font-size: 4em;
    font-weight: normal;
  }
  .masthead h2 {
    font-size: 1.7em;
    font-weight: normal;
  }

  .ui.vertical.stripe {
    padding: 8em 0em;
  }
  .ui.vertical.stripe h3 {
    font-size: 2em;
  }
  .ui.vertical.stripe .button + h3,
  .ui.vertical.stripe p + h3 {
    margin-top: 3em;
  }
  .ui.vertical.stripe .floated.image {
    clear: both;
  }
  .ui.vertical.stripe p {
    font-size: 1.33em;
  }
  .ui.vertical.stripe .horizontal.divider {
    margin: 3em 0em;
  }

  .quote.stripe.segment {
    padding: 0em;
  }
  .quote.stripe.segment .grid .column {
    padding-top: 5em;
    padding-bottom: 5em;
  }

  .footer.segment {
    padding: 5em 0em;
  }

  .secondary.pointing.menu .toc.item {
    display: none;
  }

  @media only screen and (max-width: 700px) {
    .ui.fixed.menu {
      display: none !important;
    }
    .secondary.pointing.menu .item,
    .secondary.pointing.menu .menu {
      display: none;
    }
    .secondary.pointing.menu .toc.item {
      display: block;
    }
    .masthead.segment {
    }
    .masthead h1.ui.header {
      font-size: 2em;
      margin-top: 1.5em;
    }
    .masthead h2 {
      margin-top: 0.5em;
      font-size: 1.5em;
    }
  }
  </style>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/semantic.min.js') }}"></script>
  <script>
  $(document).ready(function() {
    // fix menu when passed
    $('.masthead').visibility({
      once: false,
      onBottomPassed: function() {
        $('.fixed.menu').transition('fade in');
      },
      onBottomPassedReverse: function() {
        $('.fixed.menu').transition('fade out');
      }
    });

    // create sidebar and attach to menu open
    $('.ui.sidebar').sidebar('attach events', '.toc.item');
  });
  </script>
</head>
<body>

  <!-- Following Menu -->
  <div class="ui large top fixed hidden menu">
    <div class="ui container">
      <a class="active item">Profile</a>
      <div class="right menu">
        <div class="item">
          {{ link_to_route('home', 'Home', '', array('class' => 'ui button')) }}
        </div>
        @if(Auth::check())
        <div class="item">
          {{ link_to_route('logout', 'Log Out', '', array('class' => 'ui button')) }}
        </div>
        @else
        <div class="item">
          {{ link_to_route('login', 'Log In', '', array('class' => 'ui button')) }}
        </div>
        <div class="item">
          {{ link_to_route('users.create', 'Sign Up', '', array('class' => 'ui primary button')) }}
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="ui vertical inverted sidebar menu">
    {{ link_to_route('home', 'Home', '', array('class' => 'item')) }}
    @if(Auth::check())
    {{ link_to_route('users.edit', 'Profile', Auth::id(), array('class' => 'active item')) }}
    {{ link_to_route('logout', 'Log Out', '', array('class' => 'item')) }}
    @else
    {{ link_to_route('login', 'Log In', '', array('class' => 'item')) }}
    {{ link_to_route('users.create', 'Sign Up', '', array('class' => 'item')) }}
    @endif
  </div>

  <!-- Page Contents -->
  <div class="pusher">
    <div class="ui inverted vertical masthead center aligned segment">

      <div class="ui container">
        <div class="ui large secondary inverted pointing menu">
          <a class="toc item">
            <i class="sidebar icon"></i>
          </a>
          <a class="active item">Profile</a>
          <div class="right item">
            {{ link_to_route('home', 'Home', '', array('class' => 'ui inverted button')) }}
            @if(Auth::check())
            {{ link_to_route('logout', 'Log Out', '', array('class' => 'ui inverted button')) }}
            @else
            {{ link_to_route('login', 'Log In', '', array('class' => 'ui inverted button')) }}
            {{ link_to_route('users.create', 'Sign Up', '', array('class' => 'ui inverted button')) }}
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="ui vertical stripe segment">
      <div class="doubling stackable ui grid container">
        <div class="four wide column center aligned">
          <img class="ui small circular image centered" src="{{ asset('img/square-image.png') }}">

          <div class="ui hidden divider"></div>

          <div class="ui label teal">
            <i class="smile icon"></i> Reputation {{ $user->reputation }}
          </div>
        </div>
        <div class="eight wide column">
          <h2>Edit Profile</h2>
          {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'ui form')) }}
          <div class="field">
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', null, array('placeholder' => 'Username')) }}
          </div>

          <div class="field">
            <label>Name</label>
            <div class="two fields">
              <div class="field">
                {{ Form::text('first_name', null, array('placeholder' => 'First Name')) }}
              </div>
              <div class="field">
                {{ Form::text('last_name', null, array('placeholder' => 'Last Name')) }}
              </div>
            </div>
          </div>

          <div class="field">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, array('placeholder' => 'Email')) }}
          </div>

          {!! Form::submit('Save', array('class' => 'ui large teal submit button')) !!}
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <div class="ui inverted vertical footer segment">
      <div class="ui container grid centered">
        <div class="row centered">
          © 2016 TaskHopper
        </div>
      </div>
    </div>
  </div>

</body>
</html>

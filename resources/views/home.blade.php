<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Homepage - TaskHopper</title>
  <link rel="stylesheet" type="text/css" href="css/semantic.min.css">

  <style type="text/css">

  .hidden.menu {
    display: none;
  }

  .masthead.segment {
    min-height: 700px;
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
      min-height: 350px;
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

  <script src="js/jquery.min.js"></script>
  <script src="js/semantic.min.js"></script>
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
      <a class="active item">Home</a>
      <div class="right menu">
        @if(Auth::check())
        <div class="item">
          <a class="ui button" href="logout">Log Out</a>
        </div>
        @else
        <div class="item">
          <a class="ui button" href="login">Log In</a>
        </div>
        <div class="item">
          <a class="ui primary button" href="join">Sign Up</a>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="ui vertical inverted sidebar menu">
    <a class="active item">Home</a>
    @if(Auth::check())
    <a class="item" href="logout">Log Out</a>
    @else
    <a class="item" href="login">Log In</a>
    <a class="item" href="join">Sign Up</a>
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
          <a class="active item">Home</a>
          <div class="right item">
            @if(Auth::check())
            <a class="ui inverted button" href="logout">Log Out</a>
            @else
            <a class="ui inverted button" href="login">Log In</a>
            <a class="ui inverted button" href="join">Sign Up</a>
            @endif
          </div>
        </div>
      </div>

      <div class="ui text container">
        <h1 class="ui inverted header">
          TaskHopper
        </h1>
        <h2>We do chores.<br/>
          You live life.
        </h2>
        <div class="ui hidden divider"></div>
        <div class="ui icon input">
          <input type="text" placeholder="Search...">
          <i class="inverted circular search link icon"></i>
        </div>
      </div>
    </div>

    <div class="ui vertical stripe segment">
      <div class="doubling stackable three column ui grid container">
        <div class="row centered">
          <h1 class="ui center aligned header">Put TaskHopper to Work</h1>
        </div>
        <?php foreach($results as $result): ?>
          <div class="column">
            <div class="ui fluid card">
              <div class="image">
                <img class="img mini" src="img/photogenic-task-rabbit.jpg">
              </div>
              <div class="content">
                <div class="header"><?php echo $result->category ?></div>
                <div class="description">
                  <?php echo $result->name ?>
                </div>
              </div>
              <div class="ui bottom attached button">
                Book
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="ui vertical stripe segment">
      <div class="ui stackable grid container">
        <div class="row centered">
          <h1 class="ui center aligned header">How it Works?</h1>
        </div>
        <div class="row">
          <div class="column center aligned">
            <div class="ui steps">
              <div class="step">
                <i class="hand pointer icon"></i>
                <div class="content">
                  <div class="title left aligned">Pick a Task</div>
                  <div class="description">Choose from a list of popular chores and errands</div>
                </div>
              </div>
              <div class="active step">
                <i class="users icon"></i>
                <div class="content">
                  <div class="title">Get Matched</div>
                  <div class="description">We'll connect you with a skilled Tasker<br />within minutes of your request</div>
                </div>
              </div>
              <div class="disabled step">
                <i class="info icon"></i>
                <div class="content">
                  <div class="title">Get it Done</div>
                  <div class="description">Your Tasker arrives, completes the job</div>
                </div>
              </div>
            </div>
          </div>
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

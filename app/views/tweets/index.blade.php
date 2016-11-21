<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
    {{ HTML::style('css/tweets.css'); }}
  </head>

  <body id="tweet-index">

    @if (Session::has('message'))
      <div class="message-alert-info">{{ Session::get('message') }}</div>
    @endif

    <div id="header">
      <h1 class="header-title">TWEETS TO BE SENT</h1>
    </div>

    <div class="create-new-tweet">
      {{ Form::open(array('action' => 'TweetController@store', 'class' => 'submit-form')) }}
      <div class="input-fields">
        {{ Form::text('tweet_body', Input::old('tweet_body'), array('class' =>
        'tweet-body')) }}
        <div class="tweet-date">
          <span class="date-label">{{ Form::label('Date/Time') }}
            {{-- {{ Form::datetime("time_to_be_scheduled") }} --}}
          {{ Form::text('time_to_be_scheduled') }}
        </div>
      </div>
      <div class="submit-field" placeholder="MM/DD/YY">
        {{ Form::submit("Queue Tweet", array("class" => "tweet-submit")) }}
      </div>
      {{ Form::close() }}
    </div>

    <div class="tweets-section">
      <div class="tweets-collection">
        @foreach($tweets as $key => $value)
          <div class="tweet" data-tweet="{{$value->id}}">
            <div class="rendered-tweet-body">{{ $value->tweet_body}}</div>
            <div class="non-tweet-body">
              <div class="rendered-tweet-time">{{ $value->time_to_be_scheduled}}</div>
              <button class="delete-button">
              <a class="delete-link" href="javascript:deleteTweet('{{ $value->id }}');">Delete</a>
            </button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="{{ asset('js/tweets.js')}}"></script>

</html>

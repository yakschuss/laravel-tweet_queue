function deleteTweet(id) {
  if (confirm('Delete this Tweet?')) {
    $.ajax({
      type:"POST",
      data: { _method:"DELETE" },
      url: 'tweets/' + id, 
      complete: function(tweet) {
        $tweet = $("[data-tweet='" + tweet.responseText + "']");
        $tweet.hide();
      }
    });
  }
}

$('.submit-form').submit(function( event ) {
  event.preventDefault();
  $.ajax({
    url: 'tweets/',
    type: 'POST',
    data: $('form').serialize(), 
    dataType: 'json',
    success: function( response ){
        $('.tweets-collection').append(generateTweetObject(response["tweet_body"], response["time_to_be_scheduled"], response["id"]));
        $('.submit-form').trigger("reset");
      },
      error: function( _response ){
      }
    });
  });

var generateTweetObject = function (tweetBody, tweetTime, tweetId){
  var template =
    '<div class="tweet" data-tweet=' + tweetId + '>'
      + '<div class="rendered-tweet-body">' + tweetBody + '</div>'
      + '<div class="non-tweet-body">'
      + '<div class="rendered-tweet-time">' + tweetTime + '</div>'
      + '<button class="delete-button">'
      + '<a class="delete-link" href="javascript:deleteTweet(' + tweetId + ');">Delete</a>'
      + '</button>'
      + '</div>'
      + '</div>';

    return $(template);
};


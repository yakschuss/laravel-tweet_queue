<?php

class TweetController extends BaseController {
  public function indexTweets()
  {
    return View::make('tweets/tweets');
  }
}

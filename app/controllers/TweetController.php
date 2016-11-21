<?php
class TweetController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
    $tweets = Tweet::all();

    return View::make('tweets/index')
      ->with('tweets', $tweets);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {

    $rules = array(
      'tweet_body'                 => 'required',
      'time_to_be_scheduled'       => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('tweets/index')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      // store
      $tweet = new Tweet;
      $tweet->tweet_body       = Input::get('tweet_body');
      $tweet->time_to_be_scheduled       = Input::get('time_to_be_scheduled');
      $tweet->save();
      return $tweet;
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $tweet = Tweet::find($id);
    $tweet_id = $tweet->id;
    $tweet->delete();

    return $tweet_id;
  }


}

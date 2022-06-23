<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use App\Events\DashboardPostEvent;
use App\Events\DashboardProfileEvent;
use App\Events\LikeEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function commentEvent(Request $request)
  {
    if ($request->ajax()) {
      event(new CommentEvent($request->post_url));
    }
  }
  public function likeEvent(Request $request)
  {
    if ($request->ajax()) {
      event(new LikeEvent($request->post_url));
    }
  }
  public function postEvent()
  {
      event(new DashboardPostEvent());
  }
  public function profileEvent()
  {
      event(new DashboardProfileEvent());
  }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FollowRepository;
use Auth;

class FollowController extends Controller
{
    protected $followRepository; 

    public function __construct(FollowRepository $followRepository)
    {
        $this->middleware('auth');
        $this->followRepository = $followRepository;
    }

    public function follow(Request $request)
    {
        $followData = [
            'followed_id' => $request->followed_id,
            'follower_id' => Auth::user()->id,
        ];
        
        $followed = $this->followRepository->findUserFollowed($followData);

        if ($followed == null) {
            $this->followRepository->insertFollow($followData);
            $f = 1;
        } else {
            $this->followRepository->deleteFollow($followData);
            $f = 0;
        }

        if ($request->ajax()) {
            return response()->json([
                'followed' => $f,
            ]);
        }

        return back();
    }
}

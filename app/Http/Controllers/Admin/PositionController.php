<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\register;
use App\PlanUser;
use App\Position;
use App\Rules\VisitorCode;
use App\WalletLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check())
                if (auth()->user()->level == 'customer' || auth()->user()->level == 'user' ||
                    auth()->user()->level == 'seller') {
                    return redirect('/');
                } else {
                    return $next($request);
                }
            return redirect('/');
        });
    }

    public function index()
    {
        $positions = auth()->user()->positions;

        $position = auth()->user()->positions->first();

        if ($id = \request('pos'))
            $position = $positions->where('id', $id)->first();

        return view('homePages.positions.index', [
            'positions' => $positions,
            'user' => auth()->user(),
            'position' => $position
        ]);
    }

    public function edit($id)
    {
        $planUser = PlanUser::find($id);

        $positions = auth()->user()->positions;

        if ($planUser->expire_at > now() && $planUser->user_id == auth()->user()->id) {
            return view('homePages.positions.edit', [
                'planUser' => $planUser,
                'positions' => $positions
            ]);
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Consultant_code' => ['required', 'exists:positions,visitor_code', new VisitorCode],
        ]);
        $user = auth()->user();
        $data['parent_id'] = $user->parent_id;

        $count = Position::where('Consultant_code', $data['Consultant_code'])->count();
        $hand_id = 1;
        if ($count == 1) {
            $hand_id = 2;
        }

        $data['name'] = $user->name;

        $name = $data['name'] . '_';

        $time = time();

        $pos1 = $user->positions()->create([
            'Consultant_code' => $data['Consultant_code'],
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '1',
            'hand_id' => $hand_id,
        ]);

        $pos2 = $user->positions()->create([
            'Consultant_code' => $pos1->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '2',
            'hand_id' => 1,
        ]);

        $pos3 = $user->positions()->create([
            'Consultant_code' => $pos1->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '3',
            'hand_id' => 2,
        ]);

        $pos4 = $user->positions()->create([
            'Consultant_code' => $pos2->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '4',
            'hand_id' => 1,
        ]);

        $pos5 = $user->positions()->create([
            'Consultant_code' => $pos2->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '5',
            'hand_id' => 2,
        ]);

        $pos5 = $user->positions()->create([
            'Consultant_code' => $pos3->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time++,
            'name' => $name . '6',
            'hand_id' => 1,
        ]);

        $pos6 = $user->positions()->create([
            'Consultant_code' => $pos3->visitor_code,
            'Reference_code' => $data['parent_id'],
            'visitor_code' => $time,
            'name' => $name . '7',
            'hand_id' => 2,
        ]);

        alert()->success('جایگاه با موفقیت ذخیره گردید . ');
        return redirect()->back();
    }

    public function lists()
    {
        return view('homePages . positions');
    }

    public function active(Position $position)
    {
        if (auth()->user()->canActive()) {
            $position->active = 1;
            $position->save();
        }


        $parent = $position->load('allParent');

        while ($parent) {
            if ($parent->parent) {
                if ($parent->hand_id == 1) {
                    $parent->parent->r_hand++;
                    $parent->parent->rightCount++;
                    $parent->parent->save();
                } else if ($parent->hand_id == 2) {
                    $parent->parent->l_hand++;
                    $parent->parent->leftCount++;
                    $parent->parent->save();
                }
            }
            $parent = $parent->parent;
        }

        if ($position->reference) {
            $position->reference()->increment('wallet', 50000);

            WalletLog::create([
                'user_id' => $position->reference->user_id,
                'price' => 50000,
                'subject' => 'پورسانت خرید شغل'
            ]);
        }

        alert()->success('جایگاه شما با موفقیت فعال گردید . ');

        return back();
    }
}

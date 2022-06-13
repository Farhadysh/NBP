<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;

class TreeController extends Controller
{
    public function index()
    {
        $data = Position::where('visitor_code', 1579008831)
            ->with('allChildren')->get();

        $positions = Position::with('allChildren')->get();

        foreach ($positions as $position) {
            $right = 0;
            $left = 0;


            $childCount = $position->children->count();

            if ($childCount == 1) {
                $position->children[0]->hand_id = 1;
                $position->children[0]->save();
            }

            if ($childCount == 2) {
                $position->children[0]->hand_id = 1;
                $position->children[0]->save();

                $position->children[1]->hand_id = 2;
                $position->children[1]->save();
            }

            foreach ($position->children as $child) {
                if ($child->hand_id == 2) {
                    $left = $this->allCount($child->load('children'));
                    if ($child->active)
                        $left++;
                }

                if ($child->hand_id == 1) {
                    $right = $this->allCount($child->load('children'));
                    if ($child->active)
                        $right++;
                }
            }

            $position->leftCount = $left;
            $position->rightCount = $right;
            $position->save();
        }

//        alert()->success("لیست فرزندان به روزرسانی شد.");

//        return back();

        return view('admin.tree.tree', [
            'positions' => Position::all(),
        ]);
    }

    public function allCount($node)
    {
        $all = 0;

        if ($node->children) {
            $all += $node->children->where('active', 1)->count();

            foreach ($node->children as $child) {
                $all += $this->allCount($child);
            }
        }
        return $all;
    }
}

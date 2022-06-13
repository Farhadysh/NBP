<?php

namespace App\Http\Controllers\Panel;

use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->paginate(10);
        $categories = Category::where('parent_id', 0)->where('active', 1)
            ->with(['children' => function ($q) {
                return $q->where('active', 1);
            }])->get();
        return view(\request()->route()->getName(), [
            'tickets' => $tickets,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->where('active', 1)
            ->with(['children' => function ($q) {
                return $q->where('active', 1);
            }])->get();
        return view(\request()->route()->getName())->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:191|min:3',
            'body' => 'required|string',
            'priority' => 'required',
            'file' => 'nullable|mimes:jpg,gif,jpeg,png,txt,pdf,zip,rar'
        ]);

        $file = null;

        if ($request->hasFile('file'))
            $file = $this->uploadFile($request->file);

        auth()->user()->tickets()->create([
            'id' => $this->generateId(),
            'subject' => $request->subject,
            'body' => $request->body,
            'priority' => $request->priority,
            'status' => Ticket::STATUS_NEW,
            'file' => $file
        ]);

        alert()->success("با موفقیت ثبت شد!");
        return redirect('/panel/tickets');
    }

    public function close($id)
    {
        $ticket = Ticket::whereId($id)->first();

        if ($ticket->user_id == auth()->user()->id) {
            Ticket::whereId($id)->update([
                'status' => Ticket::STATUS_CLOSED
            ]);
        }
        alert()->success("درخواست پشتیبانی با موفقیت بسته شد!");
        return back();
    }

    public function show(Ticket $ticket)
    {
        $categories = Category::where('parent_id', 0)->where('active', 1)
            ->with(['children' => function ($q) {
                return $q->where('active', 1);
            }])->get();
        if ($ticket->user_id == auth()->user()->id)
            return view(\request()->route()->getName(), [
                'ticket' => $ticket,
                'categories' => $categories,
            ]);

        $ticket->replies->update(['sellerView',1]);



        return redirect('/profile/tickets');
    }

    public function generateId()
    {
        $id = mt_rand(100000, 999999);
        if ($this->idExist($id)) {
            $this->generateId();
        }

        return $id;
    }

    public function idExist($id)
    {
        return Ticket::where('id', $id)->exists();
    }
}

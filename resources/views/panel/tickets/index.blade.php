@extends('panel.master')

@section('content')
    <div class="d-flex flex-column flex-wrap flex-md-row bg-light py-4" style="margin-top: 110px">
        <div class="col-12">
            <div class="d-flex justify-content-between align-content-center  my-3">
                <h5 class="text-dark m-0 mt-1">درخواست های پشتیبانی شما</h5>
                <div class="">
                    <a href="/panel/tickets/create" class="btn btn-outline-warning btn-sm">درخواست پشتیبانی جدید</a>
                </div>
            </div>

            @if($tickets->count())
                @foreach($tickets as $ticket)
                    <div class="card p-3 mt-2 medium-radius">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <a href="{{route('panel.tickets.show',['id'=>$ticket->id])}}">
                                    <h5 class="m-0 text-dark">{{$ticket->subject}}</h5>
                                </a>
                                <span class="mr-3 text-danger">{{$ticket->created_at}}</span>
                                <span class="badge badge-warning">{{$ticket->replies->where('sellerView',0)->count()}}</span>
                            </div>
                            <div class="">
                                <span class="bg-{{$ticket->status['color']}}
                                        text-white text-v-sm px-2 rounded">{{$ticket->status['title']}}</span>
                                <span class="bg-{{$ticket->priority['color']}}
                                        text-white text-v-sm px-2 rounded">{{$ticket->priority['title']}}</span>
                            </div>
                        </div>
                        <span class="text-muted px-5 mt-2">
                            {{Str::limit($ticket->body,200)}}
                        </span>
                        <div class="">
                            @if($ticket->getOriginal('status') !=\App\Ticket::STATUS_CLOSED)
                                <a href="{{route('panel.tickets.close',['id'=>$ticket->id])}}"
                                   class="mt-3 mr-5 btn btn-sm btn-info text-v-sm">بستن
                                    درخواست پشتیبانی</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 mx-auto card shadow-sm text-center py-5 medium-radius">
                    <span class="icon-frown text-muted mb-3" style="font-size: 40px"></span>
                    <h4 class="text-muted">موردی یافت نشد!</h4>
                </div>
            @endif
        </div>

        <div class="text-center">
            {{$tickets->links()}}
        </div>
    </div>
@endsection



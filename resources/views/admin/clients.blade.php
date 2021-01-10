@extends('adminlte::page')

@section('content')
<div class="grey-bg container-fluid">
    <x-flash-message />
    <h3 class="text-center"><a href="{{ route('client.create') }}">Create new Client</a></h3>
    <hr>
    <section id="minimal-statistics">
        <div class="row">
            
            @foreach ($clients as $client)
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">        
                                    <div class="media-body text-left">
                                        <h5><a href="{{ route('client.edit', $client) }}">{{$client->name}}</a></h5>
                                        <p class="font-weight-light">Email: {{$client->email}}</p>
                                        <p class="font-weight-light">Created: {{$client->created_at}}</p>
                                        <p class="font-weight-light">Last updated: {{$client->updated_at}}</p>
                                    </div>
                                    <div>
                                        <form action="{{ route('client.destroy', $client)}}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>  
                                    <div class="align-self-center">
                                        <i
                                            class="icon-book-open primary font-large-2 float-right"
                                        ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!! $clients->links() !!} 
        </div>
    </section>
</div>
@stop

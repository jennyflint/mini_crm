@extends('adminlte::page')

@section('content')
<div class="grey-bg container-fluid">
  <x-flash-message />
    @if(isset($client))
        <form class="flex flex-col w-full" method="POST" action="{{ route('client.update', $client) }}">
            @method('put')
    @else
        <form class="flex flex-col w-full" method="POST" action="{{ route('client.store') }}">
    @endif
    @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          @if(isset($client))
            <input type="text" class="form-control" id="name" name="name" value="{{$client->name}}" required>
          @else
            <input type="text" class="form-control" id="name" name="name" required placeholder="Name client">
          @endif
          @error('name')
          <small class="text-danger">
            {{ $message }}
          </small>   
          @enderror  
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          @if(isset($client))
            <input type="email" class="form-control" id="email" name="email" value="{{$client->email}}" required>
          @else
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
          @endif
          @error('email')
          <small class="text-danger">
            {{ $message }}
          </small>   
          @enderror  
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
</div>
@stop
@extends('adminlte::page')

@section('content')
<div class="grey-bg container-fluid">
  <x-flash-message />
    @if(isset($company))
        <form class="flex flex-col w-full" method="POST" action="{{ route('company.update', $company) }}">
            @method('put')
    @else
        <form class="flex flex-col w-full" method="POST" action="{{ route('company.store') }}">
    @endif
    @csrf
        <div class="form-group">
          <label for="name">Name Company:</label>
          @if(isset($company))
            <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}" required>
          @else
            <input type="text" class="form-control" id="name" name="name" required placeholder="Name Company">
          @endif
          @error('name')
          <small class="text-danger">
            {{ $message }}
          </small>   
          @enderror  
        </div>
        <div class="form-group">
          <label for="clients">Clients:</label>  
          @if(isset($company))
            <select class="clients form-control" id="clients" name="clients[]" multiple="multiple">
              @foreach ($company->clients as $client)
              <option value="{{$client->id}}" selected="selected">{{$client->name}}</option>
              @endforeach
            </select>
            @else
            <select class="clients form-control" name="clients[]" multiple="multiple"></select>
            @endif
            @error('clients')
            <small class="text-danger">
              {{ $message }}
            </small>   
            @enderror 
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>

      <script src="{{ asset('js/select-clients.js') }}" defer></script>
</div>
@stop
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <!-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> -->

    <div class="mt-8 text-2xl">
       {{__('Please fill trip information:')}}
    </div>

    <div class="row class justify-content-center">
    {{ Form::open(array('url' => '/booking/store')) }}

  
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="grid grid-cols-4 gap-6">
                    <div class="col-span-4 sm:col-span-3">
                            @if ($errors->any())
                                <div class="alert alert-danger text-left">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                    </div>    

            </div>
<br>

            <div class="grid grid-cols-4 gap-6">
        
            <div class="col-span-4 sm:col-span-1">
            <label class="block font-medium text-sm text-gray-700" for="name">
            {{__('Trip start:')}}<span class="star">*</span>
            </label>
            <!-- <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" wire:model.defer="state.name" autocomplete="name"> -->
                <select name="from" class="form-control">
                    <option></option>
                    @foreach($citiesData as $city_row)
                        <option value={{$city_row->id}} >{{$city_row->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- To -->
            <div class="col-span-4 sm:col-span-1">
            <label class="block font-medium text-sm text-gray-700" for="email">
            {{__('Trip end:')}}<span class="star">*</span>
            </label>
                <select name="to" class="form-control">
                <option></option>
                    @foreach($citiesData as $city_row)
                        <option value={{$city_row->id}}>{{$city_row->name}}</option>
                    @endforeach
                </select>
            </div>



 <!-- To -->
 <div class="col-span-4 sm:col-span-1">
            <label class="block font-medium text-sm text-gray-700" for="seat #">
            {{__('Seat #:')}}<span class="star">*</span>
            </label>
                <select name="seat_id" class="form-control">
                        <option></option>
                    @foreach($seatsData as $seat_row)
                        <option value={{$seat_row->id}}>{{$seat_row->num}}</option>
                    @endforeach
                </select>
            </div>

            </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:loading.attr="disabled" wire:target="photo">
                    {{__('Book now')}}
                </button>          
            </div>

           
            </div>
            @csrf
            {{ Form::close() }}

    </div>
</div>





            </div>
        </div>
    </div>
</x-app-layout>
<style>
.alert-danger{
    color:#721c24;
    background-color: #f8d7da;
}
.star{
    color:#721c24;
}
.alert-success{
    color:#155724;
    background-color: #d4edda;
}
.form-control{
    width:100%;
}
</style>
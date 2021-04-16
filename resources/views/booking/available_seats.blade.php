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
       {{__('Available seats:')}}
    </div>

    <div class="row class justify-content-center">
    {{ Form::open(array('method'=>'get','url' => 'available_seats')) }}

  
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
                <select name="from" class="form-control" required>
                    <option></option>
                    @foreach($citiesData as $city_row)
                    @if(isset($_GET['from']) && $city_row->id==$_GET['from'])
                        <option value={{$city_row->id}} selected>{{$city_row->name}}</option>
                    @else
                    <option value={{$city_row->id}} >{{$city_row->name}}</option>

                    @endif
                    @endforeach
                </select>
            </div>

            <!-- To -->
            <div class="col-span-4 sm:col-span-1">
            <label class="block font-medium text-sm text-gray-700" for="email">
            {{__('Trip end:')}}<span class="star">*</span>
            </label>
                <select name="to" class="form-control" required>
                <option></option>
                    @foreach($citiesData as $city_row)
                    @if(isset($_GET['to']) && $city_row->id==$_GET['to'])
                        <option value={{$city_row->id}} selected>{{$city_row->name}}</option>
                    @else
                    <option value={{$city_row->id}} >{{$city_row->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>





            </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:loading.attr="disabled" wire:target="photo">
                    {{__('Check')}}
                </button>          
            </div>

           
            </div>
            
            {{ Form::close() }}


            <div class="mt-8 text-2xl">
       {{__('Result output:')}}
    </div>
            <div class="mt-6 text-gray-500">
        <table>
            <tr>
                <th>Seat #</th>
            </tr>
            @if(count($available_seats)>0)
                @foreach($available_seats as $seat_row)
                    <tr>
                        <td>{{$seat_row->num}}</td>                        
                    </tr>
                @endforeach
            @else
            <tr>
            <td colspan="3" class="no_result_found">{{__('no result found')}}</td>
                
            </tr>
            @endif
        </table>
        @if(count($available_seats)>0)
            {{ $available_seats->links() }}
        @endif

                
    </div>



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
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.no_result_found{
    text-align:center;
}
</style>
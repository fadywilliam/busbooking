<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bus reservations list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    

   

    <div class="mt-6 text-gray-500">
        <table>
            <tr>
                <th>Trip</th>
                <th>Seat #</th>
                <th>User</th>
            </tr>
            @if(count($booking_Data)>0)
                @foreach($booking_Data as $book_row)
                    <tr>
                        <td>{{$book_row->trips->cities_from->name}} - {{$book_row->trips->cities_to->name}}</td>
                        <td>{{$book_row->seats->num}}</td>
                        <td>{{$book_row->users->name}}</td>
                    </tr>
                @endforeach
            @else
            <tr>
            <td colspan="3" class="no_result_found">{{__('no result found')}}</td>
                
            </tr>
            @endif
        </table>

        {{ $booking_Data->links() }}

                
    </div>

</div>



            </div>
        </div>
    </div>
</x-app-layout>
<style>
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
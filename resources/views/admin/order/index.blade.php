@extends('admin.layouts.master')

@section('content')

<div class="container py-3">
    <h2>Order Information</h2>
    <div class= "">
            <div class="d-flex flex-column row">
            <div class=" p-3 col-12 bg-white">
                <table id="myTable" class="table table-striped nowrap custom-table w-100" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>invoice id</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>product Classify</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            {{$order->id}}
                        </td>
                        <td>
                            {{$order->invoice_id}}
                        </td>
                        <td>
                            @php
                                $isOrderMadeByAuthanticatedUser = \App\Models\User::where('id', $order->user_id)->first();
                            @endphp
                            {{ $isOrderMadeByAuthanticatedUser !== null ? $order->user->name : $order->user_id}}
                        </td>
                        <td>
                            {{date('d-m-Y', strtotime($order->created_at))}}
                        </td>
                        <td>
                            {{$order->product_quantity}}
                        </td>
                        <td>
                            {{$order->total}} LE
                        </td>
                        <td>
                            <p class="my_btn  fw-bold pending text-center rounded-4">{{$order->order_status}}</p>
                        </td>
                        <td>
                            <p class="my_btn  fw-bold pending text-center rounded-4">{{$order->payment_status}}</p>
                        </td>
                        <td>
                            {{$order->payment_method}}
                        </td>
                        <td>
                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                <button class="btn my_btn" id="view_btn"> <a href="{{route('admin.order.bill', $order->id)}}" class=" text-white">View</a></button>
                                <form action="{{ route('admin.order.delete', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn my_btn">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

           </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('Backend/assets/icons/all.min.js')}}"></script>
<script src="{{asset('Backend/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('Backend/vendors/jquery/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('Backend/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('Backend/assets/js/script.js')}}"></script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#myTable').DataTable({
        responsive: true
    });
    })
</script>
@endpush

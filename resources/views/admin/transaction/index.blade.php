@extends('admin.layouts.master')

@section('content')
    <div class="container  ">
        <div class=" py-3 px-2">
            <h2>Transations</h2>

            <div class="d-flex flex-column row ">
                <div class="  col-11 col-md-12 p-3 bg-white shadow-lg">
                    <table id="myTable" class="table table-striped nowrap custom-table w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice Id</th>
                                <th>Transaction Id</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>
                                    {{$transaction->id}}
                                </td>
                                <td>
                                    {{$transaction->order_id}}
                                </td>
                                <td>
                                    {{$transaction->transaction_id}}
                                </td>
                                <td>
                                    {{$transaction->payment_method}}
                                </td>
                                <td>
                                    {{$transaction->amount}}
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
@endpush

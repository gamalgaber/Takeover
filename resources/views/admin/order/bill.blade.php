@extends('admin.layouts.master')


@section('content')
    <div class="container py-3">
        <h2>Order Information</h2>
        <div class="row mx-auto">
            <div class="col-10">
                <div class=" d-flex flex-column ">
                    <div class="bg-white p-3  rounded-4 shadow-lg">
                        <div> Order id: {{ $order->invoice_id }}</div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <h5>Shipped To:</h5> <br>
                                    <b>Name: {{ $address->first_name . ' ' . $address->last_name }}</b><br>
                                    <b>Email: {{ $address->email }}</b><br>
                                    <b>Mobile Phone: {{ $address->phone }}</b><br>
                                    <b>Address: {{ $address->address }}</b><br>
                                    <b>Government: {{ $address->government }}</b><br>
                                    <b>City: {{ $address->city }}</b><br>
                                    <b>Postal Code: {{ $address->postal_code }}</b><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Information:</strong><br>
                                    <b>Method:</b> {{ $order->payment_method }}<br>
                                    <b>Transaction ID: {{ $order->transaction->transaction_id }}</b><br>
                                    <b>Status: {{ $order->payment_status == 1 ? 'Completed' : 'Pending' }}</b><br>
                                </address>
                                <strong>Order Date:</strong><br>
                                {{ date('d F,Y', strtotime($order->created_at)) }}<br><br>
                            </div>
                        </div>
                    </div>
                    <div class=" table-responsive my-3">
                        <table class="table table-striped table-hover table-md">
                            <thead>
                                <tr>
                                    <th data-width="40">#</th>
                                    <th scope="col">item</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProducts as $product)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        @if (isset($product->product->slug))
                                            <td><a target="_black"
                                                    href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                            </td>
                                        @else
                                            <td>{{ $product->product_name }}</td>
                                        @endif
                                        <td>{{ $product->variants }}</td>
                                        <td>{{ $product->unit_price }} LE</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->unit_price * $product->quantity }} LE</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 text-right">
                        <div class="invoice-detail-name">total</div>
                        <div class="invoice-detail-value">
                            @php
                                foreach ($order->orderProducts as $product) {
                                    $total += $product->unit_price * $product->quantity;
                                }
                            @endphp
                            {{ $total + $order->shipping_price }} LE</div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <button class="btn btn-warning btn-icon icon-left  print_invoice"><i class="fas fa-print"></i>
                            Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('Backend/assets/icons/all.min.js') }}"></script>
    <script src="{{ asset('Backend/vendors/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Backend/vendors/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/script.js') }}"></script>
    <script src="{{ asset('Backend/vendors/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());
                window.print();

                $('body').html(originalContents);
            })
        })
    </script>
@endpush

@extends('frontend.layouts.master')

@section('content')
    <section>
        <div class="container mt-4 contact ">
            <div class=" text-center text-capitalize mb-5 ">
                <h2>contact us</h2>
                <hr class=" hr--small ">
            </div>

            <form id="send-contact">
                <div class="contact__form">
                    <div class="mb-3">
                        <input type="text " class="form-control fs-5" id="exampleInputEmail1 " aria-describedby="emailHelp "
                            placeholder="Name " name="name">
                    </div>
                    <div class="mb-3 ">
                        <input type="email " class="form-control fs-5" id="exampleInputEmail1 "
                            aria-describedby="emailHelp " placeholder="Email " name="email">
                    </div>
                    <div class="mb-3 ">
                        <input type="number " class="form-control fs-5" id="exampleInputPassword1 "
                            placeholder="Phone Number " name="phone">
                    </div>
                    <div class="form-floating ">
                        <textarea class="form-control fs-5" placeholder="Leave a comment here " id="floatingTextarea2 " style="height: 250px "
                            name="message"></textarea>
                        <label for="floatingTextarea2 " class="text-capitalize fs-5 text-black-50 ">massage</label>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button id="send-contact-button" type="submit" class="contact__button">SEND</button>
                    </div>
                </div>
            </form>
            <hr class=" hr--small ">
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).ready(function() {
            $('#send-contact').on('submit', function(event) {
                event.preventDefault();
                let data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('handle-contact-form') }}",
                    data: data,
                    beforeSend: function() {
                        $('#send-contact-button').text('sending...');
                        $('#send-contact-button').attr('disabled', true)
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                            $('#send-contact')[0].reset();
                            $('#send-contact-button').text('send now');
                            $('#send-contact-button').attr('disabled', false)
                        }
                    },
                    error: function(data) {
                        let errors = data.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        })
                        $('#send-contact-button').text('send now');
                        $('#send-contact-button').attr('disabled', false)
                    }
                })
            })
        })
    </script>
@endpush


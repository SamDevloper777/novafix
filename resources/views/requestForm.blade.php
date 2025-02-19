@extends('layouts.layout')
@section('title') 
    {{ env('APP_NAME') }} - Request For Repair
@endsection

@section('contents')
    <div class="container mt-5">
        <div class="row mt-5 py-5 px-2">
            <div class="card p-5 mx-auto mt-5 rounded-5">
                <div class="d-flex justify-content-center">
                    <h1 class="font-bold text-3xl text-gray-900 mb-4">Service Request</h1>
                </div>
                <form action="{{ route('request.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="" class="text-xs font-semibold px-1">Name</label>
                            <input type="text" id="owner_name" name="owner_name" class="form-control" value="{{ old('owner_name') }}">
                            @error('owner_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="" class="text-xs font-semibold px-1">Model Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control">
                            @error('product_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="" class="text-xs font-semibold px-1">Contact</label>
                            <input type="number" id="contact" name="contact" class="form-control" onblur="fetchCustomerDetails()">
                            @error('contact')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="" class="text-xs font-semibold px-1">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-4">
                            <label for="" class="text-xs font-semibold px-1">Brand</label>
                            <input type="text" id="brand" name="brand" class="form-control">
                            @error('brand')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="" class="text-xs font-semibold px-1">Color</label>
                            <input type="text" id="color" name="color" class="form-control">
                            @error('color')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="" class="text-xs font-semibold px-1">Type</label>
                            <select name="type_id" id="type_id" class="form-select font-semibold text-xl px-1">
                                <option value="">Select Type</option>
                                @foreach ($Types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach                                                                   
                            </select>
                            @error('type_id')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="text-xs font-semibold px-1">Problem</label>
                        <textarea name="problem" class="form-control"></textarea>
                        @error('problem')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <button class="btn btn-success w-100">Raise Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function fetchCustomerDetails() {
            var contactNumber = document.getElementById('contact').value;

            if (!contactNumber) {
                return;
            }

            $.ajax({
                url: "{{ route('request.create') }}", 
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    contact: contactNumber
                },
                success: function (response) {
                    if (response.success) {
                        $('#owner_name').val(response.customer.owner_name);
                        $('#product_name').val(response.customer.product_name);
                        $('#email').val(response.customer.email);
                        $('#brand').val(response.customer.brand);
                        $('#color').val(response.customer.color);
                        $('#type_id').val(response.customer.type_id);
                    }
                }
            });
        }
    </script>
@endsection

@extends('receptioner.layouts.base')

@section('content')
<div class="ml-40">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="mt-2">
                <h2 class="text-black-100">Service Request</h2>
            </div>
            <div class="mt-3">
                <a href="{{ route('receptioner.all.request') }}" role="button" class="btn btn-primary btn-sm">Go
                    Back</a>
            </div>
        </div>
        <form action="{{ route('receptioner.request.form') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="w-full px-3 mb-5 col">
                    <label for="owner_name" class="text-black-100">Name</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name') }}">
                    @error('owner_name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 px-3 col">
                    <label for="product_name" class="text-black-100">Model Name</label>
                    <input type="text" name="product_name" id="product_name"  class="form-control" value="{{old('product_name')}}">
                    @error('product_name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 px-3 col">
                    <label for="contact" class="text-black-100">Contact</label>
                    <input type="number" name="contact" id="contact"  class="form-control" value="{{ old('contact') }}" oninput="fetchCustomerDetails()">
                    @error('contact')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 px-3 col">
                    <label for="email" class="text-black-100">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 px-3 col">
                    <label for="brand" class="text-black-100">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{old('brand')}}">
                    @error('brand')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 px-3 col">
                    <label for="serial_no" class="text-black-100">Serial No</label>
                    <input type="text" name="serial_no" id="serial_no" class="form-control" value="{{old('serial_no')}}">
                    @error('serial_no')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 px-3 col">
                    <label for="color" class="text-black-100">Color</label>
                    <input type="text" name="color" id="color" class="form-control" value="{{old('color')}}">
                    @error('color')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 px-3 col">
                    <label for="MAC" class="text-black-100">MAC</label>
                    <input type="text" name="MAC" id="MAC" class="form-control" value="{{old('MAC')}}">
                    @error('MAC')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>                
                <div class="mb-3 px-3 col">
                    <label for="type_id" class="text-black-100">Type</label>
                    <select id="type_id" name="type_id" class="form-control">
                        <option value="">Select Type</option>
                        @foreach ($Types as $item)
                            <option value="{{ $item->id }}" {{ old('type_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('type_id')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="my_camera"></div>
                    <br />
                    <button onClick="take_snapshot()" class="btn-btn-secondary">Take Snapshot</button>
                    <input type="hidden" name="image" class="image-tag">
                </div>
                <div class="col-md-6">
                    <div id="results">Your captured image will appear here...</div>
                </div>
            </div>

            <div class="mb-3 px-2">
                <label for="problem" class="text-black-100">Problem</label>
                <textarea name="problem" class="form-control" value="{{old('problem')}}"></textarea>
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
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script>
  function fetchCustomerDetails() {
    var contactNumber = document.getElementById('contact').value;

    if (!contactNumber) {
        return;
    }

    $.ajax({
        url: "{{ route('receptioner.request.form') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            contact: contactNumber
        },
        success: function(response) {
            if (response.success) {
                $('#owner_name').val(response.customer.owner_name);
                $('#product_name').val(response.customer.product_name);
                $('#email').val(response.customer.email);
                $('#brand').val(response.customer.brand);
                $('#serial_no').val(response.customer.serial_no);
                $('#color').val(response.customer.color);
                $('#MAC').val(response.customer.MAC);
                $('#type_id').val(response.customer.type_id);
            } 
        }
       
    });
}

    document.addEventListener('DOMContentLoaded', function () {
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('.my_camera');

        window.take_snapshot = function () {
            Webcam.snap(function (data_url) {
                document.getElementById('results').innerHTML = '<img src="' + data_url + '"/>';
            });
        };
    });
</script>
@endsection
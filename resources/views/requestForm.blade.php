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
                            <label for="owner_name" class="text-xs font-semibold px-1">Name</label>
                            <input type="text" id="owner_name" name="owner_name" class="form-control"
                                value="{{ old('owner_name') }}">
                            @error('owner_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="product_name" class="text-xs font-semibold px-1">Model Name</label>
                            <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                                class="form-control">
                            @error('product_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="contact" class="text-xs font-semibold px-1">Contact</label>
                            <input type="number" id="contact" name="contact" value="{{ old('contact') }}"
                                class="form-control" onblur="fetchCustomerDetails()">
                            @error('contact')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="email" class="text-xs font-semibold px-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-4">
                            <label for="brand" class="text-xs font-semibold px-1">Brand</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand') }}" class="form-control">
                            @error('brand')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="color" class="text-xs font-semibold px-1">Color</label>
                            <input type="text" id="color" name="color" value="{{ old('color') }}" class="form-control">
                            @error('color')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="type_id" class="text-xs font-semibold px-1">Type</label>
                            <select name="type_id" id="type_id" class="form-select font-semibold text-xl px-1">
                                <option value="">Select Type</option>
                                @forelse ($types as $item)
                                    <option value="{{ $item->id }}" {{ old('type_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @empty
                                    <option value="">No types available</option>
                                @endforelse
                            </select>
                            @error('type_id')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-4">
                            <label for="district" class="text-xs font-semibold px-1">District</label>
                            <select name="district" id="district" class="form-select font-semibold text-xl px-1"
                                onchange="fetchFranchisesByDistrict()">
                                <option value="">Select District</option>
                                @forelse ($districts as $district)
                                    <option value="{{ $district }}" {{ old('district') == $district ? 'selected' : '' }}>
                                        {{ $district }}
                                    </option>
                                @empty
                                    <option value="">No districts available</option>
                                @endforelse
                            </select>
                            @error('district')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="franchise_id" class="text-xs font-semibold px-1">Franchise</label>
                            <select name="franchise_id" id="franchise_id" class="form-select font-semibold text-xl px-1"
                                onchange="fetchReceptionistsByFranchise()">
                                <option value="">Select Franchise</option>
                            </select>
                            @error('franchise_id')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="receptionist_id" class="text-xs font-semibold px-1">Receptionist</label>
                            <select name="receptionist_id" id="receptionist_id"
                                class="form-select font-semibold text-xl px-1">
                                <option value="">Select Receptionist</option>
                            </select>
                            @error('receptionist_id')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="problem" class="text-xs font-semibold px-1">Problem</label>
                        <textarea name="problem" class="form-control">{{ old('problem') }}</textarea>
                        @error('problem')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="franchise-list" class="mt-3">
                        <!-- Franchise and receptionist details will be dynamically inserted here -->
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
                },
                error: function (xhr) {
                    console.error('Error fetching customer details:', xhr);
                }
            });
        }

        function fetchFranchisesByDistrict() {
            var district = document.getElementById('district').value;

            if (!district) {
                $('#franchise_id').html('<option value="">Select Franchise</option>');
                $('#reciptionist_id').html('<option value="">Select Receptionist</option>');
                return;
            }

            $.ajax({
                url: "{{ route('franchises.byDistrict') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    district: district
                },
                success: function (response) {
                    if (response.success) {
                        var options = '<option value="">Select Franchise</option>';
                        response.franchises.forEach(function (franchise) {
                            options += '<option value="' + franchise.id + '">' + franchise.franchise_name + '</option>';
                        });
                        $('#franchise_id').html(options);
                        $('#reciptionist_id').html('<option value="">Select Receptionist</option>');
                    } else {
                        $('#franchise_id').html('<option value="">No franchises available</option>');
                        $('#reciptionist_id').html('<option value="">Select Receptionist</option>');
                    }
                },
                error: function (xhr) {
                    console.error('Error fetching franchises:', xhr);
                }
            });
        }

        function fetchReceptionistsByFranchise() {
            var franchiseId = document.getElementById('franchise_id').value;
            console.log('Franchise selected:', franchiseId);

            if (!franchiseId) {
                $('#receptionist_id').html('<option value="">Select Receptionist</option>');
                return;
            }

            $.ajax({
                url: "{{ route('receptionists.byFranchise') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    franchise_id: franchiseId
                },
                success: function (response) {
                    console.log('Receptionists response:', response);
                    if (response.success) {
                        var options = '<option value="">Select Receptionist</option>';
                        response.receptionists.forEach(function (receptionist) {
                            options += '<option value="' + receptionist.id + '">' + receptionist.name + '</option>';
                        });
                        $('#receptionist_id').html(options);
                    } else {
                        $('#receptionist_id').html('<option value="">No receptionists available</option>');
                    }
                },
                error: function (xhr) {
                    console.error('Receptionists AJAX error:', xhr.responseText);
                }
            });
        }
    </script>
@endsection
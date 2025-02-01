@extends('superadmin.layout')
@section('title', 'Create Franchise')
@section('content')

    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container mx-auto px-4 py-8">
            <!-- Success/Error Messages (same as before) -->

            <h1 class="text-3xl font-bold text-gray-800 mb-6">Create Franchise</h1>
            <!-- Stepper -->
            <div id="stepper" class="mb-6">
                <ol
                    class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                    <li class="flex items-center stepper-item text-blue-600 dark:text-blue-500">
                        <span class="flex items-center justify-center w-10 h-10 border rounded-full shrink-0">
                            1
                        </span>
                        <span class="ml-2">Personal Details</span>
                    </li>
                    <li class="flex items-center stepper-item">
                        <span class="flex items-center justify-center w-10 h-10 border rounded-full shrink-0">
                            2
                        </span>
                        <span class="ml-2">Address Details</span>
                    </li>
                    <li class="flex items-center stepper-item">
                        <span class="flex items-center justify-center w-10 h-10 border rounded-full shrink-0">
                            3
                        </span>
                        <span class="ml-2">Bank Details</span>
                    </li>
                </ol>
            </div>

            <form action="{{ route('franchises.store') }}" method="POST"
                class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
                @csrf
                <div id="step-1" class="step-content">
                    <!-- Personal Details Section -->
                    <div class="mb-8 border-b pb-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Personal Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Franchise Name -->
                            <div class="mb-4">
                                <label for="franchise_name" class="block text-gray-700 text-sm font-semibold mb-2">Franchise
                                    Name</label>
                                <input type="text" name="franchise_name" placeholder="Franchise name..."
                                    id="franchise_name" value="{{ old('franchise_name') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Contact No -->
                            <div class="mb-4">
                                <label for="contact_no" class="block text-gray-700 text-sm font-semibold mb-2">Contact
                                    No</label>
                                <input type="text" name="contact_no" id="contact_no" placeholder="+91XXXXXXXX"
                                    value="{{ old('contact_no') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                                <input type="email" name="email" id="email" placeholder="franchise@example.com"
                                    value="{{ old('email') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Aadhaar No -->
                            <div class="mb-4">
                                <label for="aadhaar_no" class="block text-gray-700 text-sm font-semibold mb-2">Aadhaar
                                    No</label>
                                <input type="text" name="aadhaar_no" id="aadhaar_no" placeholder="Aadhaar number..."
                                    value="{{ old('aadhaar_no') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- PAN No -->
                            <div class="mb-4">
                                <label for="pan_no" class="block text-gray-700 text-sm font-semibold mb-2">PAN No</label>
                                <input type="text" name="pan_no" id="pan_no" placeholder="PAN number..."
                                    value="{{ old('pan_no') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Date of Creation (DOC) -->
                            <div class="mb-4">
                                <label for="doc" class="block text-gray-700 text-sm font-semibold mb-2">Date of
                                    Creation (DOC)</label>
                                <input type="date" name="doc" id="doc" value="{{ old('doc') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                                <input type="password" name="password" placeholder="Password (8+ characters)" id="password"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                                <select name="status" id="status"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Details Section -->
                <div id="step-2" class="step-content hidden">
                    <div class="mb-8 border-b pb-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Address Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pincode -->
                            <div class="mb-4">
                                <label for="pincode"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Pincode</label>
                                <input type="text" name="pincode" id="pincode" placeholder="Pincode"
                                    value="{{ old('pincode') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required onblur="fetchLocation()">
                            </div>

                            <!-- Street -->
                            <div class="mb-4">
                                <label for="street"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Street</label>
                                <input type="text" name="street" placeholder="Street address" id="street"
                                    value="{{ old('street') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Auto-filled Fields -->
                            <div class="mb-4">
                                <label for="country"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Country</label>
                                <input type="text" name="country" placeholder="India" value="{{ old('country') }}" id="country"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>

                            <div class="mb-4">
                                <label for="state" class="block text-gray-700 text-sm font-semibold mb-2">State</label>
                                <input type="text" name="state" placeholder="Bihar" value="{{ old('state') }}" id="state"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>

                            <div class="mb-4">
                                <label for="district"
                                    class="block text-gray-700 text-sm font-semibold mb-2">District</label>
                                <input type="text" name="district" placeholder="Purnea" value="{{ old('district') }}" id="district"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>

                            <div class="mb-4">
                                <label for="city" class="block text-gray-700 text-sm font-semibold mb-2">City</label>
                                <input type="text" name="city" placeholder="Purnea" value="{{ old('city') }}" id="city"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bank Details Section -->
                <div id="step-3" class="step-content hidden">
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Bank Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- IFSC Code -->
                            <div class="mb-4">
                                <label for="ifsc_code" class="block text-gray-700 text-sm font-semibold mb-2">IFSC
                                    Code</label>
                                <input type="text" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code"
                                    value="{{ old('ifsc_code') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required onblur="fetchBranchDetails()">
                            </div>

                            <!-- Account No -->
                            <div class="mb-4">
                                <label for="account_no" class="block text-gray-700 text-sm font-semibold mb-2">Account
                                    No</label>
                                <input type="text" name="account_no" id="account_no" placeholder="Account number"
                                    value="{{ old('account_no') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Auto-filled Bank Fields -->
                            <div class="mb-4">
                                <label for="bank_name" class="block text-gray-700 text-sm font-semibold mb-2">Bank
                                    Name</label>
                                <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>

                            <div class="mb-4">
                                <label for="branch_name" class="block text-gray-700 text-sm font-semibold mb-2">Branch
                                    Name</label>
                                <input type="text" name="branch_name" id="branch_name"
                                    value="{{ old('branch_name') }}"
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight"
                                    readonly>
                            </div>
                        </div>

                    </div>

                </div>
                <div>
                    <!-- Submit Button -->
                    <!-- Step Navigation -->
                    <div class="mt-6 flex justify-between">
                        <button type="button"
                            class="btn-prev bg-gray-400 hover:bg-gray-500 text-white py-1 px-5 rounded hidden"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                              </svg></button>
                        <button type="button"
                            class="btn-next bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                              </svg></button>
                        <button type="submit"
                            class="btn-submit bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded hidden">Create
                            Franchise</button>
                    </div>

                </div>
            </form>
        </div>

        <!-- Keep the existing JavaScript code -->
    </div>

    <script>
        function fetchLocation() {
            let pincode = document.getElementById("pincode").value;

            fetch(`https://api.postalpincode.in/pincode/${pincode}`)
                .then(response => response.json())
                .then(data => {
                    if (data[0].Status === "Success") {
                        document.getElementById("city").value = data[0].PostOffice[0].District || "NULL";
                        document.getElementById("state").value = data[0].PostOffice[0].State || "NULL";
                        document.getElementById("country").value = data[0].PostOffice[0].Country || "NULL";
                        document.getElementById("district").value = data[0].PostOffice[0].District || "NULL";
                    } else {
                        alert("Invalid Pincode");
                    }
                })
                .catch(error => console.error("Error fetching location:", error));
        }

        function fetchBranchDetails() {
            let ifsc = document.getElementById("ifsc_code").value;

            fetch(`https://ifsc.razorpay.com/${ifsc}`)
                .then(response => response.json())
                .then(data => {
                    if (data.BANK && data.BRANCH) {
                        document.getElementById("bank_name").value = data.BANK || "NULL";
                        document.getElementById("branch_name").value = data.BRANCH || "NULL";
                    } else {
                        alert("Invalid IFSC Code");
                    }
                })
                .catch(error => console.error("Error fetching IFSC details:", error));
        }

        const steps = document.querySelectorAll(".step-content");
        const stepperItems = document.querySelectorAll(".stepper-item");
        let currentStep = 0;

        const btnNext = document.querySelector(".btn-next");
        const btnPrev = document.querySelector(".btn-prev");
        const btnSubmit = document.querySelector(".btn-submit");

        function updateButtons() {
            if (currentStep === 0) {
                btnPrev.classList.add("hidden");
                btnNext.classList.remove("hidden");
                btnSubmit.classList.add("hidden");
            } else if (currentStep === steps.length - 1) {
                btnPrev.classList.remove("hidden");
                btnNext.classList.add("hidden");
                btnSubmit.classList.remove("hidden");
            } else {
                btnPrev.classList.remove("hidden");
                btnNext.classList.remove("hidden");
                btnSubmit.classList.add("hidden");
            }
        }

        btnNext.addEventListener("click", () => {
            steps[currentStep].classList.add("hidden");
            stepperItems[currentStep].classList.remove("text-blue-600");
            currentStep++;
            steps[currentStep].classList.remove("hidden");
            stepperItems[currentStep].classList.add("text-blue-600");
            updateButtons();
        });

        btnPrev.addEventListener("click", () => {
            steps[currentStep].classList.add("hidden");
            stepperItems[currentStep].classList.remove("text-blue-600");
            currentStep--;
            steps[currentStep].classList.remove("hidden");
            stepperItems[currentStep].classList.add("text-blue-600");
            updateButtons();
        });

        updateButtons(); // Initialize buttons visibility based on the current step
    </script>


@endsection

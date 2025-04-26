<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Receipt - {{ $item->owner_name }}</title>
    <link rel="shortcut icon" href="{{ asset('Assets/faviconn.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <style>
    @media print {
        .print-flex {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }
        .print-flex .col-md-6 {
            width: 48% !important;
        }
    }
</style>

</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted fs-5 mb-0">
                        Receipt No: <strong>SX-{{ $item->id }}-{{ $item->type->id }}</strong>
                    </p>
                    <div class="d-print-none">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="fa fa-arrow-left text-danger"></i> Back
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-print text-primary"></i> Print
                        </button>
                    </div>
                </div>
                <hr>

                <!-- Company Branding -->
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-dark mb-0">NovaFix</h1>
                    <small class="text-muted">Fixing Today, Securing Tomorrow!</small>
                </div>

                <!-- User and Franchise Info -->
                <div class="row mb-4 print-flex">
    <div class="mt-5 mt-print-0 col-md-6">
        <ul class="list-unstyled text-muted">
            <li><strong>Name:</strong> <span class="text-primary">{{ $item->owner_name }}</span></li>
            <li><i class="fas fa-phone me-1"></i>{{ $item->contact }}</li>
            <li><i class="bi bi-envelope me-1"></i>{{ $item->email }}</li>
        </ul>
    </div>
    <div class="col-md-6">
        <ul class="list-unstyled text-end text-muted">
            <li>
                <i class="fas fa-map-marker-alt me-1 text-primary"></i><strong>NovaFix</strong><br>
                @if ($item->receptionist?->franchise)
                    {{ $item->receptionist->franchise->franchise_name }}<br>
                    {{ $item->receptionist->franchise->street }},<br>
                    ({{ $item->receptionist->franchise->district }}),
                    {{ $item->receptionist->franchise->state }} -
                    {{ $item->receptionist->franchise->pincode }}
                @else
                    <span class="text-danger">Franchise details not available</span>
                @endif
            </li>
            <li><i class="fas fa-phone me-1 text-primary"></i>{{ $item->receptionist->franchise?->contact_no ?? 'N/A' }}</li>
            <li><i class="fas fa-envelope me-1 text-primary"></i>{{ $item->receptionist->franchise?->email ?? 'N/A' }}</li>
        </ul>
    </div>
</div>

                <!-- Device & Service Info Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped align-middle">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td class="text-uppercase">{{ $item->owner_name }}</td>
                                <th>Service Code</th>
                                <td class="text-uppercase text-info">{{ $item->service_code }}</td>
                            </tr>
                            <tr>
                                <th>Problem</th>
                                <td class="text-uppercase">{{ $item->problem }}</td>
                                <th>Brand</th>
                                <td class="text-uppercase">{{ $item->brand }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td class="text-uppercase">{{ $item->type->name }}</td>
                                <th>S.N</th>
                                <td class="text-uppercase">{{ $item->serial_no }}</td>
                            </tr>
                            <tr>
                                <th>MAC</th>
                                <td class="text-uppercase">{{ $item->MAC }}</td>
                                <th>Color</th>
                                <td class="text-uppercase">{{ $item->color }}</td>
                            </tr>
                            <tr>
                                <th>Model No</th>
                                <td class="text-uppercase">{{ $item->product_name }}</td>
                                <th>Delivery Date</th>
                                <td>{{ date('d M Y') }}</td>
                            </tr>
                            @if ($item->status != 4 && $item->status != 5)
                                <tr>
                                    <th>Estimated Delivery</th>
                                    <td>{{ date('d M Y', strtotime('+10 days')) }}</td>
                                    <th>Status</th>
                                    <td>
                                        <span class="fw-bold px-2 py-1 rounded"
                                            style="color:{{ StatusColor($item->status) }}">
                                            {{ $item->getStatus() }}
                                        </span>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Remark</th>
                                <td colspan="3" class="text-uppercase">{{ $item->remark ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Thank You Note -->
                <div class="text-muted mb-4">
                    Thank you for choosing NovaFix. We appreciate your trust in our service!
                </div>

                <hr>

                <!-- Terms & Conditions -->
                <div>
                    <h6><strong>Terms & Conditions:</strong></h6>
                    <ul class="text-muted">
                        <li>1. We will not be responsible if the product is not taken back within 30 days.</li>
                        <li>2. Please confirm by phone before collecting your product.</li>
                        <li>3. Warranty applies only to GST-included repairs.</li>
                        <li>4. Rs. 350 checking fee applies if not repaired or repair declined.</li>
                    </ul>
                </div>

                <!-- Signature -->
                <div class="text-end mt-4">
                    <h6><strong>Authorized Sign & Stamp</strong></h6>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{--
    <script src="{{ asset(" dist/js/demo.js") }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script>
        function toggleAmountDisplay() {
            const amountField = document.getElementById('service_amount');
            const amountDisplay = document.getElementById('amount-display');

            if (amountField.value) {
                amountDisplay.textContent = '₹ ' + amountField.value; // Update with the new amount
                amountField.style.display = 'none'; // Hide the input field
                amountDisplay.style.display = 'inline'; // Show the updated price as text

                saveAmountToDatabase(amountField.value);
            }
        }

        function saveAmountToDatabase(amount) {
            const xhr = new XMLHttpRequest();
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Amount saved successfully');
                }
            };
            xhr.send(JSON.stringify({
                amount: amount,
                item_id: '{{ $item->id }}'
            }));
        }

        // Initially show the price as text and input is hidden if an amount exists
        window.onload = function () {
            const amountField = document.getElementById('service_amount');
            const amountDisplay = document.getElementById('amount-display');

            if (amountField.value) {
                amountDisplay.textContent = '₹ ' + amountField.value; // Set the initial price text
                amountField.style.display = 'none'; // Hide the input field initially
                amountDisplay.style.display = 'inline'; // Show the price as text initially
            } else {
                amountDisplay.style.display = 'none'; // Hide the price text if no value
                amountField.style.display = 'inline'; // Show the input field initially
            }

            // Add the "Enter" key event listener to the input field
            amountField.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent default "Enter" behavior
                    toggleAmountDisplay(); // Trigger the function to save and update the amount
                }
            });
        };
    </script>

</body>

</html>
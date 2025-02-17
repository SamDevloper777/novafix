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
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Receipt No: <strong
                                    class="text-uppercase">SX-{{ $item->id }}-{{ $item->type->id }}</strong></p>
                        </div>
                        <div class="col-xl-3 float-end d-print-none">
                            <a href="{{ url()->previous() }}" class="btn btn-light text-capitalize"
                                data-mdb-ripple-color="dark"><i class="fa fa-arrow-left text-danger"></i> back</a>
                            <a type="button" onclick="window.print()" id="print-button"
                                class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                    class="fas fa-print text-primary"></i> Print</a>
                        </div>
                        <hr />
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="text-center">
                                <h1 class="fw-bold text-dark">NovaFix</h1>
                                <p>Fixing Today, Securing Tomorrow!</p>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <ul class="list-unstyled">
                                        <li class="text-muted">Name: <span
                                                style="color:#5d9fc5 ;">{{ $item->owner_name }}</span></li>
                                        <li class="text-muted"><i class="fas fa-phone"></i> {{ $item->contact }}</li>
                                        <li class="text-muted"><i class="bi bi-envelope"></i> {{ $item->email }}</li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <ul class="list-unstyled">
                                        <li class="text-muted">
                                            <i class="fas fa-map-marker" style="color:#84B0CA;"></i>
                                            <span class="fw-bold">NovaFix</span><br>
                                            @if ($item->receptionist?->franchise)
                                                {{ $item->receptionist->franchise->franchise_name }} <br>
                                                {{ $item->receptionist->franchise->street }}, <br>
                                                <!-- {{ $item->receptionist->franchise->city }} -->
                                                ({{ $item->receptionist->franchise->district }}),
                                                {{ $item->receptionist->franchise->state }} -
                                                {{ $item->receptionist->franchise->pincode }} <br>
                                            @else
                                                <span class="text-danger">Franchise details not available</span>
                                            @endif
                                        </li>
                                        <li class="text-muted">
                                            <i class="fas fa-phone" style="color:#84B0CA;"></i>
                                            <span
                                                class="fw-bold">{{ $item->receptionist->franchise?->contact_no ?? 'N/A' }}</span>
                                        </li>
                                        <li class="text-muted">
                                            <i class="fas fa-envelope" style="color:#84B0CA;"></i>
                                            <span
                                                class="fw-bold">{{ $item->receptionist->franchise?->email ?? 'N/A' }}</span>
                                        </li>
                                        <li class="text-muted">
                                            <i class="fas fa-circle" style="color:#84B0CA;"></i>
                                            <span class="fw-bold">Creation Date:</span>
                                            {{ date('d M Y', strtotime($item->created_at)) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row my-2 mx-1 justify-content-center">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <td class="text-uppercase">{{ $item->owner_name }}</td>
                                            <th scope="col">Service code</th>
                                            <td class="text-uppercase">
                                                <h4 class="m-0 text-info">{{ $item->service_code }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Problem</th>
                                            <td class="text-uppercase">{{ $item->problem }}</td>
                                            <th scope="col">Brand</th>
                                            <td class="text-uppercase">{{ $item->brand }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Type</th>
                                            <td class="text-uppercase">{{ $item->type->name }}</td>
                                            <th scope="col">S.N</th>
                                            <td class="text-uppercase">{{ $item->serial_no }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">MAC</th>
                                            <td class="text-uppercase">{{ $item->MAC }}</td>
                                            <th scope="col">Color</th>
                                            <td class="text-uppercase">{{ $item->color }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Model No</th>
                                            <td class="text-uppercase">{{ $item->product_name }}</td>
                                            <th scope="col">Est Delivery Date</th>
                                            <td class="text-uppercase">
                                                {{ date('d M Y', strtotime('+10')) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <td class="text-uppercase "><span class="font-weight-bold rounded px-2 py-1"
                                                    style="color:{{StatusColor($item->status)}};">{{ $item->getStatus() }}</span>
                                            </td>
                                            <th scope="col">Remark</th>
                                            <td class="text-uppercase">
                                                {{ $item->remark == null ? 'N/A' : $item->remark }}
                                            </td>
                                        </tr>
                                        @if ($item->status != 'work done')
                                            <tr>
                                                <th scope="col">Total Amount</th>
                                                <td colspan="3" class="text-uppercase text-end text-center">
                                                    <span id="amount-display">
                                                        @if($item->amount)
                                                            ₹ {{ $item->amount }}
                                                        @endif
                                                    </span>
                                                    <input type="text" class="form-control" name="service_amount"
                                                        id="service_amount" placeholder="Service Amount"
                                                        value="{{ $item->amount ?? '' }}"
                                                        style="{{ $item->amount ? 'display:none;' : 'display:inline;' }}"
                                                        onblur="updateAmounts()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">GST (18%)</th>
                                                <td class="text-uppercase" id="gst-display">₹
                                                    {{ number_format($gst_amount, 2) }}
                                                </td>


                                                <th scope="col">Total Amount (Including GST)</th>
                                                <td colspan="3" class="text-uppercase text-end text-center">
                                                    <strong id="total-amount-display">₹
                                                        {{ number_format($total_with_gst, 2) }}</strong>
                                                </td>
                                            </tr>


                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-xl-8">
                                    <p class="ms-3">Add additional notes and payment information</p>
                                </div>
                            </div>

                            <hr>
                            <div class="flex justify-content-between row">
                                <div class="col-xl-10">
                                    <p>Thank you for choosing NovaFix. We appreciate your trust in our service!</p>
                                </div>
                                <div class="col-xl-5 col-lg-6 col-md-12 mb-3">
                                    <p><strong>Terms & Conditions:</strong></p>
                                    <ul class="list-unstyled">
                                        <li>1. We will not be responsible if the product are not taken back within 30
                                            days.</li>
                                        <li>2. Before coming to collect the product, call and make sure.</li>
                                        <li>3. Warranty guarantee will not be valid for repairing of any item.
                                        </li>
                                    </ul>
                                </div>
                                @if ($item->status === 'work done')
                                    <p><strong>6-Month Warranty:</strong></p>
                                @endif                                  <div class="col-xl-2">
                                    <h6>Authorized Sign & Stamp</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
        function updateAmounts() {
            const amountField = document.getElementById('service_amount');
            const amountDisplay = document.getElementById('amount-display');
            const serviceAmount = parseFloat(amountField.value);
            const gstRate = 0.18;  // GST is 18%

            if (!isNaN(serviceAmount)) {
                // Calculate GST and Total
                const gstAmount = serviceAmount * gstRate;
                const totalAmount = serviceAmount + gstAmount;

                // Update GST and Total Amount display
                document.getElementById('gst-display').textContent = '₹ ' + gstAmount.toFixed(2);
                document.getElementById('total-amount-display').textContent = '₹ ' + totalAmount.toFixed(2);

                // Update the display of the amount
                amountDisplay.textContent = '₹ ' + serviceAmount.toFixed(2);  // Display the updated amount
                amountField.style.display = 'none'; // Hide the input field
                amountDisplay.style.display = 'inline'; // Show the updated price as text

                // Save the updated amount to the database
                saveAmountToDatabase(serviceAmount);
            } else {
                // Handle invalid input by hiding the GST and Total fields
                document.getElementById('gst-display').textContent = '₹ 0.00';
                document.getElementById('total-amount-display').textContent = '₹ 0.00';
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

        // Add event listener for the Enter key
        document.getElementById('service_amount').addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();  // Prevent form submission (if it's part of a form)
                updateAmounts();  // Trigger the updateAmounts function
            }
        });

        // Initially set the price, GST, and total amounts when the page loads
        window.onload = function () {
            const amountField = document.getElementById('service_amount');
            const amountDisplay = document.getElementById('amount-display');
            const initialAmount = parseFloat(amountField.value);

            if (!isNaN(initialAmount)) {
                // Calculate GST and Total
                const gstAmount = initialAmount * 0.18;
                const totalAmount = initialAmount + gstAmount;

                // Update GST and Total Amount display
                document.getElementById('gst-display').textContent = '₹ ' + gstAmount.toFixed(2);
                document.getElementById('total-amount-display').textContent = '₹ ' + totalAmount.toFixed(2);
            }

            // Set initial display for the amount field
            if (amountField.value) {
                amountDisplay.textContent = '₹ ' + amountField.value;
                amountField.style.display = 'none';
                amountDisplay.style.display = 'inline';
            } else {
                amountDisplay.style.display = 'none';
                amountField.style.display = 'inline';
            }
        };
    </script>

</body>

</html>
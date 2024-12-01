<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/alcobra.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


</head>

<body>

    <div class="main-wrapper">

        @include('admin.layouts.header')

        @include('admin.layouts.sidebar')

        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')
            </div>
        </div>

        @include('admin.layouts.footer')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    @yield('scripts')

    <script>
        $(document).ready(function() {
            // Toggle the arrow icon when collapsing
            $('.toggle-arrow').click(function() {
                $(this).find('i').toggleClass('feather-chevron-down feather-chevron-up');
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Display Toastr messages with progress bar -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true, // Add progress bar
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000", // Show duration (in ms)
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>


    {{-- <!-- Script to handle dynamic service type loading based on selected service -->
    <script>
        document.getElementById('service_id').addEventListener('change', function() {
            const serviceId = this.value;
            const serviceTypeSelect = document.getElementById('servicetype_id');

            // Clear previous options
            serviceTypeSelect.innerHTML = '<option value="">-- Select Service Type --</option>';

            // Fetch service types for the selected service
            fetch(`/api/service-types/${serviceId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name} - ${type.price} FRW`;
                        serviceTypeSelect.appendChild(option);
                    });
                });
        });
    </script> --}}

    {{--
    <script>
        document.getElementById('service_id').addEventListener('change', function() {
            var serviceId = this.value;
            var serviceTypeSelect = document.getElementById('service_type_id');

            // Reset service type options
            serviceTypeSelect.innerHTML = '<option value="">-- Select Service Type --</option>';

            // Loop through the service types and only show the ones matching the selected service
            @foreach ($serviceTypes as $serviceType)
                if ({{ $serviceType->service_id }} == serviceId) {
                    var option = document.createElement('option');
                    option.value = '{{ $serviceType->id }}';
                    option.text = '{{ $serviceType->name }} ({{ number_format($serviceType->price, 0) }} FRW)';
                    serviceTypeSelect.appendChild(option);
                }
            @endforeach
        });
    </script> --}}

    <!-- Script to handle dynamic service type loading based on selected service -->
    <script>
        document.getElementById('service_id').addEventListener('change', function() {
            const serviceId = this.value;
            const serviceTypeSelect = document.getElementById('servicetype_id');

            // Clear previous options
            serviceTypeSelect.innerHTML = '<option value="">-- Select Service Type --</option>';

            // Fetch service types for the selected service
            fetch(`/api/service-types/${serviceId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name} - ${type.price} FRW`;
                        serviceTypeSelect.appendChild(option);
                    });
                });
        });
    </script>


</body>

</html>

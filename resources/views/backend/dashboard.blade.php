@extends('layouts.backend')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-corner-img">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-9">
                                        <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Patients</p>
                                        <h4 class="mt-1 mb-0 fw-medium">{{ $totalPatients }}</h4>
                                    </div><!--end col-->
                                    <div class="col-3 align-self-center">
                                        <div class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                            <i class="iconoir-user fs-22 align-self-center mb-0 text-primary"></i>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-corner-img">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-9">
                                        <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Doctors</p>
                                        <h4 class="mt-1 mb-0 fw-medium">{{ $totalDoctors }}</h4>
                                    </div><!--end col-->
                                    <div class="col-3 align-self-center">
                                        <div class="d-flex justify-content-center align-items-center thumb-md border-dashed border-info rounded mx-auto">
                                            <i class="iconoir-healthcare fs-22 align-self-center mb-0 text-info"></i>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-corner-img">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-9">
                                        <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Active Patients</p>
                                        <h4 class="mt-1 mb-0 fw-medium">{{ $activePatients }}</h4>
                                    </div><!--end col-->
                                    <div class="col-3 align-self-center">
                                        <div class="d-flex justify-content-center align-items-center thumb-md border-dashed border-warning rounded mx-auto">
                                            <i class="iconoir-heart-solid fs-22 align-self-center mb-0 text-warning"></i>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-corner-img">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-9">
                                        <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Doctors on Duty</p>
                                        <h4 class="mt-1 mb-0 fw-medium">{{ $activeDoctors }}</h4>
                                    </div><!--end col-->
                                    <div class="col-3 align-self-center">
                                        <div class="d-flex justify-content-center align-items-center thumb-md border-dashed border-danger rounded mx-auto">
                                            <i class="iconoir-badge-check fs-22 align-self-center mb-0 text-danger"></i>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
                
                <div class="row justify-content-center">

                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Appointments This Week</h4>
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div id="weekly-appointments-chart" class="apex-charts"></div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Appointment Status</h4>
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div id="appointment-status-chart" class="apex-charts"></div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Today's Appointments</h4>
                                    </div><!--end col-->
                                    <div class="col-auto">
                                        <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                                    </div><!--end col-->
                                </div>  <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                @forelse ($todaysAppointments as $todaysAppointment)
                                    <div class="d-flex align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        <div class="d-flex justify-content-center align-items-center thumb-sm bg-primary-subtle text-primary rounded-circle me-2">
                                            <i class="las la-user-injured"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="m-0 text-truncate">{{ $todaysAppointment->patient->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">Dr. {{ $todaysAppointment->doctor->name ?? 'N/A' }}</small>
                                        </div>
                                        <span class="text-muted fs-13">{{ \Carbon\Carbon::parse($todaysAppointment->appointment_time)->format('h:i A') }}</span>
                                    </div><!--end appointment-item-->
                                @empty
                                    <p class="text-muted text-center py-3 mb-0">No appointments scheduled for today.</p>
                                @endforelse
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Bed Availability</h5>
                                    <a href="{{ route('admin.beds.index') }}" class="btn btn-sm btn-soft-primary">Manage</a>
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <div>
                                        <h4 class="mb-0">{{ $bedCounts['total'] }}</h4>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 text-success">{{ $bedCounts['available'] }}</h4>
                                        <small class="text-muted">Available</small>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 text-danger">{{ $bedCounts['occupied'] }}</h4>
                                        <small class="text-muted">Occupied</small>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Staff On Duty</h5>
                                    <a href="{{ route('admin.duty-logs.index') }}" class="btn btn-sm btn-soft-primary">View Board</a>
                                </div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $onDutyCount }}</h4>
                                    <small class="text-muted">staff currently on an active task</small>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">

                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Recently Registered Patients</h4>
                                    </div><!--end col-->
                                    <div class="col-auto">
                                        <a href="{{ route('admin.patients.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentPatients as $recentPatient)
                                                <tr>
                                                    <td>{{ $recentPatient->patient_id }}</td>
                                                    <td><a href="{{ route('admin.patients.show', $recentPatient) }}">{{ $recentPatient->name }}</a></td>
                                                    <td>{{ $recentPatient->gender }}</td>
                                                    <td>
                                                        <span class="badge {{ $recentPatient->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $recentPatient->status }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">No patients registered yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div><!--end table-responsive-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Recent Invoices</h4>
                                    </div><!--end col-->
                                    <div class="col-auto">
                                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Patient</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentInvoices as $recentInvoice)
                                                <tr>
                                                    <td><a href="{{ route('admin.invoices.show', $recentInvoice) }}">{{ $recentInvoice->invoice_no }}</a></td>
                                                    <td>{{ $recentInvoice->patient->name ?? 'N/A' }}</td>
                                                    <td>{{ number_format($recentInvoice->total, 2) }}</td>
                                                    <td>
                                                        @php
                                                            $statusClass = match ($recentInvoice->status) {
                                                                'Paid' => 'bg-success-subtle text-success',
                                                                'Partial' => 'bg-warning-subtle text-warning',
                                                                default => 'bg-danger-subtle text-danger',
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $statusClass }}">{{ $recentInvoice->status }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">No invoices created yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div><!--end table-responsive-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                </div><!--end row-->

@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        (function () {
            var weeklyLabels = @json($weeklyLabels);
            var weeklyCounts = @json($weeklyCounts);

            var weeklyChart = new ApexCharts(document.querySelector("#weekly-appointments-chart"), {
                series: [{ name: 'Appointments', data: weeklyCounts }],
                chart: { type: 'bar', height: 280, toolbar: { show: false } },
                plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } },
                dataLabels: { enabled: false },
                xaxis: { categories: weeklyLabels },
                colors: ['#3454d1'],
            });
            weeklyChart.render();

            var statusCounts = @json($appointmentStatusCounts);
            var statusValues = Object.values(statusCounts);
            var hasStatusData = statusValues.some(function (v) { return v > 0; });

            var statusChart = new ApexCharts(document.querySelector("#appointment-status-chart"), {
                series: hasStatusData ? statusValues : [1],
                labels: hasStatusData ? Object.keys(statusCounts) : ['No data yet'],
                chart: { type: 'donut', height: 280 },
                colors: ['#0dcaf0', '#28a745', '#dc3545'],
                legend: { position: 'bottom', fontSize: '13px' },
                dataLabels: { enabled: hasStatusData },
            });
            statusChart.render();
        })();
    </script>
@endpush

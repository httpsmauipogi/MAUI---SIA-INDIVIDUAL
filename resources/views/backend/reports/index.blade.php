@extends('layouts.backend')

@section('title', 'Reports & Analytics')
@section('page-title', 'Reports & Analytics')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.reports.index') }}" class="d-flex flex-wrap gap-2 align-items-end">
                    <div>
                        <label class="form-label mb-1">From</label>
                        <input type="date" name="from" class="form-control" value="{{ $from->format('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="form-label mb-1">To</label>
                        <input type="date" name="to" class="form-control" value="{{ $to->format('Y-m-d') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-light">Last 30 Days</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Revenue</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ number_format($totalRevenue, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Collected</p>
                <h4 class="mt-1 mb-0 fw-medium text-success">{{ number_format($totalCollected, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Outstanding Due</p>
                <h4 class="mt-1 mb-0 fw-medium text-danger">{{ number_format($totalDue, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Expenses</p>
                <h4 class="mt-1 mb-0 fw-medium text-warning">{{ number_format($totalExpenses, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Net Profit</p>
                <h4 class="mt-1 mb-0 fw-medium {{ $netProfit >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($netProfit, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">New Patients</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $newPatients }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Revenue Trend</h4>
            </div>
            <div class="card-body pt-0">
                <div id="revenue-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Appointment Status</h4>
            </div>
            <div class="card-body pt-0">
                <div id="appointment-status-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Doctor-wise Patient Load</h5>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Specialization</th>
                                <th class="text-end">Appointments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctorLoad as $row)
                                <tr>
                                    <td>Dr. {{ $row['doctor']->name ?? 'N/A' }}</td>
                                    <td>{{ $row['doctor']->specialization ?? '-' }}</td>
                                    <td class="text-end fw-medium">{{ $row['count'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No appointments in this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Operational Snapshot</h5>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted">Total Appointments (period)</td>
                                <td class="text-end fw-medium">{{ $totalAppointments }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Total Doctors</td>
                                <td class="text-end fw-medium">{{ $totalDoctors }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Lab Orders (period)</td>
                                <td class="text-end fw-medium">{{ $labOrdersCount }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Lab Orders Completed</td>
                                <td class="text-end fw-medium">{{ $labOrdersCompleted }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="mt-4 mb-2">Low Stock Medicines <a href="{{ route('admin.pharmacy.index', ['filter' => 'low_stock']) }}" class="fs-13">(view all)</a></h6>
                @forelse ($lowStockMedicines as $medicine)
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span>{{ $medicine->name }}</span>
                        <span class="text-warning fw-medium">{{ $medicine->stock_quantity }} {{ $medicine->unit }}(s) left</span>
                    </div>
                @empty
                    <p class="text-muted mb-0">No medicines are currently low on stock.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script>
    (function () {
        var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), {
            series: [{ name: 'Revenue', data: @json($revenueSeries) }],
            chart: { type: 'area', height: 300, toolbar: { show: false } },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: { categories: @json($revenueLabels) },
            colors: ['#3454d1'],
        });
        revenueChart.render();

        var statusCounts = @json($appointmentStatusCounts);
        var statusValues = Object.values(statusCounts);
        var hasStatusData = statusValues.some(function (v) { return v > 0; });

        var statusChart = new ApexCharts(document.querySelector("#appointment-status-chart"), {
            series: hasStatusData ? statusValues : [1],
            labels: hasStatusData ? Object.keys(statusCounts) : ['No data'],
            chart: { type: 'donut', height: 300 },
            colors: ['#0dcaf0', '#28a745', '#dc3545'],
            legend: { position: 'bottom', fontSize: '13px' },
            dataLabels: { enabled: hasStatusData },
        });
        statusChart.render();
    })();
</script>
@endpush

@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Expiry Alerts</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Expiring Medicines</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <!-- Removed Category column -->
                        <th>Supplier</th>
                        <th>Current Stock</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($stocks as $index => $stock)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $stock->medicine }}</td>
                            <!-- Removed Category column -->
                            <td>{{ $stock->supplier ? $stock->supplier->supplier_name : 'N/A' }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->expiry_date->format('Y-m-d') }}</td>
                            <td>
                                @if ($stock->expiry_status == 'Expired')
                                    <span class="badge badge-danger w-100 text-center d-block">Expired</span>
                                @elseif ($stock->expiry_status == 'Expiring Soon')
                                    <span class="badge badge-warning w-100 text-center d-block">Expiring Soon</span>
                                @else
                                    <span class="badge badge-success w-100 text-center d-block">Safe</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <!-- Updated colspan to 6 due to Category removal -->
                            <td colspan="6" class="text-center">No stock records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush

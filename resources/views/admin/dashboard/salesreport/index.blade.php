@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S - Sales Report')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Sales Report</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Sales Report</h6>
            <!-- Added filter dropdown to match saleshistory -->
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">This Week</a>
                    <a class="dropdown-item" href="#">This Month</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Updated table to match saleshistory structure -->
                <table class="table table-bordered" id="salesTable">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <!-- Fetch medicine name dynamically -->
                            <td>{{ $transaction->medicine->name ?? 'N/A' }}</td>
                            <td>{{ number_format($transaction->unit_price, 2) }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ number_format($transaction->total, 2) }}</td>
                            <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <!-- Adjusted colspan to 6 -->
                            <td colspan="6" class="text-center">No sales history available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <!-- Adjusted colspan and added dynamic total sales -->
                        <td colspan="5" class="text-right font-weight-bold">Total Sales:</td>
                        <td class="font-weight-bold">UGX{{ number_format($totalSales, 2) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Added DataTables plugins to match saleshistory -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Added DataTables initialization script -->
    <script>
        $(document).ready(function() {
            $('#salesTable').DataTable({
                "order": [[5, "desc"]], // Sort by date descending
                "pageLength": 25
            });
        });
    </script>
@endpush

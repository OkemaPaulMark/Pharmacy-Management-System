@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Sales History</h1>
            <a href="#" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sales history</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Medicine</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Paracetamol</td>
                            <td>Painkiller</td>
                            <td>$5</td>
                            <td>10</td>
                            <td>$50</td>
                        
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Amoxicillin</td>
                            <td>Antibiotic</td>
                            <td>$8</td>
                            <td>5</td>
                            <td>$40</td>
                         
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Cough Syrup</td>
                            <td>Cough & Cold</td>
                            <td>$12</td>
                            <td>3</td>
                            <td>$36</td>
                            <!-- <td>
                                <a href="#" class="btn btn-info btn-sm">View</a>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td> -->
                        </tr>
                    </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Total Sales:</td>
                                <td id="grandTotal">0.00</td>
                                <!-- <td>
                                    <button id="checkoutBtn" class="btn btn-primary">Chec</button>
                                </td> -->
                            </tr>
                        </tfoot>
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
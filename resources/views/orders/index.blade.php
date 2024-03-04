@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Orders</h5>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Order
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Order Date</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->reference }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->customer->firstname }} {{ $order->customer->name }}</td>
                                            <td>
                                                @switch($order->status)
                                                    @case('in progress')
                                                        <span class="badge badge-warning">In Progress</span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge badge-success">Completed</span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                        @break
                                                @endswitch
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <div class="actions">
                                                        <a href="#" class="showRow">
                                                            <i class="bi bi-eye text-primary" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Icône pour afficher les détails -->
                                                        </a>
                                                        <a href="{{ route('orders.edit', $order->id) }}" class="editRow" style="vertical-align: middle;">
                                                            <i class="bi bi-pencil text-warning" style="font-size: 1.2rem;"></i> <!-- Icône de modification -->
                                                        </a>
                                                        <form id="deleteForm{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block; vertical-align: middle;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDeleteO('{{ $order->id }}'); return false;" style="border: none; background: none;">
                                                                <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i> <!-- Changement de couleur -->
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">No orders found.</p>
                        @endif
                    </div>
                </div>

            </div>
            <style>
                .icon-space {
                    margin-right: 5px;
                }
            </style>
        </div>
    </div>
    <div class="row">

        {{ $orders->links() }}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function confirmDeleteO(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + orderId).submit();
                }
            });
        }
    </script>
@endsection

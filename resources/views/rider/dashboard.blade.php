@extends('themes.xylo.layouts.master')
@php
    $hideHeader = true;
@endphp
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Rider Dashboard</h2>

    <h4>Assigned Orders</h4>
    <div id="orders">
        {{-- Loop assigned orders here --}}
        <div class="card mb-3">
            <div class="card-body">
                <strong>Order #1234</strong><br>
                Customer: John Doe<br>
                Address: 123 Main St<br>
                Status: <span id="status-1234">Pending</span><br><br>
                
                <button onclick="updateStatus(1234, 'picked_up')">Mark as Picked Up</button>
                <button onclick="updateStatus(1234, 'in_transit')">Mark as In Transit</button>
                <button onclick="updateStatus(1234, 'delivered')">Mark as Delivered</button>
            </div>
        </div>
    </div>

    <h4>Account Settings</h4>
    <form>
        <label for="contact">Contact Info</label>
        <input type="text" id="contact" name="contact" placeholder="Enter phone or email">
        <button type="submit">Update</button>
    </form>

    <br>
    <a href="/">Logout</a> {{-- or use JS to clear session or redirect --}}
</div>
@endsection

@section('scripts')
<script>
function updateStatus(orderId, status) {
    // You can call a backend route here using fetch or axios
    document.getElementById('status-' + orderId).innerText = status.replace('_', ' ');
    alert('Status updated to: ' + status);
}
</script>
@endsection

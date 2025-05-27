@extends('themes.xylo.layouts.master')

@section('content')

<style>
    header {
        display: none !important;
    }
    /* Navbar styles */
    .seller-navbar {
        display: flex;
        gap: 12px;
        background: #f0f0f0;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .seller-navbar button {
        background: #007bff;
        color: white;
        border: none;
        padding: 8px 14px;
        cursor: pointer;
        border-radius: 4px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        min-width: 120px; /* optional for consistent size */
    }
    .seller-navbar button:hover {
        background: #0056b3;
    }
    .seller-navbar button.active {
        background: #0056b3;
    }
    /* Section styles */
    .dashboard-section {
        display: none;
    }
    .dashboard-section.active {
        display: block;
    }
    h4 {
        margin-top: 0;
        margin-bottom: 10px;
        color: #333;
    }
    /* Form styling */
    form input[type="text"] {
        padding: 8px;
        width: 300px;
        max-width: 100%;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    form button {
        background: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    form button:hover {
        background: #1e7e34;
    }
    a.logout-link {
        display: inline-block;
        margin-top: 20px;
        color: #dc3545;
        font-weight: 600;
        text-decoration: none;
    }
    a.logout-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container py-4" style="margin-top: 80px;">
    <h2 class="mb-4">Seller Dashboard</h2>

    <nav class="seller-navbar" aria-label="Seller dashboard navigation">
        <button class="active" data-section="product-listings">Product Listings</button>
        <button data-section="recommended-products">Recommended Products</button>
        <button data-section="seller-profiles">Seller Profiles</button>
        <button data-section="create-orders">Create Orders</button>
        <button data-section="order-history">Order History</button>
        <button data-section="track-orders">Track Order Status</button>
        <button data-section="account-settings">Account Settings</button>
    </nav>

    <section id="product-listings" class="dashboard-section active">
        <h4>View All Product Listings</h4>
        <p>List of all your products here (dummy data for now)</p>
        <ul>
            <li>Product 1 - $100</li>
            <li>Product 2 - $50</li>
        </ul>
    </section>

    <section id="recommended-products" class="dashboard-section">
        <h4>View Recommended Products (ML-based)</h4>
        <p>Recommended products based on your sales and browsing data.</p>
    </section>

    <section id="seller-profiles" class="dashboard-section">
        <h4>View Seller Profiles</h4>
        <p>List of other sellers or your profile info.</p>
    </section>

    <section id="create-orders" class="dashboard-section">
        <h4>Create Orders</h4>
        <button onclick="alert('Add to Cart clicked')">Add to Cart</button>
        <button onclick="alert('Checkout clicked')">Checkout</button>
        <button onclick="alert('Pay via GCash clicked')">Pay via GCash</button>
    </section>

    <section id="order-history" class="dashboard-section">
        <h4>Order History</h4>
        <p>View Past Orders</p>
        <ul>
            <li>Order #1001 - Delivered</li>
            <li>Order #1002 - In Transit</li>
        </ul>
    </section>

    <section id="track-orders" class="dashboard-section">
        <h4>Track Order Status</h4>
        <p>Track current orders here.</p>
    </section>

    <section id="account-settings" class="dashboard-section">
        <h4>Account Settings</h4>
        <form onsubmit="event.preventDefault(); alert('Personal info updated!');">
            <label for="personal-info">Update Personal Information</label><br>
            <input type="text" id="personal-info" name="personal-info" placeholder="Name, Contact, etc.">
            <button type="submit">Update</button>
        </form>
    </section>

    <a href="/" class="logout-link">Logout</a>
</div>

@section('scripts')
<script>
    const buttons = document.querySelectorAll('.seller-navbar button');
    const sections = document.querySelectorAll('.dashboard-section');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all buttons
            buttons.forEach(b => b.classList.remove('active'));
            // Hide all sections
            sections.forEach(s => s.classList.remove('active'));

            // Activate clicked button and its section
            btn.classList.add('active');
            const sectionId = btn.getAttribute('data-section');
            document.getElementById(sectionId).classList.add('active');
        });
    });
</script>
@endsection

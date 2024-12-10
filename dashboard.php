<?php 

  include 'core/init.php';

  $invoices = $getFromInv->invoices();
  $clients = $getFromC->clients();
  $payments = $getFromP->payments();

  $invoicesTotal = $getFromInv->invoicesCountTotal();
  $invoicesPaid = $getFromInv->invoicesCountPaid();
  $invoicesUnpaid = $getFromInv->invoicesCountUnpaid();

  $clientsTotal = $getFromC->clientsCountTotal();
  $paymentsTotal = $getFromP->paymentsCountTotal();

?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<header class="bg-white shadow p-4 flex justify-between items-center">
    <div class="flex items-center">
        <i class="fas fa-cog text-orange-600 text-2xl mr-2"></i>
        <span class="text-xl font-bold text-orange-600">vocabill</span>
    </div>
    <nav class="space-x-4 hidden md:flex">
        <a class="text-gray-600 hover:text-gray-800" href="dashboard.php">Dashboard</a>
        <a class="text-gray-600 hover:text-gray-800" href="invoices.php">Invoices</a>
        <a class="text-gray-600 hover:text-gray-800" href="#">Clients</a>
        <a class="text-gray-600 hover:text-gray-800" href="#">Payments</a>
        <a class="text-gray-600 hover:text-gray-800" href="#">Settings</a>
        <a class="text-gray-600 hover:text-gray-800" href="logout.php">Logout</a>
    </nav>
    <div class="md:hidden">
        <button id="menuButton" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>
<div id="mobileMenu" class="hidden md:hidden bg-white shadow p-4">
    <nav class="space-y-2">
        <a class="block text-gray-600 hover:text-gray-800" href="dashboard.php">Dashboard</a>
        <a class="block text-gray-600 hover:text-gray-800" href="invoices.php">Invoices</a>
        <a class="block text-gray-600 hover:text-gray-800" href="#">Clients</a>
        <a class="block text-gray-600 hover:text-gray-800" href="#">Payments</a>
        <a class="block text-gray-600 hover:text-gray-800" href="#">Settings</a>
        <a class="block text-gray-600 hover:text-gray-800" href="logout.php">Logout</a>
    </nav>
</div>
<main class="p-4 md:p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-600">Total Invoices</h2>
            <p class="text-2xl font-bold"><?php echo $invoicesTotal;?></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-600">Total Clients</h2>
            <p class="text-2xl font-bold"><?php echo $clientsTotal;?></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-600">Total Payments</h2>
            <p class="text-2xl font-bold"><?php echo $paymentsTotal;?></p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-600">Revenue Trend</h2>
            <canvas id="revenueTrendChart" class="mt-4"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-600">Invoices Distribution</h2>
            <canvas id="clientDistributionChart" class="mt-4"></canvas>
        </div>
    </div>
    <div class="grid grid-cols-2 md:flex justify-around mt-4 md:mt-6 gap-2 md:gap-0">
        <button class="bg-orange-500 text-white py-2 px-4 rounded shadow hover:bg-orange-600" onclick="showComponent('invoices')">View Invoices</button>
        <button class="bg-orange-500 text-white py-2 px-4 rounded shadow hover:bg-orange-600" onclick="showComponent('clients')">Manage Clients</button>
        <button class="bg-orange-500 text-white py-2 px-4 rounded shadow hover:bg-orange-600" onclick="showComponent('payments')">Process Payments</button>
        <button class="bg-orange-500 text-white py-2 px-4 rounded shadow hover:bg-orange-600" onclick="showComponent('settings')">Account Settings</button>
    </div>
    <div id="invoices" class="hidden mt-4 md:mt-6">
        <h2 class="text-xl font-bold mb-4">Invoices</h2>
        <div class="flex justify-between mb-4">
            <input class="w-full md:w-1/3 px-4 py-2 border rounded" type="text" placeholder="Search..."/>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600 ml-2">Filter</button>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Invoice ID</th>
                    <th class="py-2 px-4 border-b">Client</th>
                    <th class="py-2 px-4 border-b">Amount</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">INV001</td>
                    <td class="py-2 px-4 border-b">Client A</td>
                    <td class="py-2 px-4 border-b">$500</td>
                    <td class="py-2 px-4 border-b">Paid</td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">INV002</td>
                    <td class="py-2 px-4 border-b">Client B</td>
                    <td class="py-2 px-4 border-b">$300</td>
                    <td class="py-2 px-4 border-b">Pending</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <div class="flex justify-between mt-4">
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Previous</button>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Next</button>
        </div>
    </div>
    <div id="clients" class="hidden mt-4 md:mt-6">
        <h2 class="text-xl font-bold mb-4">Clients</h2>
        <div class="flex justify-between mb-4">
            <input class="w-full md:w-1/3 px-4 py-2 border rounded" type="text" placeholder="Search..."/>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600 ml-2">Filter</button>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Client ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">CL001</td>
                    <td class="py-2 px-4 border-b">Client A</td>
                    <td class="py-2 px-4 border-b">clienta@example.com</td>
                    <td class="py-2 px-4 border-b">123-456-7890</td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">CL002</td>
                    <td class="py-2 px-4 border-b">Client B</td>
                    <td class="py-2 px-4 border-b">clientb@example.com</td>
                    <td class="py-2 px-4 border-b">098-765-4321</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <div class="flex justify-between mt-4">
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Previous</button>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Next</button>
        </div>
    </div>
    <div id="payments" class="hidden mt-4 md:mt-6">
        <h2 class="text-xl font-bold mb-4">Payments</h2>
        <div class="flex justify-between mb-4">
            <input class="w-full md:w-1/3 px-4 py-2 border rounded" type="text" placeholder="Search..."/>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600 ml-2">Filter</button>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Payment ID</th>
                    <th class="py-2 px-4 border-b">Invoice ID</th>
                    <th class="py-2 px-4 border-b">Amount</th>
                    <th class="py-2 px-4 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">PAY001</td>
                    <td class="py-2 px-4 border-b">INV001</td>
                    <td class="py-2 px-4 border-b">$500</td>
                    <td class="py-2 px-4 border-b">2023-01-01</td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">PAY002</td>
                    <td class="py-2 px-4 border-b">INV002</td>
                    <td class="py-2 px-4 border-b">$300</td>
                    <td class="py-2 px-4 border-b">2023-01-02</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <div class="flex justify-between mt-4">
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Previous</button>
            <button class="bg-gray-500 text-white py-2 px-4 rounded shadow hover:bg-gray-600">Next</button>
        </div>
    </div>
    <div id="settings" class="hidden mt-4 md:mt-6">
        <h2 class="text-xl font-bold mb-4">Account Settings</h2>
        <form class="bg-white p-4 rounded shadow">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input class="w-full px-4 py-2 border rounded" type="text" placeholder="Username"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input class="w-full px-4 py-2 border rounded" type="email" placeholder="Email"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input class="w-full px-4 py-2 border rounded" type="password" placeholder="Password"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input class="w-full px-4 py-2 border rounded" type="password" placeholder="Confirm Password"/>
            </div>
            <button class="bg-orange-500 text-white py-2 px-4 rounded shadow hover:bg-orange-600" type="submit">Save Changes</button>
        </form>
    </div>
</main>
<script>
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    const revenueTrendChart = new Chart(revenueTrendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1900, 3000, 5000, 2000, 3000, 4500, 4000, 5000, 6000, 7000, 8000],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const clientDistributionCtx = document.getElementById('clientDistributionChart').getContext('2d');
    const clientDistributionChart = new Chart(clientDistributionCtx, {
        type: 'pie',
        data: {
            labels: ['Client A', 'Client B', 'Client C', 'Client D'],
            datasets: [{
                label: 'Client Distribution',
                data: [300, 50, 100, 150],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    function showComponent(componentId) {
        const components = ['invoices', 'clients', 'payments', 'settings'];
        components.forEach(id => {
            document.getElementById(id).classList.add('hidden');
        });
        document.getElementById(componentId).classList.remove('hidden');
    }
</script>
</body>
</html>

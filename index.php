
<?php

$totalBalance = 45850;
$monthlyIncome = 65000;
$monthlyExpense = 19150;
$totalSavings = 45850;

$transactions = [
    [
        'title' => 'Salary',
        'category' => 'Income',
        'amount' => 50000,
        'type' => 'income',
        'date' => '22 Sep 2026'
    ],
    [
        'title' => 'Rent',
        'category' => 'Housing',
        'amount' => 12000,
        'type' => 'expense',
        'date' => '20 Sep 2026'
    ],
    [
        'title' => 'Groceries',
        'category' => 'Food',
        'amount' => 3500,
        'type' => 'expense',
        'date' => '18 Sep 2026'
    ],
    [
        'title' => 'Freelance Payment',
        'category' => 'Income',
        'amount' => 15000,
        'type' => 'income',
        'date' => '15 Sep 2026'
    ],
    [
        'title' => 'Travel',
        'category' => 'Transport',
        'amount' => 3650,
        'type' => 'expense',
        'date' => '12 Sep 2026'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Money Manager</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #111827;
            color: white;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 14px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        /* Main */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .topbar p {
            color: #6b7280;
        }

        .profile {
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.05);
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card-value {
            font-size: 28px;
            font-weight: 700;
        }

        .income {
            color: #16a34a;
        }

        .expense {
            color: #dc2626;
        }

        .saving {
            color: #2563eb;
        }

        /* Content */
        .content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.05);
        }

        .box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .box-header h2 {
            font-size: 19px;
        }

        .view-all {
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        /* Transactions */
        .transaction {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .transaction:last-child {
            border-bottom: none;
        }

        .transaction-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .transaction-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            font-size: 19px;
        }

        .transaction-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .transaction-category {
            color: #9ca3af;
            font-size: 12px;
        }

        .amount {
            font-weight: 700;
        }

        .amount.plus {
            color: #16a34a;
        }

        .amount.minus {
            color: #dc2626;
        }

        /* Quick Actions */
        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .action {
            padding: 18px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            text-decoration: none;
            color: #1f2937;
            text-align: center;
            transition: 0.2s;
        }

        .action:hover {
            border-color: #2563eb;
            color: #2563eb;
        }

        .action-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .action-text {
            font-size: 13px;
            font-weight: 600;
        }

        /* Budget */
        .budget {
            margin-top: 25px;
        }

        .budget-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .progress {
            height: 9px;
            background: #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 64%;
            background: #2563eb;
            border-radius: 20px;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 70px;
                padding: 20px 8px;
            }

            .logo {
                font-size: 0;
                text-align: center;
            }

            .logo span {
                font-size: 24px;
            }

            .menu a {
                text-align: center;
                font-size: 0;
            }

            .menu a::first-letter {
                font-size: 20px;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
                padding: 18px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
            }

            .profile {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="app">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo">
            Money<span>Manager</span>
        </div>

        <ul class="menu">
            <li>
                <a href="#" class="active">🏠 Dashboard</a>
            </li>

            <li>
                <a href="#">💰 Transactions</a>
            </li>

            <li>
                <a href="#">📊 Budgets</a>
            </li>

            <li>
                <a href="#">🎯 Savings Goals</a>
            </li>

            <li>
                <a href="#">📈 Reports</a>
            </li>

            <li>
                <a href="#">⚙️ Settings</a>
            </li>
        </ul>

    </aside>


    <!-- Main -->
    <main class="main">

        <!-- Topbar -->
        <div class="topbar">

            <div>
                <h1>Dashboard</h1>
                <p>Welcome back! Here's your financial overview.</p>
            </div>

            <div class="profile">
                👤 <strong>Mohit</strong>
            </div>

        </div>


        <!-- Summary Cards -->
        <div class="cards">

            <div class="card">
                <div class="card-title">Total Balance</div>
                <div class="card-value">
                    ₹<?= number_format($totalBalance) ?>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Monthly Income</div>
                <div class="card-value income">
                    ₹<?= number_format($monthlyIncome) ?>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Monthly Expense</div>
                <div class="card-value expense">
                    ₹<?= number_format($monthlyExpense) ?>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Total Savings</div>
                <div class="card-value saving">
                    ₹<?= number_format($totalSavings) ?>
                </div>
            </div>

        </div>


        <!-- Main Content -->
        <div class="content">

            <!-- Transactions -->
            <div class="box">

                <div class="box-header">
                    <h2>Recent Transactions</h2>
                    <a href="#" class="view-all">View All</a>
                </div>


                <?php foreach ($transactions as $transaction): ?>

                    <div class="transaction">

                        <div class="transaction-left">

                            <div class="transaction-icon">
                                <?= $transaction['type'] === 'income' ? '💰' : '💳' ?>
                            </div>

                            <div>
                                <div class="transaction-name">
                                    <?= htmlspecialchars($transaction['title']) ?>
                                </div>

                                <div class="transaction-category">
                                    <?= htmlspecialchars($transaction['category']) ?>
                                    •
                                    <?= htmlspecialchars($transaction['date']) ?>
                                </div>
                            </div>

                        </div>


                        <div class="amount <?= $transaction['type'] === 'income' ? 'plus' : 'minus' ?>">

                            <?= $transaction['type'] === 'income' ? '+' : '-' ?>
                            ₹<?= number_format($transaction['amount']) ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- Right Section -->
            <div>

                <!-- Quick Actions -->
                <div class="box">

                    <div class="box-header">
                        <h2>Quick Actions</h2>
                    </div>

                    <div class="actions">

                        <a href="#" class="action">
                            <div class="action-icon">➕</div>
                            <div class="action-text">Add Income</div>
                        </a>

                        <a href="#" class="action">
                            <div class="action-icon">💸</div>
                            <div class="action-text">Add Expense</div>
                        </a>

                        <a href="#" class="action">
                            <div class="action-icon">🎯</div>
                            <div class="action-text">New Goal</div>
                        </a>

                        <a href="#" class="action">
                            <div class="action-icon">📊</div>
                            <div class="action-text">View Report</div>
                        </a>

                    </div>

                </div>


                <!-- Monthly Budget -->
                <div class="box budget">

                    <div class="box-header">
                        <h2>Monthly Budget</h2>
                    </div>

                    <div class="budget-info">
                        <span>₹19,150 spent</span>
                        <strong>₹30,000</strong>
                    </div>

                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>

                    <p style="margin-top:10px; color:#6b7280; font-size:13px;">
                        ₹10,850 remaining this month
                    </p>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
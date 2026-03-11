@extends('layouts.website')
@section('title', 'EMI Calculator - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie" style="background-image: url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">EMI Calculator</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('calculator') }}">EMI Calculator</a></li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<style>
    .calculator-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 40px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .calculator-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .calculator-header h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .calculator-header p {
        color: #666;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-group input:focus {
        outline: none;
        border-color: #4a90e2;
        box-shadow: 0 0 10px rgba(74, 144, 226, 0.2);
    }

    .slider-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .slider-container input[type="range"] {
        flex: 1;
        height: 8px;
        border-radius: 5px;
        background: #ddd;
        outline: none;
        -webkit-appearance: none;
        width: 100%;
    }

    .slider-container input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #4a90e2;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .slider-container input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #4a90e2;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .slider-value {
        min-width: 60px;
        text-align: right;
        font-weight: 600;
        color: #4a90e2;
        font-size: 16px;
    }

    .btn-calculate {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-calculate:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(74, 144, 226, 0.4);
    }

    .btn-calculate:active {
        transform: translateY(0);
    }

    .results-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        margin-top: 30px;
        display: none;
    }

    .results-section.show {
        display: block;
        animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .result-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .result-item:last-child {
        border-bottom: none;
    }

    .result-label {
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .result-value {
        color: #4a90e2;
        font-size: 18px;
        font-weight: 700;
    }

    .result-item.highlight .result-value {
        color: #e74c3c;
        font-size: 22px;
    }

    .amortization-table {
        margin-top: 30px;
        overflow-x: auto;
    }

    .amortization-table table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .amortization-table thead {
        background: #f0f0f0;
    }

    .amortization-table th {
        padding: 10px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #ddd;
    }

    .amortization-table td {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .amortization-table tbody tr:hover {
        background: #f9f9f9;
    }

    @media (max-width: 768px) {
        .calculator-container {
            margin: 30px 10px;
            padding: 25px;
        }

        .calculator-header h1 {
            font-size: 24px;
        }

        .slider-container {
            flex-direction: column;
            align-items: stretch;
        }

        .slider-value {
            text-align: center;
        }
    }
</style>

<!-- Calculator Section Start -->
<section class="pb-5">
    <div class="calculator-container">
        <div class="calculator-header">
            <h2 class="calculator-title">Calculate Your EMI</h2>
            <p>Get accurate loan EMI calculations instantly</p>
        </div>

        <form id="emiForm">
            <!-- Loan Amount -->
            <div class="form-group">
                <label for="loanAmount">Loan Amount (₹)</label>
                <div class="slider-container">
                    <input
                        type="range"
                        id="loanAmountSlider"
                        min="100000"
                        max="10000000"
                        step="100000"
                        value="1000000"
                    />
                    <span class="slider-value" id="loanAmountValue">₹10,00,000</span>
                </div>
                <input
                    type="number"
                    id="loanAmount"
                    min="100000"
                    max="10000000"
                    step="100000"
                    value="1000000"
                    placeholder="Enter loan amount"
                />
            </div>

            <!-- Interest Rate -->
            <div class="form-group">
                <label for="interestRate">Annual Interest Rate (%)</label>
                <div class="slider-container">
                    <input
                        type="range"
                        id="interestRateSlider"
                        min="3"
                        max="15"
                        step="0.1"
                        value="7"
                    />
                    <span class="slider-value" id="interestRateValue">7%</span>
                </div>
                <input
                    type="number"
                    id="interestRate"
                    min="0.1"
                    max="50"
                    step="0.1"
                    value="7"
                    placeholder="Enter interest rate"
                />
            </div>

            <!-- Loan Tenure -->
            <div class="form-group">
                <label for="tenure">Loan Tenure (Months)</label>
                <div class="slider-container">
                    <input
                        type="range"
                        id="tenureSlider"
                        min="6"
                        max="360"
                        step="1"
                        value="120"
                    />
                    <span class="slider-value" id="tenureValue">120 months</span>
                </div>
                <input
                    type="number"
                    id="tenure"
                    min="1"
                    max="600"
                    step="1"
                    value="120"
                    placeholder="Enter tenure in months"
                />
            </div>

            <!-- Calculate Button -->
            <button type="button" class="btn-calculate" onclick="calculateEMI()">
                Calculate EMI
            </button>
        </form>

        <!-- Results Section -->
        <div class="results-section" id="resultsSection">
            <h3 style="color: #333; margin-bottom: 20px; font-weight: 700;">Results</h3>

            <div class="result-item highlight">
                <span class="result-label">Monthly EMI</span>
                <span class="result-value" id="resultEMI">₹0</span>
            </div>

            <div class="result-item">
                <span class="result-label">Total Amount Payable</span>
                <span class="result-value" id="resultTotalAmount">₹0</span>
            </div>

            <div class="result-item">
                <span class="result-label">Total Interest Payable</span>
                <span class="result-value" id="resultTotalInterest">₹0</span>
            </div>

            <div class="result-item">
                <span class="result-label">Loan Amount</span>
                <span class="result-value" id="resultLoanAmount">₹0</span>
            </div>

            <!-- Amortization Table -->
            <div class="amortization-table">
                <table id="amortizationTable">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>EMI</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="amortizationBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Calculator Section End -->

<script>
    // Sync slider and input for Loan Amount
    const loanAmountInput = document.getElementById('loanAmount');
    const loanAmountSlider = document.getElementById('loanAmountSlider');
    const loanAmountValue = document.getElementById('loanAmountValue');

    loanAmountSlider.addEventListener('input', function () {
        loanAmountInput.value = this.value;
        loanAmountValue.textContent = '₹' + formatNumber(this.value);
    });

    loanAmountInput.addEventListener('input', function () {
        loanAmountSlider.value = this.value;
        loanAmountValue.textContent = '₹' + formatNumber(this.value);
    });

    // Sync slider and input for Interest Rate
    const interestRateInput = document.getElementById('interestRate');
    const interestRateSlider = document.getElementById('interestRateSlider');
    const interestRateValue = document.getElementById('interestRateValue');

    interestRateSlider.addEventListener('input', function () {
        interestRateInput.value = this.value;
        interestRateValue.textContent = this.value + '%';
    });

    interestRateInput.addEventListener('input', function () {
        interestRateSlider.value = this.value;
        interestRateValue.textContent = this.value + '%';
    });

    // Sync slider and input for Tenure
    const tenureInput = document.getElementById('tenure');
    const tenureSlider = document.getElementById('tenureSlider');
    const tenureValue = document.getElementById('tenureValue');

    tenureSlider.addEventListener('input', function () {
        tenureInput.value = this.value;
        tenureValue.textContent = this.value + ' months';
    });

    tenureInput.addEventListener('input', function () {
        tenureSlider.value = this.value;
        tenureValue.textContent = this.value + ' months';
    });

    // Format number with commas
    function formatNumber(num) {
        return Math.round(num)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Calculate EMI
    function calculateEMI() {
        const principal = parseFloat(loanAmountInput.value);
        const rate = parseFloat(interestRateInput.value) / 12 / 100;
        const tenure = parseInt(tenureInput.value);

        if (principal <= 0 || tenure <= 0 || isNaN(rate)) {
            alert('Please enter valid values');
            return;
        }

        const emi = (principal * rate * Math.pow(1 + rate, tenure)) / (Math.pow(1 + rate, tenure) - 1);
        const totalAmount = emi * tenure;
        const totalInterest = totalAmount - principal;

        // Display results
        document.getElementById('resultEMI').textContent = '₹' + formatNumber(emi);
        document.getElementById('resultTotalAmount').textContent = '₹' + formatNumber(totalAmount);
        document.getElementById('resultTotalInterest').textContent = '₹' + formatNumber(totalInterest);
        document.getElementById('resultLoanAmount').textContent = '₹' + formatNumber(principal);

        // Generate amortization schedule
        generateAmortizationSchedule(principal, rate, emi, tenure);

        // Show results
        document.getElementById('resultsSection').classList.add('show');
    }

    // Generate amortization schedule
    function generateAmortizationSchedule(principal, rate, emi, tenure) {
        const tbody = document.getElementById('amortizationBody');
        tbody.innerHTML = '';

        let balance = principal;

        for (let i = 1; i <= tenure; i++) {
            const interestPayment = balance * rate;
            const principalPayment = emi - interestPayment;
            balance -= principalPayment;

            // Prevent negative balance due to rounding
            if (balance < 0) balance = 0;

            const row = `
                <tr>
                    <td>${i}</td>
                    <td>₹${formatNumber(principalPayment)}</td>
                    <td>₹${formatNumber(interestPayment)}</td>
                    <td>₹${formatNumber(emi)}</td>
                    <td>₹${formatNumber(balance)}</td>
                </tr>
            `;

            tbody.innerHTML += row;
        }
    }

    // Auto calculate on page load
    window.addEventListener('load', function () {
        calculateEMI();
    });
</script>

@endsection

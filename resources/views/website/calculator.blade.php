@extends('layouts.website')
@section('title', 'EMI Calculator - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section dark-section parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">EMI Calculator</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">EMI Calculator</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<style>
    .calc-section { padding: 100px 0; background: var(--bg-color); }

    .calc-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 30px rgba(4,6,24,0.07);
        height: 100%;
    }

    .calc-card-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 30px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--divider-color);
    }

    .calc-field { margin-bottom: 28px; }

    .calc-field label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        font-size: 14px;
        color: var(--accent-color);
        margin-bottom: 10px;
    }

    .calc-field label .field-value {
        font-size: 15px;
        font-weight: 700;
        color: var(--primary-color);
        background: var(--bg-color);
        padding: 3px 14px;
        border-radius: 20px;
    }

    .calc-field input[type="number"] {
        width: 100%;
        padding: 12px 18px;
        border: 2px solid var(--divider-color);
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        color: var(--accent-color);
        outline: none;
        transition: border-color 0.3s;
        margin-top: 10px;
    }

    .calc-field input[type="number"]:focus {
        border-color: var(--accent-color);
    }

    .calc-field input[type="range"] {
        width: 100%;
        height: 6px;
        border-radius: 5px;
        background: var(--divider-color);
        outline: none;
        -webkit-appearance: none;
    }

    .calc-field input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--accent-color);
        border: 3px solid var(--accent-secondary-color);
        box-shadow: 0 2px 8px rgba(4,6,24,0.2);
    }

    .calc-field input[type="range"]::-moz-range-thumb {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--accent-color);
        border: 3px solid var(--accent-secondary-color);
        box-shadow: 0 2px 8px rgba(4,6,24,0.2);
        cursor: pointer;
    }

    .btn-calc {
        width: 100%;
        padding: 16px;
        background: var(--accent-color);
        color: var(--white-color);
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .btn-calc:hover {
        background: var(--accent-secondary-color);
        color: var(--accent-color);
    }

    .result-summary {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 30px;
    }

    .result-box {
        background: var(--bg-color);
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .result-box.highlight {
        background: var(--accent-color);
        grid-column: 1 / -1;
    }

    .result-box .r-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-color);
        margin-bottom: 8px;
    }

    .result-box.highlight .r-label { color: rgba(255,255,255,0.7); }

    .result-box .r-value {
        font-size: 22px;
        font-weight: 800;
        color: var(--accent-color);
    }

    .result-box.highlight .r-value {
        font-size: 32px;
        color: var(--accent-secondary-color);
    }

    .amort-table-wrap {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid var(--divider-color);
    }

    .amort-table-wrap table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .amort-table-wrap thead {
        background: var(--accent-color);
        color: var(--white-color);
    }

    .amort-table-wrap th {
        padding: 12px 14px;
        font-weight: 600;
        text-align: left;
    }

    .amort-table-wrap td {
        padding: 10px 14px;
        border-bottom: 1px solid var(--divider-color);
        color: var(--text-color);
    }

    .amort-table-wrap tbody tr:last-child td { border-bottom: none; }
    .amort-table-wrap tbody tr:hover { background: var(--bg-color); }

    .results-panel { display: none; }
    .results-panel.show { display: block; animation: fadeUp 0.4s ease; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991px) {
        .calc-card { margin-bottom: 30px; }
        .result-summary { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 575px) {
        .calc-card { padding: 24px; }
        .result-summary { grid-template-columns: 1fr; }
        .result-box.highlight { grid-column: auto; }
    }
</style>

<!-- Calculator Section Start -->
<section class="calc-section">
    <div class="container">
        <div class="row g-4 align-items-start">

            <!-- Left: Form -->
            <div class="col-xl-5 col-lg-6">
                <div class="calc-card">
                    <div class="calc-card-title">
                        <i class="fas fa-calculator me-2" style="color: var(--accent-secondary-color);"></i>
                        Calculate Your EMI
                    </div>

                    <form id="emiForm">

                        <!-- Loan Amount -->
                        <div class="calc-field">
                            <label for="loanAmount">
                                Loan Amount
                                <span class="field-value" id="loanAmountValue">₹10,00,000</span>
                            </label>
                            <input type="range" id="loanAmountSlider" min="100000" max="10000000" step="100000" value="1000000" />
                            <input type="number" id="loanAmount" min="100000" max="10000000" step="100000" value="1000000" placeholder="Enter loan amount (₹)" />
                        </div>

                        <!-- Interest Rate -->
                        <div class="calc-field">
                            <label for="interestRate">
                                Annual Interest Rate
                                <span class="field-value" id="interestRateValue">7%</span>
                            </label>
                            <input type="range" id="interestRateSlider" min="3" max="20" step="0.1" value="7" />
                            <input type="number" id="interestRate" min="0.1" max="50" step="0.1" value="7" placeholder="Enter interest rate (%)" />
                        </div>

                        <!-- Loan Tenure -->
                        <div class="calc-field">
                            <label for="tenure">
                                Loan Tenure
                                <span class="field-value" id="tenureValue">120 months</span>
                            </label>
                            <input type="range" id="tenureSlider" min="6" max="360" step="1" value="120" />
                            <input type="number" id="tenure" min="1" max="600" step="1" value="120" placeholder="Enter tenure in months" />
                        </div>

                        <button type="button" class="btn-calc" onclick="calculateEMI()">
                            <i class="fas fa-chart-line me-2"></i>Calculate EMI
                        </button>

                    </form>
                </div>
            </div>

            <!-- Right: Results -->
            <div class="col-xl-7 col-lg-6">
                <div class="calc-card">
                    <div class="calc-card-title">
                        <i class="fas fa-chart-pie me-2" style="color: var(--accent-secondary-color);"></i>
                        Loan Summary
                    </div>

                    <!-- Placeholder before calculation -->
                    <div id="resultsPlaceholder" style="text-align: center; padding: 40px 0; color: var(--text-color);">
                        <i class="fas fa-calculator fa-3x mb-3" style="opacity: 0.2; color: var(--accent-color);"></i>
                        <p style="font-size: 15px;">Enter your loan details and click <strong>Calculate EMI</strong> to see results.</p>
                    </div>

                    <!-- Results Panel -->
                    <div class="results-panel" id="resultsSection">

                        <div class="result-summary">
                            <div class="result-box highlight">
                                <div class="r-label">Monthly EMI</div>
                                <div class="r-value" id="resultEMI">₹0</div>
                            </div>
                            <div class="result-box">
                                <div class="r-label">Loan Amount</div>
                                <div class="r-value" id="resultLoanAmount">₹0</div>
                            </div>
                            <div class="result-box">
                                <div class="r-label">Total Interest</div>
                                <div class="r-value" id="resultTotalInterest">₹0</div>
                            </div>
                            <div class="result-box" style="border-color: var(--accent-color);">
                                <div class="r-label">Total Payable</div>
                                <div class="r-value" id="resultTotalAmount">₹0</div>
                            </div>
                        </div>

                        <!-- Amortization Table -->
                        <div style="margin-top: 10px;">
                            <div style="font-size: 14px; font-weight: 700; color: var(--accent-color); margin-bottom: 12px;">
                                <i class="fas fa-table me-1" style="color: var(--accent-secondary-color);"></i>
                                Amortization Schedule
                            </div>
                            <div class="amort-table-wrap" style="max-height: 340px; overflow-y: auto;">
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
                                    <tbody id="amortizationBody"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Calculator Section End -->

<script>
    const loanAmountInput  = document.getElementById('loanAmount');
    const loanAmountSlider = document.getElementById('loanAmountSlider');
    const loanAmountValue  = document.getElementById('loanAmountValue');

    const interestRateInput  = document.getElementById('interestRate');
    const interestRateSlider = document.getElementById('interestRateSlider');
    const interestRateValue  = document.getElementById('interestRateValue');

    const tenureInput  = document.getElementById('tenure');
    const tenureSlider = document.getElementById('tenureSlider');
    const tenureValue  = document.getElementById('tenureValue');

    loanAmountSlider.addEventListener('input', function () {
        loanAmountInput.value = this.value;
        loanAmountValue.textContent = '₹' + formatNumber(this.value);
    });
    loanAmountInput.addEventListener('input', function () {
        loanAmountSlider.value = this.value;
        loanAmountValue.textContent = '₹' + formatNumber(this.value);
    });

    interestRateSlider.addEventListener('input', function () {
        interestRateInput.value = this.value;
        interestRateValue.textContent = this.value + '%';
    });
    interestRateInput.addEventListener('input', function () {
        interestRateSlider.value = this.value;
        interestRateValue.textContent = this.value + '%';
    });

    tenureSlider.addEventListener('input', function () {
        tenureInput.value = this.value;
        tenureValue.textContent = this.value + ' months';
    });
    tenureInput.addEventListener('input', function () {
        tenureSlider.value = this.value;
        tenureValue.textContent = this.value + ' months';
    });

    function formatNumber(num) {
        return Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function calculateEMI() {
        const principal = parseFloat(loanAmountInput.value);
        const rate      = parseFloat(interestRateInput.value) / 12 / 100;
        const tenure    = parseInt(tenureInput.value);

        if (!principal || !tenure || isNaN(rate) || rate <= 0) {
            alert('Please enter valid values');
            return;
        }

        const emi         = (principal * rate * Math.pow(1 + rate, tenure)) / (Math.pow(1 + rate, tenure) - 1);
        const totalAmount = emi * tenure;
        const totalInterest = totalAmount - principal;

        document.getElementById('resultEMI').textContent          = '₹' + formatNumber(emi);
        document.getElementById('resultTotalAmount').textContent   = '₹' + formatNumber(totalAmount);
        document.getElementById('resultTotalInterest').textContent = '₹' + formatNumber(totalInterest);
        document.getElementById('resultLoanAmount').textContent    = '₹' + formatNumber(principal);

        generateAmortizationSchedule(principal, rate, emi, tenure);

        document.getElementById('resultsPlaceholder').style.display = 'none';
        document.getElementById('resultsSection').classList.add('show');
    }

    function generateAmortizationSchedule(principal, rate, emi, tenure) {
        const tbody = document.getElementById('amortizationBody');
        tbody.innerHTML = '';
        let balance = principal;

        for (let i = 1; i <= tenure; i++) {
            const interestPayment   = balance * rate;
            const principalPayment  = emi - interestPayment;
            balance -= principalPayment;
            if (balance < 0) balance = 0;

            tbody.innerHTML += `
                <tr>
                    <td>${i}</td>
                    <td>₹${formatNumber(principalPayment)}</td>
                    <td>₹${formatNumber(interestPayment)}</td>
                    <td>₹${formatNumber(emi)}</td>
                    <td>₹${formatNumber(balance)}</td>
                </tr>`;
        }
    }
</script>

@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip - {{ $payroll->user->name }} - {{ $payroll->month }} {{ $payroll->year }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; color: #374151; }
        .payslip-container { max-width: 800px; margin: 2rem auto; background: white; padding: 3rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-top: 8px solid #1d4ed8; }
    </style>
</head>
<body class="antialiased">
    <div class="payslip-container">
        <!-- Header -->
        <div class="flex justify-between items-start border-b-2 border-gray-200 pb-6 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-wider">{{ \Spatie\Multitenancy\Models\Tenant::current()->name ?? 'Municipality' }}</h1>
                <p class="text-gray-500 mt-1">Human Resources Department</p>
            </div>
            <div class="text-right">
                <h2 class="text-2xl font-light text-blue-800">OFFICIAL PAYSLIP</h2>
                <p class="text-gray-600 font-medium mt-1">Period: {{ $payroll->month }} {{ $payroll->year }}</p>
                <p class="text-sm text-gray-400">Issued: {{ now()->format('Y-m-d') }}</p>
            </div>
        </div>

        <!-- Employee Info -->
        <div class="grid grid-cols-2 gap-8 mb-8 bg-gray-50 p-6 rounded-lg">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold mb-1">Employee Details</p>
                <p class="font-bold text-lg text-gray-900">{{ $payroll->user->name }}</p>
                <p class="text-gray-600">{{ $payroll->user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold mb-1">Job Information</p>
                <p><span class="text-gray-600 inline-block w-24">Department:</span> <span class="font-medium">{{ $payroll->user->department ?? 'N/A' }}</span></p>
                <p><span class="text-gray-600 inline-block w-24">Title:</span> <span class="font-medium">{{ $payroll->user->job_title ?? 'N/A' }}</span></p>
            </div>
        </div>

        <!-- Financial Breakdown -->
        <div class="mb-10">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="py-3 font-semibold text-gray-700 uppercase text-sm tracking-wider w-1/2">Description</th>
                        <th class="py-3 font-semibold text-gray-700 uppercase text-sm tracking-wider text-right">Earnings (SAR)</th>
                        <th class="py-3 font-semibold text-gray-700 uppercase text-sm tracking-wider text-right">Deductions (SAR)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-4 text-gray-800">Basic Salary</td>
                        <td class="py-4 text-right font-medium">{{ number_format($payroll->base_salary, 2) }}</td>
                        <td class="py-4 text-right text-gray-400">-</td>
                    </tr>
                    @if($payroll->overtime > 0)
                    <tr>
                        <td class="py-4 text-gray-800">Overtime / Allowances</td>
                        <td class="py-4 text-right font-medium">{{ number_format($payroll->overtime, 2) }}</td>
                        <td class="py-4 text-right text-gray-400">-</td>
                    </tr>
                    @endif
                    @if($payroll->deductions > 0)
                    <tr>
                        <td class="py-4 text-gray-800">Taxes & Deductions</td>
                        <td class="py-4 text-right text-gray-400">-</td>
                        <td class="py-4 text-right font-medium text-red-600">{{ number_format($payroll->deductions, 2) }}</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-gray-300 bg-gray-50">
                        <td class="py-4 font-bold text-gray-900 text-right uppercase tracking-wider">Net Salary:</td>
                        <td colspan="2" class="py-4 text-right font-bold text-2xl text-blue-800">SAR {{ number_format($payroll->net_salary, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="mt-16 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
            <p>This is a computer-generated document. No signature is required.</p>
            <p class="mt-2">If you have any questions regarding this payslip, please contact the HR Department.</p>
            <p class="mt-4 font-semibold">Baladiyati Municipality OS</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="text-center no-print mt-8 pb-12">
        <button onclick="window.print()" class="px-8 py-3 bg-blue-700 text-white font-bold rounded-lg shadow-lg hover:bg-blue-800 transition-colors flex items-center justify-center mx-auto space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Print Official Payslip</span>
        </button>
    </div>
</body>
</html>

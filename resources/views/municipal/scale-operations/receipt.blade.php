<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scale Receipt #{{ $operation->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { font-family: 'Courier New', Courier, monospace; color: black; }
            .no-print { display: none; }
            @page { margin: 0; size: 80mm 200mm; } /* Standard 80mm thermal paper */
        }
        body { font-family: 'Courier New', Courier, monospace; background-color: #f3f4f6; color: #1f2937; }
        .receipt { max-width: 320px; margin: 2rem auto; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .divider { border-bottom: 2px dashed #d1d5db; margin: 1rem 0; }
    </style>
</head>
<body class="antialiased">
    <div class="receipt">
        <div class="text-center mb-4">
            <h1 class="font-bold text-xl">{{ \Spatie\Multitenancy\Models\Tenant::current()->name ?? 'Municipality' }}</h1>
            <p class="text-sm font-semibold">Scale Operations Dept</p>
            <p class="text-xs text-gray-500 mt-1">VAT No: 300000000000003</p>
        </div>

        <div class="divider"></div>

        <div class="text-sm space-y-1 mb-4">
            <div class="flex justify-between"><span class="font-bold">Receipt #:</span> <span>{{ str_pad($operation->id, 8, '0', STR_PAD_LEFT) }}</span></div>
            <div class="flex justify-between"><span class="font-bold">Date:</span> <span>{{ $operation->created_at->format('Y-m-d H:i') }}</span></div>
            <div class="flex justify-between"><span class="font-bold">Vehicle:</span> <span>{{ $operation->vehicle_plate }}</span></div>
            @if($operation->driver_name)
                <div class="flex justify-between"><span class="font-bold">Driver:</span> <span>{{ $operation->driver_name }}</span></div>
            @endif
            @if($operation->material_type)
                <div class="flex justify-between"><span class="font-bold">Material:</span> <span>{{ $operation->material_type }}</span></div>
            @endif
        </div>

        <div class="divider"></div>

        <div class="text-sm space-y-1 mb-4">
            <div class="flex justify-between"><span class="font-bold">Gross WT:</span> <span>{{ $operation->gross_weight }} kg</span></div>
            <div class="flex justify-between"><span class="font-bold">Tare WT:</span> <span>{{ $operation->tare_weight }} kg</span></div>
            <div class="flex justify-between text-base mt-2 pt-2 border-t border-gray-200"><span class="font-bold">Net WT:</span> <span class="font-bold">{{ $operation->net_weight }} kg</span></div>
        </div>

        <div class="divider"></div>

        <div class="text-sm space-y-1 mb-4">
            <div class="flex justify-between text-lg"><span class="font-bold">TOTAL FEE:</span> <span class="font-bold">{{ number_format($operation->fee, 2) }} SAR</span></div>
            <div class="flex justify-between"><span class="font-bold">Status:</span> <span>{{ strtoupper($operation->status) }}</span></div>
        </div>

        <div class="divider"></div>

        <div class="text-center text-xs text-gray-500 mt-4">
            <p>Thank you for your business!</p>
            <p class="mt-1">Powered by Baladiyati</p>
        </div>
    </div>

    <div class="text-center no-print mt-8">
        <button onclick="window.print()" class="px-6 py-2 bg-blue-600 text-white font-bold rounded shadow hover:bg-blue-700">
            Print Receipt
        </button>
    </div>
</body>
</html>

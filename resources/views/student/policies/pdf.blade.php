<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            font-size: 24px;
            font-bold: true;
            color: #4A3B75;
        }

        .e-doc-info {
            position: absolute;
            top: 0;
            right: 0;
            text-align: right;
            color: #999;
            font-size: 8px;
        }

        .section-header {
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 2px;
        }

        .benefits-title {
            font-weight: bold;
            color: #000;
            margin: 12px 0 10px;
            border: none;
            padding: 0;
        }

        .row {
            display: block;
            clear: both;
            margin-bottom: 10px;
        }

        .col {
            float: left;
            width: 33.33%;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .policy-title {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            margin-top: 20px;
        }

        .policy-number {
            color: #666;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 5px;
            font-size: 9px;
            border: 1px solid #ddd;
        }

        td {
            padding: 5px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .benefit-table {
            margin-top: 0;
            color: #000;
            border-collapse: collapse;
        }

        .benefit-table th,
        .benefit-table td {
            border: none;
            border-bottom: 1px solid #ffffff;
            padding: 5px 10px;
            font-size: 9px;
            line-height: 1.35;
            vertical-align: middle;
        }

        .benefit-table th {
            font-weight: normal;
            background-color: transparent;
        }

        .benefit-table .shade th,
        .benefit-table .shade td,
        .benefit-table .shade-cell {
            background-color: #e9e9e9;
        }

        .benefit-table .white th,
        .benefit-table .white td {
            background-color: #ffffff;
        }

        .benefit-table .detail {
            font-size: 8.5px;
        }

        .benefit-table .amount {
            white-space: nowrap;
        }

        .footer-info {
            background-color: transparent;
            padding: 0;
            margin-top: 12px;
        }

        .footer-table {
            margin-top: 0;
        }

        .footer-table th {
            background-color: #ccc;
            border: none;
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }

        .footer-table td {
            border: none;
            text-align: center;
            color: #000;
            padding: 6px 5px;
        }

        .signature-section {
            margin-top: 30px;
            text-align: center;
        }

        .signature-img {
            width: 250px;
            height: auto;
        }

        .legal-notice {
            font-size: 7px;
            color: #999;
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="header clearfix">
        <div class="logo">Inoodex</div>
        <div class="e-doc-info">e-document issued: {{ now()->format('d.m.Y H:i') }}</div>
    </div>

    <div class="row clearfix">
        <div class="col">
            <div class="section-header">Policyholder</div>
            <strong>{{ strtoupper($application->student->full_name) }}</strong><br>
            {{ $application->student->institute_address }}<br>
            PLA 1501 Tarxien<br>
            (Malta)
        </div>
        <div class="col">
            <div class="section-header">Correspondence address</div>
            <strong>{{ strtoupper($application->student->full_name) }}</strong><br>
            {{ $application->student->institute_address }}<br>
            PLA 1501 Tarxien<br>
            (Malta)
        </div>
        <div class="col">
            {{-- <div class="section-header">Contact</div> --}}
            Email: {{ $application->student->email }}<br>
            Phone number: {{ $application->student->phone_number ?? '+35677775386' }}
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="section-header">Insured person</div>
        {{ strtoupper($application->student->full_name) }} | {{ ucfirst($application->student->gender) }} |
        {{ $application->student->date_of_birth->format('d.m.Y') }} | {{ $application->student->passport_number }} |
        Nationality: {{ $application->student->nationality }} | Country of origin:
        {{ $application->student->country_of_origin }}
    </div>

    <div class="policy-title">{{ $application->plan->plan_name }}</div>
    <div class="policy-number">Policy {{ $application->policy_number }}</div>

    @php
    $benefits = $application->benefitCoverages->keyBy('benefit_type');
    $amt = function ($type) use ($benefits) {
    $b = $benefits->get($type);
    return $b ? '€ ' . number_format($b->max_amount, 2) : '€ 0.00';
    };
    @endphp

    <div class="benefits-title">Benefits summary</div>
    <table class="benefit-table">
        <!-- Plan level -->
        <tr class="shade">
            <th width="27%">Plan level</th>
            <td width="43%"></td>
            <td width="30%"></td>
        </tr>
        <!-- First destination -->
        <tr class="white">
            <th>First destination</th>
            <td colspan="2">Malta</td>
        </tr>
        <!-- Territories -->
        <tr class="shade">
            <th>Territories</th>
            <td>Worldwide excluding US territories, Canada and country of origin</td>
            <td>Schengen countries are included</td>
        </tr>
        <!-- Notification -->
        <tr class="white">
            <th>Notification</th>
            <td>No deductible/excess for medical cover</td>
            <td>No waiting periods are applied</td>
        </tr>
        <!-- Medical cover -->
        <tr class="shade">
            <th>Medical cover</th>
            <td class="amount">Max. {{ $amt('medical_cover') }}</td>
            <td class="detail">
                Emergency medical cover<br>
                Sickness and accident<br>
                Inpatient / Outpatient treatment<br>
                General practitioners & specialists<br>
                Prescription medication
            </td>
        </tr>
        <!-- Sea and mountain search and rescue -->
        <tr class="white">
            <th>Sea and mountain search and rescue</th>
            <td class="amount">Max. {{ $amt('sea_mountain_rescue') }}</td>
            <td></td>
        </tr>
        <!-- Emergency medical evacuation -->
        <tr class="shade">
            <th>Emergency medical evacuation</th>
            <td class="amount">Max. {{ $amt('emergency_evacuation') }}</td>
            <td rowspan="2" class="shade-cell">By air, land or sea</td>
        </tr>
        <!-- Medical repatriation -->
        <tr class="shade">
            <th>Medical repatriation</th>
            <td class="amount">Max. {{ $amt('medical_repatriation') }}</td>
        </tr>
        <!-- Repatriation of mortal remains -->
        <tr class="white">
            <th>Repatriation of mortal remains</th>
            <td class="amount">Max. {{ $amt('repatriation_mortal_remains') }}</td>
            <td></td>
        </tr>
        <!-- Luggage -->
        <tr class="shade">
            <th>Luggage</th>
            <td class="amount">Max. {{ $amt('luggage') }}</td>
            <td class="detail">
                Loss, damage, robbery or theft of luggage<br><br>
                (Deductible of € 250.00 per claim)
            </td>
        </tr>
        <!-- Accidental death -->
        <tr class="white">
            <th>Accidental death</th>
            <td class="amount">Max. {{ $amt('accidental_death') }}</td>
            <td rowspan="2">Lump sum</td>
        </tr>
        <!-- Accidental disability -->
        <tr class="white">
            <th>Accidental disability</th>
            <td class="amount">Max. {{ $amt('accidental_disability') }}</td>
        </tr>
        <!-- Third party liability -->
        <tr class="shade">
            <th>Third party liability</th>
            <td colspan="2" class="amount">Max. {{ $amt('third_party_liability') }}</td>
        </tr>
    </table>

    <div class="footer-info">
        <table class="footer-table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Duration</th>
                    <th>Premium</th>
                    <th>Paid on</th>
                    <th>GIC's</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $application->start_date->format('d.m.Y') }}</td>
                    <td>{{ $application->end_date->format('d.m.Y') }}</td>
                    <td>{{ $application->duration_days }} days</td>
                    <td>{{ $application->currency }} {{ number_format($application->premium_amount, 2) }}</td>
                    <td>{{ $application->paid_on ? $application->paid_on->format('d.m.Y') : 'N/A' }}</td>
                    <td>{{ $application->gic_reference ?? 'ISIE-GIC-012026' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 15px; font-weight: bold;">
        The insurer will pay the medical provider directly if required by the law.<br>
        Alarm Service (for emergencies only, 24/7): + 31 50 520 9780
    </div>

    <div class="signature-section clearfix">
        <div style="float: left; width: 100%; text-align: center;">
            <img src="{{ public_path('assets/images/screenshot.png') }}" class="signature-img"><br>
            {{-- <span style="font-size: 8px; font-weight: bold; color: #0056b3;">ANKER</span><br>
            <span style="font-size: 7px; color: #0056b3;">INSURANCE</span> --}}
        </div>
        {{-- <div style="float: right; width: 50%; text-align: center;">
            <img src="{{ public_path('assets/images/logo.png') }}" class="signature-img">
        </div> --}}
    </div>

    <div class="legal-notice">
        Legal notice: The insurer is Anker Insurance Company n.v. at Paterswoldseweg 812 at 9728 BM Groningen. Anker is
        registered with the Autoriteit Financiële Markten (AFM) (the Dutch Authority for the Financial Markets) under
        number 12000661 and is authorised by De Nederlandsche Bank ("DNB").
    </div>
    <div class="page-break"></div>

    <div class="header clearfix">
        <div class="logo">Inoodex</div>
        <div class="e-doc-info">e-documento emitido: {{ now()->format('d.m.Y H:i') }}</div>
    </div>

    <div class="row clearfix">
        <div class="col">
            <div class="section-header">Tenedor de poliza</div>
            <strong>{{ strtoupper($application->student->full_name) }}</strong><br>
            {{ $application->student->institute_address }}<br>
            PLA 1501 Tarxien<br>
            (Malta)
        </div>
        <div class="col">
            <div class="section-header">Dirección de correspondencia</div>
            <strong>{{ strtoupper($application->student->full_name) }}</strong><br>
            {{ $application->student->institute_address }}<br>
            PLA 1501 Tarxien<br>
            (Malta)
        </div>
        <div class="col">
            {{-- <div class="section-header">Contacto</div> --}}
            Email: {{ $application->student->email }}<br>
            Teléfono: {{ $application->student->phone_number ?? '+35677775386' }}
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="section-header">Asegurado</div>
        {{ strtoupper($application->student->full_name) }} | {{ ucfirst($application->student->gender) }} |
        {{ $application->student->date_of_birth->format('d.m.Y') }} | {{ $application->student->passport_number }} |
        Nacionalidad: {{ $application->student->nationality }} | País de origen:
        {{ $application->student->country_of_origin }}
    </div>

    <div class="policy-title">{{ $application->plan->plan_name }}</div>
    <div class="policy-number">Póliza {{ $application->policy_number }}</div>

    <div class="benefits-title">Cobertura de seguro</div>
    <table class="benefit-table">
        <tr class="shade">
            <th width="27%">Nombre del plan</th>
            <td width="43%">Standard</td>
            <td width="30%"></td>
        </tr>
        <tr class="white">
            <th>Primer destino</th>
            <td colspan="2">Malta</td>
        </tr>
        <tr class="shade">
            <th>Territorialidad</th>
            <td>En todo el mundo, excluidos los territorios de EE.UU., Canadá y el país de origen</td>
            <td>Países Schengen incluidos</td>
        </tr>
        <tr class="white">
            <th>Aviso</th>
            <td>Seguro sin copago para la cobertura médica</td>
            <td>Sin período de carencia</td>
        </tr>
        <tr class="shade">
            <th>Cobertura médica</th>
            <td class="amount">Máx. {{ $amt('medical_cover') }}</td>
            <td class="detail">
                Tratamiento médico de emergencia<br>
                Enfermedad y accidente<br>
                Tratamientos hospitalarios y ambulatorios<br>
                Médicos de cabecera y especialistas<br>
                Medicamentos prescritos
            </td>
        </tr>
        <tr class="white">
            <th>Búsqueda & rescate</th>
            <td class="amount">Máx. {{ $amt('sea_mountain_rescue') }}</td>
            <td></td>
        </tr>
        <tr class="shade">
            <th>Evacuación Médica de emergencia</th>
            <td class="amount">Máx. {{ $amt('emergency_evacuation') }}</td>
            <td rowspan="2" class="shade-cell">En aire - mar - tierra</td>
        </tr>
        <tr class="shade">
            <th>Repatriación sanitaria</th>
            <td class="amount">Máx. {{ $amt('medical_repatriation') }}</td>
        </tr>
        <tr class="white">
            <th>Repatriación de restos mortales</th>
            <td class="amount">Máx. {{ $amt('repatriation_mortal_remains') }}</td>
            <td></td>
        </tr>
        <tr class="shade">
            <th>Equipaje de viaje</th>
            <td class="amount">Máx. {{ $amt('luggage') }}</td>
            <td class="detail">
                Pérdida, daño, robo o hurto de equipaje<br><br>
                (Franquicia de € 250.00 por siniestro)
            </td>
        </tr>
        <tr class="white">
            <th>Accidente personal - Muerte</th>
            <td class="amount">Máx. {{ $amt('accidental_death') }}</td>
            <td rowspan="2">Suma global</td>
        </tr>
        <tr class="white">
            <th>Accidente personal - Invalidez</th>
            <td class="amount">Máx. {{ $amt('accidental_disability') }}</td>
        </tr>
        <tr class="shade">
            <th>Responsabilidad civil</th>
            <td colspan="2" class="amount">Máx. {{ $amt('third_party_liability') }}</td>
        </tr>
    </table>

    <div class="footer-info">
        <table class="footer-table">
            <thead>
                <tr>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th>Duración</th>
                    <th>Prima</th>
                    <th>Pagado el</th>
                    <th>Condiciones generales</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $application->start_date->format('d.m.Y') }}</td>
                    <td>{{ $application->end_date->format('d.m.Y') }}</td>
                    <td>{{ $application->duration_days }} No. de días</td>
                    <td>{{ $application->currency }} {{ number_format($application->premium_amount, 2) }}</td>
                    <td>{{ $application->paid_on ? $application->paid_on->format('d.m.Y') : 'N/A' }}</td>
                    <td>{{ $application->gic_reference ?? 'ISIE-GIC-012026' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 15px; font-weight: bold;">
        The insurer will pay the medical provider directly if required by the law.<br>
        Alarm Service (for emergencies only, 24/7): + 31 50 520 9780
    </div>

    <div class="signature-section clearfix">
        <div style="float: left; width: 100%; text-align: center;">
            <img src="{{ public_path('assets/images/screenshot.png') }}" class="signature-img"><br>
            {{-- <span style="font-size: 8px; font-weight: bold; color: #0056b3;">ANKER</span><br>
            <span style="font-size: 7px; color: #0056b3;">INSURANCE</span> --}}
        </div>
        {{-- <div style="float: right; width: 50%; text-align: center;">
            <img src="{{ public_path('assets/images/logo.png') }}" class="signature-img">
        </div> --}}
    </div>

    <div class="legal-notice">
        Aviso legal: La aseguradora es Anker Insurance Company n.v. con domicilio en Paterswoldseweg 812,
        9728 BM Groningen. Anker está registrada ante la Autoriteit Financiële Markten (AFM), la autoridad
        holandesa de los mercados financieros, con el número 12000661 y está autorizada por De Nederlandsche Bank ("DNB").
    </div>
</body>

</html>
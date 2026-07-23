<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 9px;
            color: #000;
            margin: 13px;
            padding: 0;
        }

        .header {
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #000;
        }

        .e-doc-info {
            position: absolute;
            top: 30px;
            right: 0;
            text-align: right;
            color: black;
            font-size: 8px;
        }

        .section-header {
            font-weight: bold;
            margin-bottom: 1px;
            /* border-bottom: 1px solid #eee; */
            padding-bottom: 2px;
            padding-top: 3px;
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
            font-size: 10px;
            font-weight: bold;
            color: #000;
            /* padding-top: 2px; */
        }

        .policy-number {
            color: #000;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th {
            background-color: #eeeeee;
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
            border-bottom: none;
            padding: 4px 10px;
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
            background-color: #eeeeee;
            /* line-height: 2; */
            padding: 1.5px 10px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-left: none;
            border-right: none;
        }

        .benefit-table .shade2 th,
        .benefit-table .shade2 td,
        .benefit-table .shade-cell {
            background-color: #eeeeee;
            line-height: 1.2;
            padding: 1px 10px;
            border-bottom: 1px solid #ddd;
            border-left: none;
            border-right: none;
            border-top: 1px solid #ddd;
        }

         .benefit-table .shade3 th,
        .benefit-table .shade3 td,
        .benefit-table .shade-cell {
            background-color: #eeeeee;
            /* line-height: 2; */
            padding: 6px 10px;
            border-bottom: 1px solid #ddd;
            border-left: none;
            border-right: none;
        }

        .benefit-table .white th,
        .benefit-table .white td {
            background-color: #ffffff;
            padding: 1px 10px;
        }

        .benefit-table .white4 th,
        .benefit-table .white4 td {
            background-color: #ffffff;
            padding: 1px 10px;
        }

        .benefit-table .white5 th,
        .benefit-table .white5 td {
            background-color: #ffffff;
            padding: 2px 10px;
        }

        .benefit-table .white2-top th,
        .benefit-table .white2-top td {
            background-color: #ffffff;
            padding-top: 12px;
            padding-bottom: 1px;
            line-height: 1.0;
        }

        .benefit-table .white2-bottom th,
        .benefit-table .white2-bottom td {
            background-color: #ffffff;
            padding-top: 1px;
            padding-bottom: 12px;
            line-height: 1.0;
        }

        .benefit-table .white3 th,
        .benefit-table .white3 td {
            padding: 5px 10px;
            vertical-align: top;
        }

        /* .benefit-table .white3 .amount {
            line-height: 1.8; 
            white-space: nowrap;
        } */
        
        /* .benefit-table .white3-top th
         {
            background-color: #ffffff;
            padding-top: 5px;
            padding-bottom: 1px;
            line-height: 1.5;
        }

        .benefit-table .white3-bottom th
         {
            background-color: #ffffff;
            padding-top: 1px;
            padding-bottom: 5px;
            line-height: 1.5;
        }
        .benefit-table .white3-top td
       {
            padding-top: 5px;
            padding-bottom: 1px;
        }

         .benefit-table .white3-bottom td
       {
            padding-top: 1px;
            padding-bottom: 10px;
        } */

        .benefit-table .detail {
            font-size: 8.5px;
            line-height: 1.25;
        }

        .benefit-table .detail2 {
            font-size: 8.5px;
            padding-bottom: 12px;
            padding-top: 10px;
        }

        .benefit-table .detail3 {
            font-size: 8.5px;
            padding-bottom: 10px;
            padding-top: 10px;
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
            background-color: #cccccc;
            border: none;
            color: #000000;
            font-weight: bold;
            text-align: center;
            padding: 2px;
        }

        .footer-table td {
            border: none;
            text-align: center;
            color: #000;
            padding: 5px 5px;
        }

        .signature-section {
            margin-top: 10px;
            text-align: center;
        }

        .signature-img {
            width: 350px;
            height: auto;
        }

        .page-content {
            position: relative;
            min-height: 100vh;
        }

        .legal-notice {
            font-size: 6.5px;
            color: #000;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            /* border-top: 0.5px solid #ccc; */
            padding-top: 12px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="page-content">
    <div class="header clearfix">
        <div class="logo"><img src="{{ public_path('assets/images/swisscare_logo.png') }}" alt="Insaf Insurance" style="max-height: 42px;"></div>
        <div class="e-doc-info">e-document issued: {{ now()->format('d.m.Y H:i') }}</div>
    </div>

    <div class="row clearfix">
        <div class="col">
            <div class="section-header" style="padding-top: 3px;">Policyholder</div>
            {{ strtoupper($application->student->full_name) }}<br>
            @if($application->student->institute_name){{ $application->student->institute_name }},@endif{{ $application->student->institute_address }}<br>
            {{ $application->student->city }} {{ $application->student->zip_code }}<br>
            ({{ $application->student->country_code }})
            <br>
           @if($application->student->address_2){{ $application->student->address_2 }}<br>@endif
        </div>
        <div class="col">
            <div class="section-header">Correspondence address</div>
            {{ strtoupper($application->student->full_name) }}<br>
             @if($application->student->institute_name){{ $application->student->institute_name }},@endif{{ $application->student->institute_address }}<br>
            {{ $application->student->city }} {{ $application->student->zip_code }}<br>
            ({{ $application->student->country_code }})
            <br>
           @if($application->student->address_2){{ $application->student->address_2 }}<br>@endif
        </div>
        <div class="col" style="padding-top: 2px;">
            {{-- <div class="section-header">Contact</div> --}}
           <strong>Email</strong>  {{ $application->student->email }}<br>
            <strong>Phone number</strong> {{ $application->student->institute_phone ?? '+35677775386' }}
        </div>
    </div>

    <div class="row" style="margin-top: 8px;">
        <div class="section-header">Insured person</div>
        {{ strtoupper($application->student->full_name) }} | {{ ucfirst($application->student->gender) }} |
        {{ $application->student->date_of_birth->format('d.m.Y') }} | {{ $application->student->passport_number }} |
        Nationality: {{ $application->student->nationality }} | Country of origin:
        ({{ $application->student->country_of_origin }})
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
        <tr style="line-height: 1.2;" class="shade">
            <th width="25%" style="border-top: none;">Plan level</th>
            <td width="45%" style="border-top: none;">{{ $application->plan->plan_level }}</td>
            <td width="30%" style="border-top: none;"></td>
        </tr>
        <!-- First destination -->
        <tr class="white">
            <th>First destination</th>
            <td colspan="2">{{ $application->first_destination }}</td>
        </tr>
        <!-- Territories -->
        <tr class="shade">
            <th>Territories</th>
            <td style="line-height: 1.2;">Worldwide excluding US territories, Canada and country of origin</td>
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
        <tr class="white4">
            <th style="line-height: 1.25;">Sea and mountain search and <br>
                rescue</th>
            <td class="amount">Max. {{ $amt('sea_mountain_rescue') }}</td>
            <td></td>
        </tr>
        <!-- Emergency medical evacuation & Medical repatriation -->
        <tr class="shade">
            <th style="padding-bottom: 8px; line-height: 2.05">Emergency medical evacuation<br> Medical repatriation</th>
            <td style="padding-bottom: 8px; line-height: 2;" class="amount">Max. {{ $amt('emergency_evacuation') }}<br>Max. {{ $amt('medical_repatriation') }}</td>
            <td class="shade-cell">By air, land or sea</td>
        </tr>
        <!-- Repatriation of mortal remains -->
        <tr class="white">
            <th>Repatriation of mortal remains</th>
            <td class="amount">Max. {{ $amt('repatriation_mortal_remains') }}</td>
            <td></td>
        </tr>
        <!-- Luggage -->
        <tr class="shade3">
            <th>Luggage</th>
            <td class="amount">Max. {{ $amt('luggage') }}</td>
            <td style="padding-bottom: 3px; padding-top: 3px;">
                Loss, damage, robbery or theft of 
                <br>  luggage <br>
                <p>(Deductible of € 250.00 per claim) </p>
            </td>
        </tr>
        <!-- Accidental death -->
        <tr class="white2-top">
            <th>Accidental death</th>
            <td class="amount">Max. {{ $amt('accidental_death') }}</td>
            <td rowspan="2">Lump sum</td>
        </tr>
        <!-- Accidental disability -->
        <tr class="white2-bottom">
            <th>Accidental disability</th>
            <td class="amount">Max. {{ $amt('accidental_disability') }}</td>
        </tr>
        <!-- Third party liability -->
        <tr style="border-bottom: 1px solid #ddd;" class="shade2">
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
        Alarm Service (for emergencies only, 24/7) : + 31 50 520 9780
    </div>

    <div class="signature-section clearfix">
        <div style="float: left; height: auto; width: 100%; text-align: center;">
            <img src="{{ public_path('assets/images/screenshot.png') }}" class="signature-img"><br>
            {{-- <span style="font-size: 8px; font-weight: bold; color: #0056b3;">ANKER</span><br>
            <span style="font-size: 7px; color: #0056b3;">INSURANCE</span> --}}
        </div>
        {{-- <div style="float: right; width: 50%; text-align: center;">
            <img src="{{ public_path('assets/images/logo.png') }}" class="signature-img">
        </div> --}}
    </div>

    <div class="legal-notice">
        Legal notice : The insurer is Anker Insurance Company n.v. at Paterswoldseweg 812 at 9728 BM Groningen. Anker is
        registered with the Autoriteit Financiële Markten (AFM) (the Dutch Authority for the Financial Markets) under
        number 12000661 and is authorised by De Nederlandsche Bank ("DNB").
    </div>
    </div>
    <div class="page-break"></div>

    <div class="page-content">
    <div class="header clearfix">
        <div class="logo"><img src="{{ public_path('assets/images/swisscare_logo.png') }}" alt="Insaf Insurance" style="max-height: 42px;"></div>
        <div class="e-doc-info">e-documento emitido: {{ now()->format('d.m.Y H:i') }}</div>
    </div>

    <div class="row clearfix">
        <div class="col">
            <div class="section-header" style="padding-top: 3px;">Tenedor de póliza</div>
            {{ strtoupper($application->student->full_name) }}<br>
            @if($application->student->institute_name){{ $application->student->institute_name }},@endif{{ $application->student->institute_address }}<br>
            {{ $application->student->city }} {{ $application->student->zip_code }}<br>
            ({{ $application->student->country_code }})
           @if($application->student->address_2){{ $application->student->address_2 }}<br>@endif
        </div>
        <div class="col">
            <div class="section-header">Dirección de correspondencia</div>
            {{ strtoupper($application->student->full_name) }}<br>
            @if($application->student->institute_name){{ $application->student->institute_name }},@endif{{ $application->student->institute_address }}<br>
            {{ $application->student->city }} {{ $application->student->zip_code }}<br>
            ({{ $application->student->country_code }})
           @if($application->student->address_2){{ $application->student->address_2 }}<br>@endif
        </div>
        <div class="col" style="padding-top: 2px;">
            {{-- <div class="section-header">Contacto</div> --}}
             <strong>Email</strong>  {{ $application->student->email }}<br>
            <strong>Teléfono</strong> {{ $application->student->institute_phone ?? '+35677775386' }}
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
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
            <th width="25%" style="border-top: none;">Nombre del plan</th>
            <td width="48%" style="border-top: none;">{{ $application->plan->plan_level }}</td>
            <td width="27%" style="border-top: none;"></td>
        </tr>
        <tr class="white4">
            <th>Primer destino</th>
            <td colspan="2">{{ $application->first_destination }}</td>
        </tr>
        <tr class="shade">
            <th>Territorialidad</th>
            <td style="padding-bottom: 3px; line-height: 1.1;">En todo el mundo, excluidos los territorios de EE.UU., Canadá y el <br>
                país de origen</td>
            <td>Países Schengen incluidos</td>
        </tr>
        <tr style="border-bottom: 1px solid #ddd;" class="white">
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
                Tratamientos hospitalarios y 
                <br> ambulatorios<br>
                Médicos de cabecera y especialistas<br>
                Medicamentos prescritos
            </td>
        </tr>
        <tr class="white4">
            <th>Búsqueda & rescate</th>
            <td class="amount">Máx. {{ $amt('sea_mountain_rescue') }}</td>
            <td></td>
        </tr>
        <tr class="shade">
            <th style="padding-bottom: 4px; padding-top: 8px; line-height: 1.2;">Evacuación Médica de emergencia<br> <p> Repatriación sanitaria </p></th>
            <td style="padding-bottom: 4px; line-height: 1.0;" class="amount">Máx. {{ $amt('emergency_evacuation') }}<br><br>Máx. {{ $amt('medical_repatriation') }}</td>
            <td class="shade-cell">En aire - mar - tierra</td>
        </tr>
        <tr class="white">
            <th style="line-height: 1.25;">Repatriación de restos 
                <br> mortales</th>
            <td class="amount">Máx. {{ $amt('repatriation_mortal_remains') }}</td>
            <td></td>
        </tr>
        <tr class="shade">
            <th>Equipaje de viaje</th>
            <td class="amount">Máx. {{ $amt('luggage') }}</td>
            <td class="detail3" style="padding-bottom: 8px; padding-top: 8px; line-height: 1.25;">
                Pérdida, daño, robo o hurto de 
                <br>
                equipaje<br> <br>
                (Franquicia de € 250.00 por siniestro)
            </td>
        </tr>
            {{-- <tr class="white3">
            <th>
                Accidente personal -Muerte<br>
                Accidente personal -Invalidez
            </th>

            <td class="amount">
                Máx. {{ $amt('accidental_death') }}<br>
                Máx. {{ $amt('accidental_disability') }}
            </td>

            <td>Suma global</td>
        </tr> --}}
        <tr>
    <!-- Left column -->
    <th style="padding:0; vertical-align:top;">
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="border:none; padding:5px 10px 8px 10px;">
                    Accidente personal -Muerte
                </td>
            </tr>
            <tr>
                <td style="border:none; padding:0px 10px 8px 10px;">
                    Accidente personal -Invalidez
                </td>
            </tr>
        </table>
    </th>

    <!-- Amount column -->
    <td style="padding:0; vertical-align:top;">
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td class="amount" style="border:none; padding:7px 10px 0 10px;">
                    Máx. {{ $amt('accidental_death') }}
                </td>
            </tr>
            <tr>
                <td class="amount" style="border:none; padding:0 10px 7px 10px;">
                    Máx. {{ $amt('accidental_disability') }}
                </td>
            </tr>
        </table>
    </td>

    <!-- Right column -->
    <td style="vertical-align:middle;">
        Suma global
    </td>
</tr>
        <tr class="shade2">
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
        Alarm Service (for emergencies only, 24/7) : + 31 50 520 9780
    </div>

    <div class="signature-section clearfix">
        <div style="float: left; height: auto; width: 100%; text-align: center;">
            <img src="{{ public_path('assets/images/screenshot.png') }}" class="signature-img"><br>
            {{-- <span style="font-size: 8px; font-weight: bold; color: #0056b3;">ANKER</span><br>
            <span style="font-size: 7px; color: #0056b3;">INSURANCE</span> --}}
        </div>
        {{-- <div style="float: right; width: 50%; text-align: center;">
            <img src="{{ public_path('assets/images/logo.png') }}" class="signature-img">
        </div> --}}
    </div>

    <div class="legal-notice">
        Aviso legal: El asegurador es Anker Insurance Company n.v. en Paterswoldseweg 812 en 9728 BM Groningen. Anker está registrado en la Autoriteit Financiële Markten (AFM) (la Autoridad neerlandesa para los mercados financieros), bajo el número 12000661 y está autorizado por el De Nederlandsche Bank (“DNB”).
    </div>
    </div>
</body>

</html>
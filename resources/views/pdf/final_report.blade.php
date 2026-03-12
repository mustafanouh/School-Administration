<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1a202c;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
        }

        /* Header */
        .header {
            border-bottom: 4px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .school-info h1 {
            font-size: 22px;
            color: #1e1b4b;
            margin: 0;
        }

        .report-tag {
            display: inline-block;
            padding: 4px 12px;
            background: #4f46e5;
            color: white;
            border-radius: 50px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Info Card */
        .info-grid {
            background: #f8fafc;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            width: 100%;
        }

        .label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
        }

        .value {
            font-size: 14px;
            color: #1e293b;
            font-weight: bold;
        }

        /* Table Style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 11px;
            text-transform: uppercase;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 12px;
            font-size: 13px;
            border-bottom: 1px solid #f1f5f9;
        }

        .score {
            font-weight: bold;
            color: #4f46e5;
        }

        /* Summary Section */
        .summary-box {
            float: right;
            width: 250px;
            background: #1e293b;
            color: white;
            border-radius: 12px;
            padding: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .total-row {
            border-top: 1px solid #475569;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        /* Badge */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .pass {
            background: #dcfce7;
            color: #166534;
        }

        .fail {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <table style="border: none;">
                <tr style="border: none;">
                    <td style="border: none; padding: 0;">
                        <div class="school-info">
                            <span class="report-tag">Official Academic Transcript</span>
                            <h1>School of Aleppo</h1>
                            <p style="font-size: 12px; color: #64748b;">School Management System - SchoolAdmin</p>
                        </div>
                    </td>
                    <td style="border: none; text-align: right; vertical-align: bottom;">
                        <div class="value">Academic Year: {{ $enrollment->academicYear->name }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-grid">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="label">Student Full Name</div>
                        <div class="value">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                        </div>
                    </td>
                    <td>
                        <div class="label">Grade / Section</div>
                        <div class="value">{{ $enrollment->section->grade->name }} - {{ $enrollment->section->name }}
                        </div>
                    </td>
                    <td>
                        <div class="label">Current Semester</div>
                        <div class="value">{{ $semester->name }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Exam Type</th>
                    <th style="text-align: center;">Score</th>
                    <th style="text-align: center;">Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marks as $mark)
                    <tr>
                        <td style="font-weight: bold;">{{ $mark->exam->subject->name }}</td>
                        <td style="color: #64748b;">{{ $mark->exam->exam_type }}</td>
                        <td style="text-align: center;" class="score">{{ $mark->score }} <span
                                style="font-size: 10px; color: #94a3b8;">/ {{ $mark->max_mark ?? 100 }}</span></td>
                        <td style="text-align: center;">
                            <span class="badge {{ $mark->score >= 50 ? 'pass' : 'fail' }}">
                                {{ $mark->score >= 50 ? 'PASSED' : 'FAILED' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="width: 100%; margin-top: 40px;">
            <div class="summary-box">
                <div class="summary-item">
                    <span style="color: #94a3b8; font-size: 11px;">Semester Average:</span>
                    <span>{{ number_format($semester_average, 2) }}%</span>
                </div>

                @if ($final_average)
                    <div class="summary-item total-row">
                        <span>Yearly Total:</span>
                        <span style="color: #818cf8;">{{ number_format($final_average, 2) }}%</span>
                    </div>
                    <div style="text-align: right; margin-top: 5px;">
                        <span class="badge {{ $enrollment->status == 'passed' ? 'pass' : 'fail' }}"
                            style="font-size: 12px;">
                            OVERALL: {{ strtoupper($enrollment->status) }}
                        </span>
                    </div>
                @endif
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="margin-top: 80px;">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; color: #94a3b8; font-size: 10px;">
                        Generated Date: {{ date('Y-m-d H:i') }}<br>
                        Student ID: #{{ $enrollment->student->id }}
                    </td>
                    <td style="border: none; text-align: right;">
                        <div
                            style="display: inline-block; border-top: 1px solid #1e293b; width: 200px; padding-top: 10px; text-align: center;">
                            <span class="label">Registrar Signature</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>

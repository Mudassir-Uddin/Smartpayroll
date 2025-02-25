<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .salary-slip {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            color: #333;
        }
        .details-table, .salary-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 5px;
        }
        .salary-table th, .salary-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .salary-table th {
            background-color: #f8f9fa;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="salary-slip" id="salarySlip">
        <div class="header">
            <h2>Salary Slip</h2>
            {{-- <p>VGOTELL | Month: February 2025</p> --}}
            <p>VGOTELL | {{ $payroll->month->name }} {{ $payroll->year }}</p>
        </div>

        <table class="details-table">
            <tr>
                <td><strong>Employee Name:</strong> {{ $payroll->employee->name }}</td>
                <td><strong>Employee ID:</strong> EMP{{ $payroll->employee->employee_id }}</td>
            </tr>
            <tr>
                <td><strong>Designation:</strong> {{ $payroll->employee->Designation->name }}</td>
                <td><strong>Department:</strong> {{ $payroll->employee->Department->name }}</td>
            </tr>
            <tr>
                <td><strong>Joining Date:</strong> {{ $payroll->employee->joining_date }}</td>
                {{-- <td><strong>Status:</strong> {{ $payroll->employee->status }}</td> --}}
                <td><strong>Status: </strong>
                    @if ( $payroll->employee->status == 1)
                        <option value="1">Active</option>
                    @elseif ( $payroll->employee->status == 2)
                        <option value="2">Unactive</option>
                        {{-- @endforeach --}}
                    @else
                        <option value="3">Terminated</option>
                    @endif
                </td>
            </tr>
        </table>

        <table class="table salary-table">
            <thead>
                <tr>
                    <th colspan="4" class="text-center bg-primary text-white">Attendance Summary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total Present</strong></td>
                    <td>{{ $payroll->total_present }}</td>
                    <td><strong>Total Absent</strong></td>
                    <td>{{ $payroll->total_absent }}</td>
                </tr>
                <tr>
                    <td><strong>Total Late</strong></td>
                    <td>{{ $payroll->total_late }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table class="table salary-table">
            <thead>
                <tr>
                    <th>Earnings</th>
                    <th>Amount (PKR)</th>
                    <th>Deductions</th>
                    <th>Amount (PKR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basic Salary</td>
                    <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                    {{-- <td>Tax {{ $payroll->deduction?->transactionType?->type }}</td> --}}
                    <td>Voucher</td>
                    <td>{{ number_format($payroll->deductions, 2) }}</td>
                </tr>
                <tr>
                    {{-- <td>Bonus {{ $payroll->bonuses?->TransactionType?->type }}</td> --}}
                    <td>Bonus</td>
                    <td> {{ number_format($payroll->bonuses, 2) }}</td>
                    {{-- <td>Provident Fund</td>
                    <td>1,500</td> --}}
                </tr>
                {{-- <tr>
                    <td>Conveyance</td>
                    <td>5,000</td>
                    <td>Other Deductions</td>
                    <td>1,000</td>
                </tr> --}}
                <tr class="total">
                    <td>Total Earnings</td>
                    <td>{{ number_format($payroll->basic_salary + $payroll->bonuses, 2) }}</td>
                    <td>Total Deductions</td>
                    <td>{{ number_format($payroll->deductions, 2) }}</td>
                </tr>
                <tr class="total">
                    <td colspan="3">Net Salary</td>
                    <td>{{ number_format($payroll->net_salary, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <p class="text-center"><strong>Note:</strong> This is a system-generated salary slip and does not require a signature.</p>
    </div>

    {{-- <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="downloadPDF()">Download as PDF</button>
    </div> --}}

    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const salarySlip = document.getElementById('salarySlip');

            // Convert the salary slip to an image
            const canvas = await html2canvas(salarySlip);
            const imgData = canvas.toDataURL('image/png');

            // Add image to PDF
            const imgWidth = 190; // Adjust for page width
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
            doc.save("Salary_Slip.pdf");
        }
    </script>

</body>
</html>

@extends('template.main')


@section('content')
    <h2>Dashboard</h2> 
    <canvas id="stackedBarChart" width="400" height="200"></canvas>
@endsection

@section('script')

    <script>
        var invoiceData = @json($invoiceData);
        var paymentData = @json($paymentData);

        console.log(invoiceData);
        $(document).ready(function(){  
            var ctx = document.getElementById('stackedBarChart').getContext('2d');
             
            var myStackedBarChart = new Chart(ctx, {
                type: 'bar',  
                data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], 
                datasets: [{
                    label: 'Payments',  
                    data: paymentData,  
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', 
                    borderColor: 'rgba(75, 192, 192, 1)', 
                    borderWidth: 2  
                }, {
                    label: 'Invoices',  
                    data: invoiceData, 
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',  
                    borderColor: 'rgba(153, 102, 255, 1)',  
                    borderWidth: 2 
                }]
                },
                options: {
                scales: {
                    x: {
                    stacked: true  
                    },
                    y: {
                    stacked: true,  
                    beginAtZero: true  
                    }
                },
                plugins: {
                    legend: {
                    position: 'top'  
                    }
                }
                }
            });
        }); 
    </script>

@endsection
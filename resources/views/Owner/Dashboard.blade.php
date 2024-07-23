@extends('Components.Owner')

@section('main')
    <main id="dashboard">
        <div style="padding: 0 1rem; display:flex; justify-content:space-between">
            <h3 id="branch_location">{{ $branches_name }} Branch Data</h3>
            <div id="branch_selection">
                <select name="branch" id="branch" onchange="redirectToBranch(this)">
                    <option value="none" selected disabled>Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ route('branchDashboard', $branch->id) }}">{{ $branch->branchName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <script>
            function redirectToBranch(selectElement) {
                var value = selectElement.value;
                if (value !== 'none') {
                    window.location.href = value;
                }
            }
        </script>


        <div style="margin-top:1vw;" class="stat">
            <div class="totalRevenue" id="totalrevenue">
                <div class="icon">
                    <i class='bx bx-dollar-circle'></i>
                </div>
                <div class="disc">
                    <p>Total Revenue</p>
                    @if ($totalRevenue)
                        <h3>Rs. {{ $totalRevenue }}</h3>
                    @else
                        <h3>Nil</h3>
                    @endif
                </div>
            </div>

            <div class="totalBranch" id="totalmenu">
                <div class="icon">
                    <i class='bx bx-package'></i>
                </div>
                <div class="disc">
                    @if ($branchRevenue)
                        <p>Branch Revenue</p>
                        <h3>{{ $branchRevenue }}</h3>
                    @elseif($totalBranches)
                        <p>Total Branch</p>
                        <h3>{{ $totalBranches }}</h3>
                    @else
                        <p>Branch Revenue</p>
                        <h3>Nil</h3>
                    @endif
                </div>
            </div>

            {{-- <div class="totalMenu" id="totalmenu">
                <div class="icon">
                    <i class='bx bxs-dish'></i>
                </div>
                <div class="disc">
                    <p>Total Menu</p>
                    <h3>150</h3>
                </div>
            </div> --}}

            <div class="totalStaff" id="totalstaff">
                <div class="icon">
                    <i class='bx bxs-group'></i>
                </div>
                <div class="disc">
                    <p>Total Staff</p>
                    @if ($totalStaff)
                        <h3>{{ $totalStaff }}</h3>
                    @else
                        <h3>Nil</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="graph">

            <div class="totalRevenueGraph">
                <div class="info">
                    <p class="ttle">Annual Branch Revenue</p>
                </div>
                <canvas id="myChart"></canvas>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var minYear = {{ $minYear }};
                    var currentYear = new Date().getFullYear();
                    var years = [];
                    var colors = ['#ffbb00', '#ff6600', '#0099ff', '#33cc33', '#cc0066']; // Add more colors if needed

                    @foreach ($annualRevenueArray as $branch_id => $revenues)
                        @foreach ($revenues as $year => $revenue)
                            years.push('{{ $year }}');
                        @endforeach
                    @endforeach

                    var datasets = [
                        @foreach ($annualRevenueArray as $branch_id => $revenues)
                            {
                                label: 'Branch {{ $branch_id }}',
                                data: [{{ implode(',', $revenues) }}],
                                backgroundColor: colors[{{ $loop->index }}],
                                borderColor: colors[{{ $loop->index }}],
                                borderWidth: 2,
                                fill: false
                            },
                        @endforeach
                    ];

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: years,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        title: function(tooltipItems) {
                                            return tooltipItems[0].label;
                                        },
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

            </div>

            <div class="monthlyRevenuegraph">
                <div class="info">
                    <p class="ttle">Monthly Branch Revenue</p>
                </div>
                <canvas id="barChart">
                    <script>
                        var ctx = document.getElementById('barChart').getContext('2d');
                        var colors = ['#ffbb00', '#ff6600', '#0099ff', '#33cc33', '#cc0066']; // Add more colors if needed

                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                datasets: [
                                    @foreach ($monthlyRevenueArray as $branch_id => $revenues)
                                        {
                                            label: 'Branch {{ $branch_id }}',
                                            data: [{{ implode(',', $revenues) }}],
                                            backgroundColor: colors[{{ $loop->index }}],
                                            borderColor: colors[{{ $loop->index }}],
                                            borderWidth: 2
                                        },
                                    @endforeach
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                </canvas>
            </div>

            <div class="dailyRevenueGraph">
                <div class="info">
                    <p class="ttle">Daily Revenue</p>
                </div>
                <canvas id="dailyChart"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var ctx = document.getElementById('dailyChart').getContext('2d');
                        var dailyLabels = [];
                        var dailyDatasets = [];

                        @php
                            $daysInMonth = \Carbon\Carbon::create($year, $month)->daysInMonth;
                            $labels = range(1, $daysInMonth);
                            $datasets = [];
                            foreach ($dailyRevenueArray as $revenues) {
                                $datasets[] = [
                                    'label' => 'Daily Revenue',
                                    'data' => $revenues,
                                    'backgroundColor' => '#ffbb00',
                                    'borderColor' => '#ffbb00',
                                    'borderWidth' => 2,
                                ];
                            }
                        @endphp

                        dailyLabels = @json($labels);
                        dailyDatasets = @json($datasets);

                        var dailyChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dailyLabels,
                                datasets: dailyDatasets
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
            </div>

        </div>

        <div class="map">
            <h4>Branches</h4>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14162684.943968251!2d58.35051958635448!3d29.930918993835288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38db52d2f8fd751f%3A0x46b7a1f7e614925c!2sPakistan!5e0!3m2!1sen!2s!4v1711636812778!5m2!1sen!2s"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </main>
    <script>
        var resizeCanvas = function() {
            var graphContainers = document.querySelectorAll(
                '.monthlyRevenuegraph, .totalRevenueGraph, .dailyRevenueGraph');
            graphContainers.forEach(function(container) {
                var canvas = container.querySelector('canvas');
                var width = container.offsetWidth;
                canvas.style.height = (width * 0.35) + 'px';
            });
        };
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
    </script>
@endsection

<x-admin-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <div class="w-full overflow-x-hidden border-t flex flex-col">
        <h1 class="text-3xl text-black pb-6">Dashboard</h1>
        <div class="flex flex-wrap mt-6">
            <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                <p class="text-xl pb-3 flex items-center">Registrations</p>
                <div class="flex flex-wrap justify-end p-6 bg-white">
                    <select
                        class="select-period appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="7_day" selected>7 days</option>
                        <option value="14_day">14 days</option>
                        <option value="30_day">30 days</option>
                        <option value="3_month">3 months</option>
                        <option value="6_month">6 months</option>
                        <option value="12_month">1 year</option>
                    </select>
                    <canvas id="usersRegisteredChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                <p class="text-xl pb-3 flex items-center">Resolved Reports</p>
                <div class="p-6 bg-white">
                    <canvas id="chartTwo" width="400" height="200"></canvas>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    let countData = @json(array_values($data));
    let labelData = @js(array_keys($data));
    const data = {
        labels: labelData,
        datasets: [
            {
                label: "Registered users",
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: countData,
            },
        ],
    };

    const configLineChart = {
        type: "line",
        data,
        options: {},
    };

    var usersRegisteredChart = new Chart(
        document.getElementById("usersRegisteredChart"),
        configLineChart
    );

    $('.select-period').on('click', function () {
        let url = "{{ route('adminDashboardPeriod') }}";
        let period = $(this).val();
        $.post(url, {
            _token: '{{ csrf_token() }}',
            period: period
        })
            .success(function (response) {
                labelData = Object.keys(response.data)
                countData = Object.values(response.data);
                usersRegisteredChart.data.labels.pop();
                usersRegisteredChart.data.labels = labelData;
                usersRegisteredChart.data.datasets[0].data = countData;
                usersRegisteredChart.update();
            });
    });

</script>

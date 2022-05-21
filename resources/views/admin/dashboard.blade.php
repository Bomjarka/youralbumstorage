<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-menu.dashboard') }}
    </x-slot>
    <div class="w-full overflow-x-hidden border-t flex flex-col">
        <h1 class="text-3xl text-black pb-6">{{ trans('admin-menu.dashboard') }}</h1>
        <div class="flex flex-wrap mt-6">
            <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                <p class="text-xl pb-3 flex items-center">{{ trans('admin-dashboard.registrations') }}</p>
                <div class="flex flex-wrap justify-end p-6 bg-white">
                    <select
                        class="registrations-select-period appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="7_day" selected>7 {{ trans('admin-dashboard.days') }}</option>
                        <option value="14_day">14 {{ trans('admin-dashboard.days') }}</option>
                        <option value="30_day">30 {{ trans('admin-dashboard.days') }}</option>
                        <option value="3_month">3 {{ trans('admin-dashboard.months') }}</option>
                        <option value="6_month">6 {{ trans('admin-dashboard.months') }}</option>
                        <option value="12_month">1 {{ trans('admin-dashboard.year') }}</option>
                    </select>
                    <canvas id="usersRegisteredChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                <p class="text-xl pb-3 flex items-center">{{ trans('admin-dashboard.photos') }}</p>
                <div class="flex flex-wrap justify-end p-6 bg-white">
                    <select
                        class="photos-select-period appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="7_day" selected>7 {{ trans('admin-dashboard.days') }}</option>
                        <option value="14_day">14 {{ trans('admin-dashboard.days') }}</option>
                        <option value="30_day">30 {{ trans('admin-dashboard.days') }}</option>
                        <option value="3_month">3 {{ trans('admin-dashboard.months') }}</option>
                        <option value="6_month">6 {{ trans('admin-dashboard.months') }}</option>
                        <option value="12_month">1 {{ trans('admin-dashboard.year') }}</option>
                    </select>
                    <canvas id="photosUploadedChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    registeredUsersChart();
    uploadedPhotosChart();

    function registeredUsersChart() {
        let countData = @json(array_values($usersRegistered));
        let labelData = @js(array_keys($usersRegistered));
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

        $('.registrations-select-period').on('click', function () {
            let url = "{{ route('adminDashboardPeriod') }}";
            let period = $(this).val();

            $.post(url, {
                _token: '{{ csrf_token() }}',
                period: period
            })
                .success(function (response) {
                    updateChart(usersRegisteredChart, response.usersRegistered)
                });
        });
    }

    function uploadedPhotosChart() {
        let countData = @json(array_values($photosUploadedCount));
        let labelData = @js(array_keys($photosUploadedCount));
        const data = {
            labels: labelData,
            datasets: [
                {
                    label: "Uploaded photos",
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
        var uploadedPhotosChart = new Chart(
            document.getElementById("photosUploadedChart"),
            configLineChart
        );

        $('.photos-select-period').on('click', function () {
            let url = "{{ route('adminDashboardPeriod') }}";
            let period = $(this).val();

            $.post(url, {
                _token: '{{ csrf_token() }}',
                period: period
            })
                .success(function (response) {
                    updateChart(uploadedPhotosChart, response.photosUploadedCount)
                });
        });
    }

    function updateChart(chart, response) {
        labelData = Object.keys(response)
        countData = Object.values(response);
        chart.data.labels.pop();
        chart.data.labels = labelData;
        chart.data.datasets[0].data = countData;
        chart.update();
    }

</script>

<x-layout>
    <x-slot:title>
        سجل الغياب الشهري
    </x-slot:title>
    <x-slot:heading>
        سجل الغياب الشهري لطلاب المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    @php
                        // Map English month names to Arabic
                        $months = [
                            'Jan' => 'يناير',
                            'Feb' => 'فبراير',
                            'Mar' => 'مارس',
                            'Apr' => 'أبريل',
                            'May' => 'مايو',
                            'Jun' => 'يونيو',
                            'Jul' => 'يوليو',
                            'Aug' => 'أغسطس',
                            'Sep' => 'سبتمبر',
                            'Oct' => 'أكتوبر',
                            'Nov' => 'نوفمبر',
                            'Dec' => 'ديسمبر',
                        ];
                    @endphp

                    @foreach ($months as $monthName => $monthArabic)
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link {{ $monthName === \Carbon\Carbon::now()->format('M') ? 'active' : ''}}"
                                role="tab"
                                data-bs-toggle="tab"
                                data-bs-target="#{{ $monthName }}"
                                aria-controls="{{ $monthName }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $monthArabic }} <!-- Display Arabic month name -->
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content border-0 p-0">
                    @foreach($absencesByMonth as $month)
                        <div class="tab-pane fade show {{$month['monthName'] === \Carbon\Carbon::now()->format('M') ? 'active' : ''}}" id="{{$month['monthName']}}" role="tabpanel">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-header d-flex gap-3">قائمة غياب فصل - {{$selectedClass->name}}</h5>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">الاسم</th>
                                            @php
                                                $currentYear = now()->format('Y'); // Current year
                                                $currentMonthName = $month['monthName']; // Example: "Jan"
                                                $currentMonthNumber = \Carbon\Carbon::parse($currentMonthName)->format('m'); // Get month number from name
                                                $daysInMonth = \Carbon\Carbon::createFromFormat('Y-m', "{$currentYear}-{$currentMonthNumber}")->daysInMonth; // Number of days
                                            @endphp
                                            @for($i = 1; $i <= $daysInMonth; $i++)
                                                <th class="text-center">{{ $i }}/{{ \Carbon\Carbon::createFromDate($currentYear, $currentMonthNumber, $i)->isoFormat('ddd') }}</th>
                                            @endfor
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach($students as $student)
                                            <tr>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" />
                                                    <span class="fw-medium ms-1">{{ $student->name }}</span>
                                                </td>
                                                @for($day = 1; $day <= $daysInMonth; $day++)
                                                    @php
                                                        $currentDay = \Carbon\Carbon::createFromDate($currentYear, $currentMonthNumber, $day);
                                                        $absenceForDay = $student->absences->first(function($absence) use ($currentDay) {
                                                            return \Carbon\Carbon::parse($absence->date)->isSameDay($currentDay);
                                                        });
                                                    @endphp
                                                    <td class="text-center">
                                                        @if ($absenceForDay)
                                                            @if ($absenceForDay->is_present)
                                                                <span class="badge badge-center bg-label-success">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            @else
                                                                <span class="badge badge-center bg-label-danger">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </span>
                                                            @endif
                                                        @else
                                                            <div class="form-check d-flex justify-content-center">
                                                                <input class="form-check-input" type="checkbox" disabled />
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-layout>

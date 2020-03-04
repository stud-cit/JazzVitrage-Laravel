<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .page-break { page-break-after: always; }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-size:11px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:11px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table>
    <tr>
        <td width="50%">
<b><i>Загальна відомість членів жюрі обласного дитячого джазового інтернет-фестивалю «Джаз-Вітраж»</i></b><br><br>
Голова жюрі.
@foreach($jury as $key => $item)
    @if(stristr(mb_strtolower($item->rank), "голова"))
        {{ $item->surname }} {{ mb_substr($item->name, 0, 1) }}. {{ mb_substr($item->patronymic, 0, 1) }}. __________<br>
    @endif
@endforeach
Члени жюрі:<br>
@foreach($jury as $key => $item)
    {{ $item->surname }} {{ mb_substr($item->name, 0, 1) }}. {{ mb_substr($item->patronymic, 0, 1) }}. __________
    @if(($key % 2) == 0)
        <br>
    @endif
@endforeach
        </td>
        <td>
        </td>

        <td style="text-align:right">
Затверджую<br>
Голова орг. комітету фестивалю<br>
Начальник відділу культури<br>
Сумської міської ради<br>
______________ Н.О. Цибульська<br>
«___»_______________{{ date("Y") }}р.
        </td>
    </tr>
</table>
@foreach ($data as $dataItem)
    <?php
        $line = 1;
        $juryNomination = [];
        foreach($jury as $item) {
            if(stristr($item['nominations'], ltrim($dataItem->genre))) {
                array_push($juryNomination, $item);
            }
        }
    ?>
    @if(count($dataItem) > 0)
        <div class="page-break"></div>
        @if($dataItem->type == 'soloDuet')
        <b><i>Номінація «{{ $dataItem->genre }}». Соло та дуети. {{ $dataItem->category }} вікова група</b></i>
        <table class="tg">
        <tr>
            <th class="tg-c3ow" rowspan="2">№</th>
            <th class="tg-c3ow" rowspan="2">Прізвище та ім’я учня</th>
            <th class="tg-c3ow" rowspan="2">Місто Навч. заклад</th>
            <th class="tg-c3ow" rowspan="2">Дата народження</th>
            <th class="tg-c3ow" rowspan="2">Конкурсна програма</th>
            <th class="tg-c3ow" rowspan="2">Викладач / концертмейстер</th>
            <th class="tg-c3ow" colspan="{{ count($juryNomination) }}">Члени жюрі</th>
            <th class="tg-0pky" rowspan="2">Заг. бал</th>
            <th class="tg-0pky" rowspan="2">Сер. бал</th>
            <th class="tg-0pky" rowspan="2">Зайняте місце</th>
        </tr>
        <tr>
            @foreach ($juryNomination as $juryItem)
                <td class="tg-0lax">{{ $juryItem['surname'] }} {{ $juryItem['name'] }} {{ $juryItem['patronymic'] }}</td>
            @endforeach
        </tr>
            @foreach ($dataItem as $item)

                <tr>
                    <td class="tg-0pky">{{ $line++ }}</td>
                    <td class="tg-0pky">
                        @foreach ($item['soloDuet'] as $soloDuet)
                            {{ $soloDuet['surname'] }} {{ $soloDuet['name'] }} <br>
                        @endforeach
                    </td>
                    <td class="tg-0pky">{{ $item['preparation']['school_address'] }}, {{ $item['preparation']['school_name'] }}</td>
                    <td class="tg-0pky">
                        @foreach ($item['soloDuet'] as $soloDuet)
                            {{ $soloDuet['data_birthday'] }} <br>
                        @endforeach
                    </td>
                    <td class="tg-0pky">
                        "{{ $item['presentation']['composition_one'] }}" - {{ $item['presentation']['author_one'] }},
                        "{{ $item['presentation']['composition_two'] }}" - {{ $item['presentation']['author_two'] }}
                    </td>
                    <td class="tg-0pky">
                        @foreach ($item['teachers'] as $teachers)
                            Викладач: {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                        @endforeach
                        @if($item['preparation']['concertmaster_name'] != '')
                            Концертмейстр: {{ $item['preparation']['concertmaster_surname'] }} {{ $item['preparation']['concertmaster_name'] }} {{ $item['preparation']['concertmaster_patronymic'] }}
                        @endif
                    </td>
                    <?php
                        $sumEvaluation = 0;
                        $countEvaluation = 0;
                        $uniqueEvaluations = [];
                        foreach ($juryNomination as $juryItem) {
                            $test = 0;
                            foreach ($item['evaluations'] as $evaluations) {
                                if($juryItem['user_id'] == $evaluations['user_id']) {
                                    $countEvaluation++;
                                    $sumEvaluation += $evaluations['evaluation'];
                                    $test += $evaluations['evaluation'];

                                } else {
                                    $test += 0;
                                }
                            }
                            array_push($uniqueEvaluations, $test);
                        }
                    ?>

                    @if(count($uniqueEvaluations) > 0)
                        @for ($i = 0; $i < count($uniqueEvaluations); $i ++)
                            <td class="tg-0pky">{{ $uniqueEvaluations[$i] }}</td>
                        @endfor
                    @else
                        @for ($i = 0; $i < count($juryNomination); $i ++)
                            <td class="tg-0pky">0</td>
                        @endfor
                    @endif
                    <td class="tg-0pky">{{ $sumEvaluation }}</td>
                    @if($sumEvaluation)
                        <td class="tg-0pky">{{ $sumEvaluation / $countEvaluation }}</td>
                    @else
                        <td class="tg-0pky">0</td>
                    @endif
                    <td class="tg-0pky"></td>
                </tr>

            @endforeach
        </table>
        @else
        <b><i>Номінація «{{ $dataItem->genre }}». ансамбль, @if($dataItem->genre == " Композиція" || $dataItem->genre == "Інструментальний жанр") оркестр. @else хор. @endif {{ $dataItem->category }} вікова група</b></i>
        <table class="tg">
        <tr>
            <th class="tg-c3ow" rowspan="2">№</th>
            <th class="tg-c3ow" rowspan="2">Назва групи</th>
            <th class="tg-c3ow" rowspan="2">Місто Навч. заклад</th>
            <th class="tg-c3ow" rowspan="2">Конкурсна програма</th>
            <th class="tg-c3ow" rowspan="2">Викладач / концертмейстер</th>
            <th class="tg-c3ow" colspan="{{ count($juryNomination) }}">Члени жюрі</th>
            <th class="tg-0pky" rowspan="2">Заг.бал</th>
            <th class="tg-0pky" rowspan="2">Сер. бал</th>
            <th class="tg-0pky" rowspan="2">Зайняте місце</th>
        </tr>
        <tr>
            @foreach ($juryNomination as $juryItem)
                <td class="tg-0lax">{{ $juryItem['surname'] }} {{ $juryItem['name'] }} {{ $juryItem['patronymic'] }}</td>
            @endforeach
        </tr>
            @foreach ($dataItem as $item)
                <tr>
                    <td class="tg-0pky">{{ $line++ }}</td>
                    <td class="tg-0pky">{{ $item['group']['name'] }}</td>
                    <td class="tg-0pky">{{ $item['preparation']['school_address'] }}, {{ $item['preparation']['school_name'] }}</td>
                    <td class="tg-0pky">
                        "{{ $item['presentation']['composition_one'] }}" - {{ $item['presentation']['author_one'] }},
                        "{{ $item['presentation']['composition_two'] }}" - {{ $item['presentation']['author_two'] }}
                    </td>
                    <td class="tg-0pky">
                        @foreach ($item['teachers'] as $teachers)
                            Викладач: {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                        @endforeach
                        @if($item['preparation']['concertmaster_name'] != '')
                            Концертмейстр: {{ $item['preparation']['concertmaster_surname'] }} {{ $item['preparation']['concertmaster_name'] }} {{ $item['preparation']['concertmaster_patronymic'] }}
                        @endif
                    </td>
                    <?php
                        $sumEvaluation = 0;
                        $countEvaluation = 0;
                        $uniqueEvaluations = [];
                        foreach ($juryNomination as $juryItem) {
                            $test = 0;
                            foreach ($item['evaluations'] as $evaluations) {
                                if($juryItem['user_id'] == $evaluations['user_id']) {
                                    $countEvaluation++;
                                    $sumEvaluation += $evaluations['evaluation'];
                                    $test += $evaluations['evaluation'];
                                } else {
                                    $test += 0;
                                }
                            }
                            array_push($uniqueEvaluations, $test);
                        }
                    ?>

                    @if(count($uniqueEvaluations) > 0)
                        @for ($i = 0; $i < count($uniqueEvaluations); $i ++)
                            <td class="tg-0pky">{{ $uniqueEvaluations[$i] }}</td>
                        @endfor
                    @else
                        @for ($i = 0; $i < count($juryNomination); $i ++)
                            <td class="tg-0pky">0</td>
                        @endfor
                    @endif

                    <td class="tg-0pky">{{ $sumEvaluation }}</td>
                    @if($sumEvaluation)
                        <td class="tg-0pky">{{ $sumEvaluation / $countEvaluation }}</td>
                    @else
                        <td class="tg-0pky">0</td>
                    @endif
                    <td class="tg-0pky"></td>
                </tr>
            @endforeach
        </table>
        @endif
    @endif
@endforeach

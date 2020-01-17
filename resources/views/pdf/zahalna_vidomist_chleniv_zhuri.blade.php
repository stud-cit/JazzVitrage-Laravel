<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .page-break { page-break-after: always; }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table>
    <tr>
        <td>
<b><i>Загальна відомість членів жюрі обласного дитячого джазового інтернет-фестивалю «Джаз-Вітраж»</i></b><br><br>
Голова жюрі.   Карпенко Є.В.  __________<br>
Члени жюрі:<br>
Даниленко С.А.     __________       Стичук  О.В.  __________<br>
Письменний  І. А. __________      Зуєв С.П.         __________<br>
Шерстюк  Є.Я.      __________
        </td>

        <td style="text-align:right">
Затверджую<br>
Голова орг. комітету фестивалю<br>
Начальник відділу культури та<br>
туризму  Сумської  міської  ради<br>
______________ Н.О. Цибульська<br>
«___»_______________{{ date("Y") }}р.
        </td>
    </tr>
</table>

<div class="page-break"></div>

@foreach ($data as $dataItem)
    <?php
        $line = 1;
        $juryNomination = [];
        foreach($jury as $item) {
            if(stristr($item['nominations'], $dataItem->genre) == $dataItem->genre) {
                array_push($juryNomination, $item);
            }
        }
    ?>
    @if(count($dataItem) > 0)
        @if($dataItem->type == 'soloDuet')
        <b><i>Номінація «{{ $dataItem->genre }}». Соло та дуети. {{ $dataItem->category }} вікова група</b></i>
        <table class="tg">
        <tr>
            <th class="tg-c3ow" rowspan="2">№</th>
            <th class="tg-c3ow" rowspan="2">Прізвище та ім’я учня</th>
            <th class="tg-c3ow" rowspan="2">Місто Навч. заклад</th>
            <th class="tg-c3ow" rowspan="2">Дата народження</th>
            <th class="tg-c3ow" rowspan="2">Конкурсна програма</th>
            <th class="tg-c3ow" rowspan="2">Викладач/концертмейстер</th>
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
                    <td class="tg-0pky">
                        @foreach ($item['soloDuet'] as $soloDuet)
                            {{ $soloDuet['surname'] }} {{ $soloDuet['name'] }}
                        @endforeach
                    </td>
                    <td class="tg-0pky">{{ $item['preparation']['school_address'] }}, {{ $item['preparation']['school_one'] }}</td>
                    <td class="tg-0pky">
                        @foreach ($item['soloDuet'] as $soloDuet)
                            {{ $soloDuet['data_birthday'] }}
                        @endforeach
                    </td>
                    <td class="tg-0pky">
                        "{{ $item['presentation']['composition_one'] }}" - {{ $item['presentation']['author_one'] }},
                        "{{ $item['presentation']['composition_two'] }}" - {{ $item['presentation']['author_two'] }}
                    </td>
                    <td class="tg-0pky">
                        {{ $item['preparation']['teacher_surname'] }} {{ $item['preparation']['teacher_name'] }} {{ $item['preparation']['teacher_patronymic'] }}
                        {{ $item['preparation']['concertmaster_surname'] }} {{ $item['preparation']['concertmaster_name'] }} {{ $item['preparation']['concertmaster_patronymic'] }}
                    </td>
                    <?php
                        $sumEvaluation = 0;
                        $countEvaluation = 0;
                    ?>
                    @foreach ($juryNomination as $juryItem)
                        @foreach ($item['evaluations'] as $evaluations)
                            @if($juryItem['user_id'] == $evaluations['user_id'])
                                {{ $countEvaluation++ }}
                                {{ $sumEvaluation += $evaluations['evaluation'] }}
                                <td class="tg-0pky">{{ $evaluations['evaluation'] }}</td>
                            @else
                            	<td class="tg-0pky">0</td>
                            @endif
                        @endforeach
                    @endforeach
                    <td class="tg-0pky">{{ $sumEvaluation }}</td>
                    <td class="tg-0pky">{{ $sumEvaluation / $countEvaluation }}</td>
                    <td class="tg-0pky"></td>
                </tr>

            @endforeach
        </table>
        @else
        <b><i>Номінація «{{ $dataItem->genre }}». ансамбль, хор. {{ $dataItem->category }} вікова група</b></i>
        <table class="tg">
        <tr>
            <th class="tg-c3ow" rowspan="2">№</th>
            <th class="tg-c3ow" rowspan="2">Назва групи</th>
            <th class="tg-c3ow" rowspan="2">Місто Навч. заклад</th>
            <th class="tg-c3ow" rowspan="2">Конкурсна програма</th>
            <th class="tg-c3ow" rowspan="2">Викладач/концертмейстер</th>
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
                    <td class="tg-0pky">{{ $item['preparation']['school_address'] }}, {{ $item['preparation']['school_one'] }}</td>
                    <td class="tg-0pky">
                        "{{ $item['presentation']['composition_one'] }}" - {{ $item['presentation']['author_one'] }},
                        "{{ $item['presentation']['composition_two'] }}" - {{ $item['presentation']['author_two'] }}
                    </td>
                    <td class="tg-0pky">
                        {{ $item['preparation']['teacher_surname'] }} {{ $item['preparation']['teacher_name'] }} {{ $item['preparation']['teacher_patronymic'] }}
                        {{ $item['preparation']['concertmaster_surname'] }} {{ $item['preparation']['concertmaster_name'] }} {{ $item['preparation']['concertmaster_patronymic'] }}
                    </td>
                    <?php
                        $sumEvaluation = 0;
                        $countEvaluation = 0;
                    ?>
                    @foreach ($juryNomination as $juryItem)
                        @foreach ($item['evaluations'] as $evaluations)
                            @if($juryItem['user_id'] == $evaluations['user_id'])
                                {{ $countEvaluation++ }}
                                {{ $sumEvaluation += $evaluations['evaluation'] }}
                                <td class="tg-0pky">{{ $evaluations['evaluation'] }}</td>
                            @else
                            	<td class="tg-0pky">0</td>
                            @endif
                        @endforeach
                    @endforeach
                    <td class="tg-0pky">{{ $sumEvaluation }}</td>
                    <td class="tg-0pky">{{ $sumEvaluation / $countEvaluation }}</td>
                    <td class="tg-0pky"></td>
                </tr>
            @endforeach
        </table>
        @endif
    @endif
@endforeach

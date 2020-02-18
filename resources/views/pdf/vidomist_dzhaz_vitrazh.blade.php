<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>

<p align="right">
«Затверджую»<br>
Начальник відділу культури<br>
та туризму СМР<br>
____________ Н.О. Цибульська
</p>
<br>
<p align="center">
Відомість<br>
на вручення подарунків учасникам<br>
І Обласного  дитячого  фестивалю-конкурсу  джазової музики <br> «Джаз-вітраж» ({{ date("d-m-Y") }}р)
</p>
<?php $line = 1; ?>
<table class="tg">
    <tr>
        <th class="tg-c3ow">№</th>
        <th class="tg-c3ow">Прізвище, ім’я, по батькові</th>
        <th class="tg-c3ow">Паспортні дані (№ свідоцтва про народження)</th>
        <th class="tg-c3ow">Домашня  адреса</th>
        <th class="tg-0pky">Ідентифікаційний номер</th>
        <th class="tg-0pky">Назва призу</th>
        <th class="tg-0pky">Вартість отриманого призу</th>
        <th class="tg-0pky">підпис</th>
    </tr>
    @foreach ($data as $item)
        @if($item['application_type_id'] == 1 || $item['application_type_id'] == 2)
        <tr>
            <td class="tg-0pky">{{ $line++ }}</td>
            <td class="tg-0pky">
                @foreach ($item['soloDuet'] as $soloDuet)
                    {{ $soloDuet['surname'] }} {{ $soloDuet['name'] }} {{ $soloDuet['patronymic'] }}
                @endforeach
            </td>
            <td class="tg-0pky">
                @foreach ($item['soloDuet'] as $soloDuet)
                    {{ $soloDuet['passport_data'] }}
                @endforeach
            </td>
            <td class="tg-0pky">
                @foreach ($item['soloDuet'] as $soloDuet)
                    {{ $soloDuet['member_address'] }}
                @endforeach
            </td>
            <td class="tg-0pky">
                @foreach ($item['soloDuet'] as $soloDuet)
                    {{ $soloDuet['parent_name'] }} {{ $soloDuet['parent_surname'] }} {{ $soloDuet['parent_patronymic'] }} {{ $soloDuet['in'] }}
                @endforeach
            </td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
        </tr>
        @else
        <tr>
            <td class="tg-0pky">{{ $line++ }}</td>
            <td class="tg-0pky">
                {{ $item['group']['name'] }} Керівник: <br>
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                @endforeach
            </td>
            <!--
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_passport_data'] }}
                @endforeach
            </td>
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_address'] }}
                @endforeach
            </td>
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_in'] }}
                @endforeach
            </td>
            -->
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
        </tr>
        @endif
    @endforeach
</table>

<table width="100%">
<tr>
<td>
Директор<br>
Сумської  ДМШ № 2<br>
Завгосп  ДМШ № 2
</td>

<td>
<br>
С.А. Даниленко<br>
Л.М. Чигрин
</td>
</tr>
</table>

<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>

<?php $line = 1; ?>
<table class="tg">
    <tr>
        <th class="tg-c3ow">№</th>
        <th class="tg-c3ow">ПІД учасників / назва колективу</th>
        <th class="tg-c3ow">Номінація</th>
        <th class="tg-c3ow">Вікова категорія</th>
        <th class="tg-0pky">Назва навчального закладу</th>
        <th class="tg-0pky">Керівник</th>
        <th class="tg-0pky">Концертмейстер</th>
    </tr>
    @foreach ($data as $item)
        <tr>
            <td class="tg-0pky">{{ $line++ }}</td>
            @if($item->application_type_id == 1 || $item->application_type_id == 2)
                <td class="tg-0pky">
                    @foreach ($item['soloDuet'] as $soloDuet)
                        {{ $soloDuet['surname'] }} {{ $soloDuet['name'] }} {{ $soloDuet['patronymic'] }}
                    @endforeach
                </td>
            @else
                <td class="tg-0pky">
                    {{ $item['group']['name'] }} Керівник: <br>
                    @foreach ($item['teachers'] as $teachers)
                        {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                    @endforeach
                </td>
            @endif
            <td class="tg-0pky">
                {{ $item->nomination->name }}
            </td>
            <td class="tg-0pky">
                {{ $item->age_category }}
            </td>
            <td class="tg-0pky">
                {{ $item->preparation->school_name }}
            </td>
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                @endforeach
            </td>
            <td class="tg-0pky">
                {{ $item['preparation']['concertmaster_surname'] }} {{ $item['preparation']['concertmaster_name'] }} {{ $item['preparation']['concertmaster_patronymic'] }}
            </td>
        </tr>
    @endforeach
</table>

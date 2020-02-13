<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .tg  {border-collapse:collapse;border-spacing:0;width: 100%;}
    .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>

<?php $line = 1; ?>
<table class="tg">
    <tr>
        <th class="tg-c3ow">№</th>
        <th class="tg-c3ow">ПІБ / Назва групи</th>
        <th class="tg-c3ow">Викладач</th>
        <th class="tg-c3ow">Назва закладу</th>
        <th class="tg-c3ow">Телефон викладача</th>
    </tr>
    @foreach ($data as $item)
        <tr>
            <td class="tg-0pky">{{ $line++ }}</td>
            @if($item['application_type_id'] == 1 || $item['application_type_id'] == 2)
                <td class="tg-0pky">
                    @foreach ($item['soloDuet'] as $soloDuet)
                        {{ $soloDuet['surname'] }} {{ $soloDuet['name'] }} {{ $soloDuet['patronymic'] }}
                    @endforeach
                </td>
            @else
                <td class="tg-0pky">
                    {{ $item['group']['name'] }}
                </td>
            @endif
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_surname'] }} {{ $teachers['teacher_name'] }} {{ $teachers['teacher_patronymic'] }} <br>
                @endforeach
            </td>
            <td class="tg-0pky">
                {{ $item['preparation']['school_name'] }}
            </td>
            <td class="tg-0pky">
                @foreach ($item['teachers'] as $teachers)
                    {{ $teachers['teacher_phone'] }} <br>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>

<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        @if(isset($font_size))
            body {
                font-size: {{ $font_size }}; /* Atur ukuran font sesuai kebutuhan */
            }
        @endif
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Per - {{ date('d F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                @foreach($headings as $heading)
                    <th>{{ $heading }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @foreach($data as $item)
                @php
                    $j = 0;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    @foreach($var_name as $var)
                        @php
                            $sub_var_name_value = isset($sub_var_name[$j]) ? $sub_var_name[$j] : null;
                            $isArray = is_array($var);
                        @endphp
                        @if($isArray)
                        @php
                            $var0=$var[0];
                            $var1=$var[1];
                        @endphp
                            @if($sub_var_name_value != null)
                                <td>
                                    @if($sub_var_name_value == 'is_active')
                                        {{ $item->$var0->$var1->$sub_var_name_value == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    @elseif($item->$var0->$var1->$sub_var_name_value == 'perorangan')
                                        {{ 'Perorangan' }}
                                    @elseif($item->$var0->$var1->$sub_var_name_value == 'keluarga')
                                        {{ 'Keluarga' }}
                                    @elseif($item->$var0->$var1->$sub_var_name_value == 'rumah_tangga')
                                        {{ 'Rumah Tangga' }}
                                    @else
                                        {{ $item->$var0->$var1->$sub_var_name_value!=null?$item->$var0->$var1->$sub_var_name_value:'-' }}
                                    @endif
                                </td>
                            @else
                                <td>
                                @if($var0->$var1 == 'is_active')
                                    {{ $item->$var0->$var1 == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                @elseif($item->$var0->$var1 == 'perorangan')
                                    {{ 'Perorangan' }}
                                @elseif($item->$var0->$var1 == 'keluarga')
                                    {{ 'Keluarga' }}
                                @elseif($item->$var0->$var1 == 'rumah_tangga')
                                    {{ 'Rumah Tangga' }}
                                @else
                                {{ $item->$var0->$var1!=null?$item->$var0->$var1->$sub_var_name_value:'-' }}
                                @endif
                                </td>
                            @endif
                        @else
                            @if($sub_var_name_value != null)
                                <td>
                                    @if($sub_var_name_value == 'is_active')
                                        {{ $item->$var->$sub_var_name_value == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    @elseif($item->$var->$sub_var_name_value == 'perorangan')
                                        {{ 'Perorangan' }}
                                    @elseif($item->$var->$sub_var_name_value == 'keluarga')
                                        {{ 'Keluarga' }}
                                    @elseif($item->$var->$sub_var_name_value == 'rumah_tangga')
                                        {{ 'Rumah Tangga' }}
                                    @else
                                        {{ $item->$var->$sub_var_name_value!=null?$item->$var->$sub_var_name_value:'-' }}
                                    @endif
                                
                                    @if(isset($var_children[$var]))
                                        @foreach($var_children[$var] as $child)
                                            {{ $child['divider'] }}
                                            @php
                                                $child_temp = $item->{$child['child']};
                                            @endphp
                                            {{$child_temp!=null?$child_temp:'-'}}
                                            {{ isset($child['closer']) ? $child['closer']: '' }}
                                        @endforeach
                                    @endif
                                </td>
                            @else
                                <td>
                                @if($var == 'is_active')
                                    {{ $item->$var == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                @elseif($item->$var == 'perorangan')
                                    {{ 'Perorangan' }}
                                @elseif($item->$var == 'keluarga')
                                    {{ 'Keluarga' }}
                                @elseif($item->$var == 'rumah_tangga')
                                    {{ 'Rumah Tangga' }}
                                @else
                                    {{ $item->$var!=null?$item->$var:'-' }}
                                @endif

                                @if(isset($var_children[$var]))
                                    @foreach($var_children[$var] as $child)
                                        {{ $child['divider'] }}
                                        @php
                                            $child_temp = $item->{$child['child']};
                                        @endphp
                                        {{$child_temp!=null?$child_temp:'-'}}
                                        {{ isset($child['closer']) ? $child['closer']: '' }}
                                    @endforeach
                                @endif
                                </td>
                            @endif
                        @endif
                        @php
                            $j++;
                        @endphp
                    @endforeach
                </tr>
                @php
                    $index++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>
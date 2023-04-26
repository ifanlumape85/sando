@extends('layouts.frontend.app')
@section('content')
<section style="background-color: #ededed;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
                    <h1 class="text-bold text-center h1">Dashboard Pemantauan Terpadu</h1>
                    <p class="h2"><a href="/" class="text-success">Percepatan Pencegahan Stunting</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background-color: #ffffff;">
    <div class="container">
        <div class="row p-4">
            <div class="col">
                <table class="table">
                    @foreach($puskesmas as $item)
                    <tr>
                        <td>{{ $item->nama ?? null }}
                            <p>&nbsp;</p>
                            <table class="table">
                                <tr>
                                    <th colspan="2">Berat Badan menurut Tinggi/Panjang Badan (BB/TB & BB/PB)</th>
                                </tr>
                                <tr>
                                    <td style="width:50%">Gizi Buruk</td>
                                    <td>{{ $item->giziBuruk() }}</td>
                                </tr>
                                <tr>
                                    <td>Gizi Kurang</td>
                                    <td>{{ $item->giziKurang() }}</td>
                                </tr>
                                <tr>
                                    <td>Gizi Baik (Normal)</td>
                                    <td>{{ $item->giziBaik() }}</td>
                                </tr>
                                <tr>
                                    <td>Beresiko Gizi Lebih</td>
                                    <td>{{ $item->risikoGiziLebih() }}</td>
                                </tr>
                                <tr>
                                    <td>Gizi Lebih</td>
                                    <td>{{ $item->giziLebih() }}</td>
                                </tr>
                                <tr>
                                    <td>Obesitas</td>
                                    <td>{{ $item->obesitas() }}</td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table class="table">
                                <tr>
                                    <th colspan="2">Tinggi/Panjang Badan menurut Umur (TB/U & PB/U)</th>
                                </tr>
                                <tr>
                                    <td style="width:50%">Sangat Pendek</td>
                                    <td>{{ $item->sangatPendek() }}</td>
                                </tr>
                                <tr>
                                    <td>Pendek</td>
                                    <td>{{ $item->pendek() }}</td>
                                </tr>
                                <tr>
                                    <td>Normal</td>
                                    <td>{{ $item->normal() }}</td>
                                </tr>
                                <tr>
                                    <td>Tinggi</td>
                                    <td>{{ $item->tinggi() }}</td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table class="table">
                                <tr>
                                    <th colspan="2">Berat Badan menurut Umur (BB/U)</th>
                                </tr>
                                <tr>
                                    <td style="width:50%">Berat Badan Sangat Kurang</td>
                                    <td>{{ $item->beratBadanSangatKurang() }}</td>
                                </tr>
                                <tr>
                                    <td>Berat Badan Kurang</td>
                                    <td>{{ $item->beratBadankurang() }}</td>
                                </tr>
                                <tr>
                                    <td>Berat Badan Normal</td>
                                    <td>{{ $item->beratBadanNormal() }}</td>
                                </tr>
                                <tr>
                                    <td>Risiko Berat Badan Lebih</td>
                                    <td>{{ $item->risikoBeratBadanLebih() }}</td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
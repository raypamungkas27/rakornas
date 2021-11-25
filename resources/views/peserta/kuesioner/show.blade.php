@extends('peserta.master')
@section('title',"Pengisian Kuesioner ".$acara->judul_acara)

@section('subTitle',"Pengisian Kuesioner ".$acara->judul_acara)

@section('content')

<form action="/peserta/app/kuesioner/add/{{ $id }}" method="post">
@csrf



@foreach ($data as $key => $item)
    {{-- {{ $item }} --}}

    @if ($item->type == "pg")
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for=""> <h5>{{ $key+1 }}. {{ $item->soal }}</h5> </label>

                    @foreach (json_decode($item->pilihan) as $value => $pilihan)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pg[{{ $item->id }}]" id="{{ $pilihan }}{{ $item->id }}" value="{{ $pilihan }}-{{ $item->id }}" required >
                            <label class="form-check-label" for="{{ $pilihan }}{{ $item->id }}">
                                {{ $pilihan }}
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif

    @if ($item->type == "cb")
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for=""> <h5>{{ $key+1 }}. {{ $item->soal }}</h5> </label>

                    <div>
                        @foreach (json_decode($item->pilihan) as $value => $pilihan)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{ $value }}{{ $item->id }}" name="cb[]" value="{{ $pilihan }}-{{ $item->id }}">
                                <label class="form-check-label" for="{{ $value }}{{ $item->id }}">{{ $pilihan }}</label>
                            </div>
                            <br>
                        @endforeach



                    </div>



                </div>
            </div>
        </div>        
    @endif

    @if ($item->type == "essai")
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for=""> <h5>{{ $key+1 }}. {{ $item->soal }}</h5></label>

                    <textarea name="essai[{{ $item->id }}]" id="essai" cols="30" rows="10" class="form-control" required ></textarea>
                </div>
            </div>
        </div>
    @endif
@endforeach


<div class="card">
    <div class="card-body">
       
        <button type="submit" class="btn btn-primary simpan" style="width: 100%" >Simpan</button>
    </form>
    </div>
</div>

@endsection

@section('js')

@endsection

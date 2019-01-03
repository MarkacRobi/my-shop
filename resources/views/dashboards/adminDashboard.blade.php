@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row mbr-justify-content-center">
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fas fa-edit"></span>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="text-wrap vcenter text-muted">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Urejanje <span>podajalcev</span></h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Ustvarjanje, aktiviranje in deaktiviranje uporabniškega računa Prodajalec ter posodobitev njegovih atributov.</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fas fa-user-edit"></span>
                    </div>
                    <a href="{{route('users.edit',Auth::user()->id)}}">
                        <div class="text-wrap vcenter text-muted">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Urejanje
                                <span>profila</span>
                            </h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Posodobitev lastnega gesla in ostalih atributov.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

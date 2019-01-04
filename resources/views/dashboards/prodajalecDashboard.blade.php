@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fas fa-history"></span>
                        </div>
                        <a href="{{ url('orders/potrjena') }}">
                            <div class="text-wrap vcenter text-muted">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Zgodovina potrjenih naročil</h2>
                                <p class="mbr-fonts-style text1 mbr-text display-6">Ogled zgodovine potrjenih naročil in možnost storniranja potrjenih naročil.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fas fa-edit"></span>
                        </div>
                        <a href="{{ route('orders.index') }}">
                            <div class="text-wrap vcenter text-muted">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Pregled/Potrjevanje/Preklic neobdelanih naročil</h2>
                                <p class="mbr-fonts-style text1 mbr-text display-6">Pregled še neobdelanih naročil in njihovih postavk ter potrjevanje ali preklic oddanih naročil.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="{{ route('users.index') }}">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fas fa-edit"></span>
                            </div>
                                <div class="text-wrap vcenter text-muted">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Urejanje <span>Strank</span></h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">Ustvarjanje, aktiviranje in deaktiviranje uporabniških računov tipa Stranka in posodabljanje njegovih atributov.</p>
                                </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="{{route('users.edit',Auth::user()->id)}}">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fas fa-user-edit"></span>
                            </div>
                                <div class="text-wrap vcenter text-muted">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Urejanje
                                        <span>profila</span>
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">Posodobitev lastnega gesla in ostalih atributov.</p>
                                </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

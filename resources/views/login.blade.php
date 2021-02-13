@extends('layouts.master')
@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kirimlogin') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row justify-content-md-center">
                            <div class="col-md-7">
                                @if (session('info') == 1)
                                    <div class="alert alert-warning alert-has-icon alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <div class="alert-icon">
                                            <i class="far fa-lightbulb"></i>
                                        </div>
                                        <div class="alert-body">
                                            <div class="alert-title">Warning</div>
                                            Username/Password Tidak Tersedia, Harap Periksa Lagi
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control {{ $errors->has('NOPASIEN') ? ' is-invalid' : '' }}" id="username" name="NOPASIEN" value="{{ old('NOPASIEN') }}" placeholder="No.RM" required="">
                                    @if ($errors->has('NOPASIEN'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('NOPASIEN') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control {{ $errors->has('PASSWD') ? ' is-invalid' : '' }}" id="pass" name="PASSWD" placeholder="Tgl.Lahir (ddmmYYYY)" value="{{ old('PASSWD') }}" required="">
                                    @if ($errors->has('PASSWD'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('PASSWD') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="captcha">
                                        <span>{!! captcha_img('flat') !!}</span>
                                        <button type="button" class="btn btn-primary" id="btn-refresh">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Captcha</label>
                                    <input type="text" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" placeholder="Enter Ulang Captcha" required autocomplete="off">
                                    @if ($errors->has('captcha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('captcha') }}
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        $(document).ready(function () {
            var cleavePC = new Cleave('#username', {
                blocks: [8],
                numericOnly: true
            });

            var cleavePC = new Cleave('#pass', {
                blocks: [8],
                numericOnly: true
            });

            $('#btn-refresh').click(function () {
                $.ajax({
                    type : 'GET',
                    url:'{!!URL::to('refresh_cap')!!}',
                    success : function (data) {
                        $('.captcha span').html(data);
                    }
                });
            });
        });
    </script>
    <!-- <script>
        @if(Session::has('expired'))
            swal('You Not In Activity', 'Anda Tidak Melakukan Aktivitas Lebih Dari 2 Menit!', 'warning');
        @endif
    </script> -->
@stop

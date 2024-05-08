@extends('layouts.master')


@section('content')
<style>
    .error {
        border: 1px solid red;
    }
</style>

<!-- BTN EDIT START -->
<div class="row align-items-center mb-4">
    <div class="col-lg">
        <div class="container-tight">
            <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="/admin/dashboard">
                            <img src="{{ asset('kir/poto-kendaraan/logo_dishub.png') }}" width="75" height="" alt="Tabler" class="">
                        </a>
                        <h3 class="mt-3">
                            PEMERINTAH <br class="d-sm-block d-md-none"> KABUPATEN OGAN KOMERING ILIR <br>
                            DINAS PERHUBUNGAN<br>
                            DATA SIMPKB <br>
                        </h3>
                    </div>
                    <form id="myForm" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor Polisi</label>
                            <!-- Form nopol -->
                            <div class="row g-2">
                                <div class="col-3">
                                    <input type="text" name="kode_plat" id="kode_plat" class="form-control text-center text-uppercase" autofocus>
                                </div>
                                <div class="col-6">
                                    <input type="number" name="nomor_plat" id="nomor_plat" class="form-control text-center text-uppercase" autofocus>
                                </div>
                                <div class="col-3">
                                    <input type="text" name="kode_wilayah" id="kode_wilayah" class="form-control text-center text-uppercase" autofocus>
                                </div>
                                <span class="form-text text-primary">Nopol Data kendaraan, contoh: BG0001KA </span>
                            </div>
                            <!-- Form captcha -->
                            <div class="row g-2 my-3">
                                <label for="captcha" class="col-form-label text-md-right">Captcha</label>
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                                <div class="form-group my-2">
                                    <div class="col">
                                        <input id="captcha" type="text" class="form-control" placeholder="Masukan Captcha">
                                    </div>
                                    <span class="form-text text-primary">Penting untuk mengisi kode captcha</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <div class="row align-items-start">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100" style="background: #42429f;letter-spacing: 3px;">CARI</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary w-100" style="background: #42429f;letter-spacing: 3px;" id="reset">RESET</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="alert">
                        <!-- this is alert -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BTN EDIT END -->


<!-- VIEW RESULT START -->
<div class="row row-cards mb-4 mx-1" id="viewResult">
    <!-- result -->
</div>
<!-- VIEW RESULT END -->
@endsection

@push('my_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function reload() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    }

    $('#reload').click(function() {
        reload();
    });


    $(document).ready(function() {
        $("#myForm").submit(function(e) {
            e.preventDefault();

            let kode_plat = $("#kode_plat").val();
            let nomor_plat = $("#nomor_plat").val();
            let kode_wilayah = $("#kode_wilayah").val();
            const captcha = $("#captcha").val();
            const viewResult = $('#viewResult');
            const nopol = kode_plat + nomor_plat + kode_wilayah;
            const regex = /^[A-Za-z]+$/;

            $('input').removeClass('error');
            if (!regex.test(kode_plat)) {
                $('#kode_plat').addClass('error');
                alert("Kode plat haru huruf!");
                return false;
            }
            if (!kode_plat) return $('#kode_plat').addClass('error');
            if (kode_plat.length > 3) return $('#kode_plat').addClass('error');
            if (!nomor_plat) return $('#nomor_plat').addClass('error');
            if (nomor_plat.length > 4) return $('#nomor_plat').addClass('error');
            if (!kode_wilayah) return $('#kode_wilayah').addClass('error');
            if (kode_wilayah.length > 3) return $('#kode_wilayah').addClass('error');
            if (!regex.test(kode_wilayah)) {
                $('#kode_wilayah').addClass('error');
                alert("Kode wilayah haru huruf!");
                return false;
            }
            if (!captcha) return $('#captcha').addClass('error');

            $.ajax({
                type: 'POST',
                url: "/pencarian-simpkbdb",
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_plat,
                    nomor_plat,
                    kode_wilayah,
                    captcha
                },
                cache: false,
                success: function(response) {
                    if (response.data.length === 0) {
                        console.log('this is :', response);
                        document.querySelector('#alert').innerHTML = '';
                        document.querySelector('#viewResult').innerHTML = '';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data tidak ditemukan!',
                        })
                    }

                    if (response.status == 'success' && response.data.length > 0) {
                        console.log('bukan disisni')
                        document.querySelector('#alert').innerHTML = setAlertDown();
                        document.querySelector('#viewResult').innerHTML = setViewResult(response, nopol);
                    }
                    $('#myForm :input').val('');
                    reload();
                },

                error: function(xhr, status, error) {
                    // Handle error, e.g., display validation errors
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            // Handle each error message for a specific field
                            const errors = messages.join(', ')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: `${errors}`,
                            })
                        });
                    }
                }
            })
        });

        // BTN RESET FORM
        $('#reset').click(function() {
            // Reset the form by triggering the reset event
            $('#myForm :input').val('');
            document.querySelector('#alert').innerHTML = '';
            document.querySelector('#viewResult').innerHTML = '';
            reload();
        });


        // SET VIEW RESULT
        function setViewResult(response, nopol) {
            const data = response.data[0]
            const jbb = parseInt(data.jbb);
            let tarif_uji_baru;

            if (jbb <= 3001) tarif_uji_baru = 75000;
            if (jbb >= 3001 && jbb <= 6000) tarif_uji_baru = 85000;
            if (jbb >= 6001 && jbb <= 9000) tarif_uji_baru = 95000;
            if (jbb >= 9001 && jbb <= 14000) tarif_uji_baru = 105000;
            if (jbb > 14000) tarif_uji_baru = 115000;


            return `
            <div class="col-md-6 mx-auto col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Info Kendaraan <span class="text-uppercase">${nopol}</span>
                        </h3>
                    </div>
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Informasi</th>
                                <th colspan="2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nomor Polisi</td>
                                <td><span class="text-uppercase">${nopol}</span></td>
                            </tr>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td><span class="text-uppercase">${data.nama}</span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>${data.alamat}</td>
                            </tr>
                            <tr>
                                <td>Jbb</td>
                                <td>${data.jbb}</td>
                            </tr>
                            <tr>
                                <td>Merek</td>
                                <td>${data.merek}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>${data.tipe}</td>
                            </tr>
                            <tr>
                                <td>Nomor Mesin</td>
                                <td>${data.nomesin}</td>
                            </tr>
                            <tr>
                                <td>Nomor Rangka</td>
                                <td>${data.norangka}</td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>${data.jenis}</td>
                            </tr>
                            <tr>
                                <td>Tarif uji baru / pertama uji berkala / perpanjang, numpang uji</td>
                                <td><b>Rp.25000</b></td>
                            </tr>
                            <tr>
                                <td>Tarif teknisi termasuk bukt lulus</td>
                                <td><b>Rp. ${tarif_uji_baru}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

                `
        }

        // SET ALERT DOWN
        function setAlertDown() {
            return `
                <div class="alert bg-success text-white alert-success text-center mt-2" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 21l0 -18"></path>
                        <path d="M20 18l-3 3l-3 -3"></path>
                        <path d="M4 18l3 3l3 -3"></path>
                        <path d="M17 21l0 -18"></path>
                    </svg>
                    <span>Hasil scroll kebawah</span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 21l0 -18"></path>
                        <path d="M20 18l-3 3l-3 -3"></path>
                        <path d="M4 18l3 3l3 -3"></path>
                        <path d="M17 21l0 -18"></path>
                    </svg>
                </div>`
        }
    });
</script>

@endpush
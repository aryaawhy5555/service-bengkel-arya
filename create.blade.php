{{-- @dd($cust); --}}

@extends('dashboard.layouts.main')



@section('content')
    <main class="cd__main">
        {{-- success confrim --}}
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-lg-4">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                            <circle class="path circle" fill="none" stroke="#198754" stroke-width="6"
                                stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                            <polyline class="path check" fill="none" stroke="#198754" stroke-width="6"
                                stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                        </svg>
                        <h4 class="text-success mt-3">Notification:</h4>
                        <p class="mt-3">{{ session('success') }}</p>
                        <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- confirm delete --}}
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-lg-4">
                        <!-- Your SVG and content here -->
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                            <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6"
                                stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                                stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                                stroke-miterlimit="10" x1="95.8" y1="38" X2="34.4" y2="92.2" />
                        </svg>
                        <h4 class="text-danger mt-3">Are you sure you want to delete?</h4>
                        <!-- "Yes" button with a data attribute to handle deletion -->
                        <button type="button" class="btn btn-sm mt-3 btn-danger" data-action="delete">Yes</button>
                        <!-- "No" button to dismiss the modal -->
                        <button type="button" class="btn btn-sm mt-3 btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section class="d-flex justify-content-center align-items-center col-lg-12" style="margin-top: 120px;">
        <div class="register-area card justify-content-center align-items-center w-100" style="width: 30rem;">
            <div class="card-body col-lg-10">
                <form action="/customer/create" method="post" id="formCustomer">
                    @csrf
                    <div class="container">
                        <h1 class="text-center fs-5">CUSTOMER</h1>
                        <!-- NAMA-->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control  @error('namacust') is-invalid @enderror"
                                id="floatingInput" placeholder="sucipto,cahyo" name="namacust"
                                value="{{ old('namacust') }}">
                            <label for="floatingInput">Nama Customer</label>
                            @error('namacust')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- merk -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror "
                                name="email" id="floatingInput" placeholder="name@example.com"
                                value="{{ old('namaemail') }}">
                            <label for="floatingInput">Email Address</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <!--    telp  -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('tlpcust') is-invalid @enderror "
                                name="tlpcust" id="floatingInput" placeholder="name@example.com"
                                value="{{ old('telpcust') }}">
                            <label for="floatingInput">Telp Customer</label>
                            @error('tlpcust')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="alamatcust" placeholder="Leave a comment here" id="floatingTextarea"
                                value="{{ old('alamatcust') }}"></textarea>
                            <label for="floatingTextarea">Alamat Customer</label>
                            @error('alamatcust')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="d-flex mt-4 justify-content-center">
                            <button type="submit" class="btn btn-primary px-3 ">Save changes</button>
                        </div>
                </form>

            </div>
        </div>

    </section>

    {{-- end customer --}}
    {{-- motor --}}
    <section class="d-flex justify-content-center align-items-center col-lg-12" style="margin-top: 120px;">
        <div class="register-area card justify-content-center align-items-center w-100" style="width: 30rem;">
            <div class="card-body col-lg-10">
                <form action="/motor/create" method="post" id="formMotor">
                    @csrf
                    <div class="container">
                        <h1 class="text-center fs-5">MOTOR</h1>
                        {{-- kd_cust --}}
                        <select class="form-select @error('kd_cust') is-invalid @enderror mb-3" aria-placeholder="cust"
                            aria-label="Default select example" name="kd_cust">
                            <option selected disabled>Nama Cust</option>
                            @foreach ($cust as $items)
                                <option value="{{ $items->kd_cust }}">
                                    {{ $items->kd_cust . ' - ' . $items->namacust }}</option>
                            @endforeach
                        </select>

                        <!-- plat-->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control  @error('no_plat') is-invalid @enderror"
                                id="floatingInput" placeholder="A61SK6B" name="no_plat" value="{{ old('no_plat') }}">
                            <label for="floatingInput">NO
                                PLAT</label>
                            @error('no_plat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- email -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('merk') is-invalid @enderror "
                                name="merk" id="floatingInput" placeholder="name@example.com"
                                value="{{ old('merk') }}">
                            <label for="floatingInput">Merek</label>
                            @error('merk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <!--    telp  -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('variant') is-invalid @enderror "
                                name="variant" id="floatingInput" placeholder="name@example.com"
                                value="{{ old('variant') }}">
                            <label for="floatingInput">variant</label>
                            @error('variant')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <select class="form-select @error('level') is-invalid @enderror mb-3" aria-placeholder="montir"
                            aria-label="Default select example" name="level">
                            <option selected disabled>Level</option>
                            <option selected value="1">BAIK</option>
                            <option selected value="2">BURUK</option>

                        </select>
                        <div class="d-flex mt-4 justify-content-center">
                            <button type="submit" class="btn btn-primary px-3 ">Save changes</button>
                        </div>
                </form>

            </div>
        </div>


    </section>
    {{-- end motor --}}
    <section class=" d-flex justify-content-center align-items-center col-lg-12" style="margin-top: 120px;">
        <div class="register-area card justify-content-center align-items-center w-100" style="width: 30rem;">
            <div class="card-body col-lg-10">
                <form action="/service/create" method="post">
                    @csrf
                    <div class="container ">
                        <h1 class="text-center fs-5">REGISTRASI</h1>
                        <!-- TANGGAL-->
                        <div class="form-floating">
                            <input type="date" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror mb-3" id="floatingInput"
                                placeholder="dadar jagang">
                            <label for="floatingInput">Tanggal</label>
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!--montir -->
                        <select class="form-select @error('kd_montir') is-invalid @enderror mb-3"
                            aria-placeholder="montir" aria-label="Default select example" name="kd_montir">
                            <option selected disabled>Montir</option>
                            @foreach ($montir as $items)
                                <option value="{{ $items->kd_montir }}">
                                    {{ $items->kd_montir . ' - ' . $items->nama_montir }}</option>
                            @endforeach
                        </select>
                        @error('kd_montir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <select class="form-select @error('no_antrian') is-invalid @enderror mb-3"
                            aria-placeholder="boking" aria-label="Default select example" name="no_antrian">
                            <option selected disabled>no_boking</option>
                            <option value="0">tidak ada</option>
                            @foreach ($boking as $items)
                                <option value="{{ $items->no_antrian }}">
                                    {{ $items->no_antrian . ' - ' . $items->nama }}</option>
                            @endforeach
                        </select>

                        <select class="form-select @error('kd_admin') is-invalid @enderror mb-3"
                            aria-placeholder="boking" aria-label="Default select example" name="kd_admin">
                            <option selected disabled>admin</option>
                            @foreach ($admin as $items)
                                <option value="{{ $items->id }}">
                                    {{ $items->id . ' - ' . $items->username }}</option>
                            @endforeach
                        </select>
                        <select class="form-select @error('kd_motor') is-invalid @enderror mb-3"
                            aria-placeholder="boking" aria-label="Default select example" name="kd_motor">
                            <option selected disabled>motor</option>
                            @foreach ($motor as $items)
                                <option value="{{ $items->kd_motor }}">
                                    {{ $items->kd_motor . ' - ' . $items->merk . ' - ' . $items->variant }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-floating">
                            <textarea class="form-control" name="keluhan" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Keluhan</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" name="total"
                                class="form-control @error('total') is-invalid @enderror mb-3 total" id="floatingInput"
                                placeholder="dadar jagang">
                            <label for="floatingInput">total</label>
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex mt-4 justify-content-center">
                        <button type="submit" class="btn btn-primary px-3 ">Save changes</button>

                    </div>
                </form>

            </div>
        </div>
    </section>
    <section class=" d-flex justify-content-center align-items-center col-lg-12 " style="margin-top: 120px;">
        <div class="register-area card justify-content-center align-items-center w-100" style="width: 30rem;">
            <div class="card-body col-lg-10">
                <form action="/detail/create" method="post" id="formPembayaran">
                    @csrf
                    <div class="container ">
                        <h1 class="text-center fs-5">PEMBAYARAN</h1>
                        <!-- NO_NOTA-->
                        <select class="form-select @error('no_nota') is-invalid @enderror mb-3" aria-placeholder="nota"
                            aria-label="Default select example" name="no_nota" id="no_nota">
                            <option selected disabled>no_nota</option>
                            @foreach ($service as $items)
                                <option value="{{ $items->no_nota }}" data-tanggal="{{ $items->tanggal }}">
                                    {{ $items->no_nota }}</option>
                            @endforeach
                        </select>
                        
                        <input type="hidden" name="tanggal" id="tanggal">
                        @error('no_nota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <!-- Stok (Kanan) -->
                        <select class="form-select @error('kd_cust') is-invalid @enderror mb-3" aria-placeholder="boking"
                            aria-label="Default select example" name="kd_cust" id="kd_cust_select">
                            <option selected disabled>customer</option>
                            @foreach ($cust as $items)
                                <option value="{{ $items->kd_cust }}">
                                    {{ $items->kd_cust . ' - ' . $items->namacust }}
                                </option>
                            @endforeach
                        </select>

                        @for ($i = 1; $i <= 5; $i++)
                            <input type="hidden" name="harga[]" class="form-control mb-3 hargaInput"
                                id="harga_{{ $i }}" placeholder="dadar jagang">
                            <select class="form-select @error('kd_barang.' . $i) is-invalid @enderror py-3 mt-4 barang"
                                aria-placeholder="barang" aria-label="Default select example" name="kd_barang[]">
                                <option selected value="0" disabled>Choose a barang</option>
                                <option value="" data-index={{ $i }}>
                                    tidak ada
                                </option>
                                @foreach ($barang as $item)
                                    @php
                                        $disabled = $item->stok <= 0 ? 'disabled' : '';
                                    @endphp
                                    <option value="{{ $item->kd_barang }}" data-harga-jual="{{ $item->harga_jual }}"
                                        data-index={{ $i }} {{ $disabled }}>
                                        {{ $item->kd_barang . ' - ' . $item->nama_barang . ' - ' . $item->harga_jual . ' - ' . $item->stok }}
                                        @if ($item->stok <= 0)
                                            (Stok Kosong)
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('kd_barang.' . $i)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endfor

                        <!--barang -->
                        <div class="form-floating mt-4">
                            <input type="text"
                                class="form-control @error('harga') is-invalid @enderror mb-3 hargaInput" id="hargaInput"
                                placeholder="dadar jagang" disabled>
                            <input type="hidden" name="harga[]" class="form-control mb-3 hiddenHargaInput"
                                id="harga_{{ $i }}" placeholder="Masukkan Harga">

                            <label for="hargaInput">harga</label>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating ">
                            <input type="text" name="jumlah" class="form-control jumlahInput" id="jumlahInput"
                                placeholder="jumlah" disabled>
                            <input type="hidden" name="jumlah" class="form-control jumlahInput" id="jumlahInput"
                                placeholder="jumlah">

                            <label for="floatingInput">jumlah</label>
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" name="subtotal"
                                class="form-control @error('subtotal') is-invalid @enderror mb-3 subtotal"
                                id="floatingInput" placeholder="dadar jagang" disabled>
                            <input type="hidden" name="subtotal"
                                class="form-control @error('subtotal') is-invalid @enderror mb-3 subtotal"
                                id="floatingInput" placeholder="dadar jagang">
                            <label for="floatingInput">subtotal</label>
                            @error('subtotal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex mt-4 justify-content-center">
                        <button type="submit" class="btn btn-primary px-3 ">Save changes</button>

                    </div>
                </form>

            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <script>
        // confirm modal
        @if (session('success'))
            $(document).ready(function() {
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 25000);
            });
        @endif
        //confirmation
        function showDeleteConfirmation() {
            $('#confirmationModal').modal('show');


            $('#deleteForm').submit();

        };


        $(document).ready(function() {
            $('#no_nota').change(function() {
                var selectedTanggal = $(this).find(':selected').data('tanggal')
                $('#tanggal').val(selectedTanggal)
            })

            {{-- service ( harga,jumlah) --}}
            var hargaInput = $('#hargaInput');
            var hiddenHargaInput = $('.hiddenHargaInput');

            $('.barang').on('change', function() {
                updateSelectedItems();
            });

            function updateSelectedItems() {
                var selectedItems = {};
                var totalHarga = 0;
                var totalJumlah = 0;

                $('.barang').each(function(i) {
                    var selectedOption = $(this).find(':selected');
                    var hargaJual = parseFloat(selectedOption.data('harga-jual')) || 0;
                    var namaBarang = selectedOption.text();

                    if (selectedOption.val() !== 'tidak ada' && selectedOption.val() !== '0') {
                        selectedItems[namaBarang] = hargaJual;
                        $('#harga_' + (i + 1)).val(hargaJual);
                        totalHarga += hargaJual;
                        totalJumlah += 1;
                    }
                });

                updateHargaInput(selectedItems);
                updateHiddenHargaInput(totalHarga);

                $('.jumlahInput').val(totalJumlah);
                hargaInput.val(totalHarga);
            }

            function updateHargaInput(selectedItems) {
                var harga = '';

                if (Object.keys(selectedItems).length > 0) {
                    $.each(selectedItems, function(namaBarang, hargaJual) {
                        var parts = namaBarang.split('-');
                        var barangName = parts.length > 1 ? parts[1].trim() : parts[0].trim();
                        harga += barangName + ' - ' + hargaJual + ', ';
                    });

                    harga = harga.replace(/, $/, '');
                }

                hargaInput.val(harga);
            }

            function updateHiddenHargaInput(totalHarga) {
                hiddenHargaInput.val(totalHarga);
            }

            var hargaBarangInput = $('#hargaBarang');
            var stokInput = $('#stok');
            var hargaBeliInput = $('input[name="harga_beli"]');

            hargaBarangInput.add(stokInput).on('keyup', function() {
                updateHargaBeli();
            });

            function updateHargaBeli() {
                var hargaBarang = parseFloat(hargaBarangInput.val()) || 0;
                var stok = parseFloat(stokInput.val()) || 0;

                var hargaBeli = hargaBarang * stok;

                hargaBeliInput.val(hargaBeli);
            }

            function updateHiddenHargaInput(totalHarga) {
                hiddenHargaInput.val(totalHarga);
            }


            var jumlah = 0;
            var harga = '';

            $('.barang').on('change', function() {
                var selectedOption = $(this).find(':selected');
                var hargaJual = parseFloat(selectedOption.data('harga-jual')) || 0;

                if (selectedOption.val() !== 'tidak ada') {
                    jumlah += 1;

                    harga = (harga === '') ? hargaJual : harga + hargaJual;
                }

                $('.jumlahInput').val(jumlah);
                $('.subtotal').val(harga);
            });

        });
    </script>
@endsection

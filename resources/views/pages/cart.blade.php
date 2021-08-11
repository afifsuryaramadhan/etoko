@extends('layouts.app')

@section('title')
    Cart Page
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Cart
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="Cart">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Produk &amp; Penjual</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kuantitas</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0 @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 25%;">
                                            @if ($cart->product->gambar)
                                                <img src="{{ Storage::url($cart->product->gambar->first()->gambar) }}"
                                                    alt="" class="cart-image" />
                                            @endif
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $cart->product->produk }}</div>
                                            <div class="product-subtitle">by {{ $cart->product->users->nama }}</div>
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">Rp. {{ number_format($cart->product->harga) }}
                                            </div>
                                            {{-- <div class="product-subtitle">Rupiah</div> --}}
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $cart->kuantitas }}</div>
                                            <div class="product-subtitle">Kuantitas</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $totalprice += $cart->product->harga * $cart->kuantitas @endphp
                                    {{-- @php $totalPrice += $cart->product->harga @endphp --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>
                {{-- <form action="{{ url('ongkir') }}" id="locations" method="GET"> --}}
                <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" id="totalPrice" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" id="totalPay" name="total_pay" value="{{ $totalPrice }}">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="alamat" aria-describedby="emailHelp"
                                    name="alamat" value="Setra Duta Cemara" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Provisi</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                                    v-model="provinces_id">
                                    <option v-for="province in provinces" :value="province.id">@{{ province . name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="regencies_id">Kabupaten/Kota</label>
                                <select name="regencies_id" @change="GetCourier()" id="regencies_id" class="form-control"
                                    v-if="regencies" v-model="regencies_id">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency . name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="districts_id">Kecamatan</label>
                                <select name="districts_id" id="districts_id" class="form-control" v-if="districts"
                                    v-model="districts_id">
                                    <option v-for="district in districts" :value="district.id">@{{ district . name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="+628 2020 11111" />
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="kurir">Pilih Jasa Pengiriman</label>
                                <select name="kurir" id="kurir" class="form-control">
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="kurir"></label>
                                <button type="submit" class="btn btn-danger btn-block">Cek Ongkir</button>
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col">
                                @foreach ($cekongkirs as $item)

                                @endforeach
                            </div>
                        </div> --}}

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" v-if="courier">
                                <label>KURIR PENGIRIMAN</label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input select-courier" type="radio" name="courier"
                                        id="ongkos_kirim-jne" value="jne" v-model="courier_type" @change="getOngkir()" />
                                    <label class="form-check-label font-weight-bold mr-4" for="ongkos_kirim-jne">
                                        JNE</label>
                                    <input class="form-check-input select-courier" type="radio" name="courier"
                                        id="ongkos_kirim-tiki" value="tiki" v-model="courier_type" @change="getOngkir()" />
                                    <label class="form-check-label font-weight-bold mr-4"
                                        for="ongkos_kirim-jnt">TIKI</label>
                                    <input class="form-check-input select-courier" type="radio" name="courier"
                                        id="ongkos_kirim-pos" value="pos" v-model="courier_type" @change="getOngkir()" />
                                    <label class="form-check-label font-weight-bold" for="ongkos_kirim-jnt">POS</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group" v-if="cost">

                                <label class="font-weight-bold">SERVICE KURIR</label>
                                <br />
                                <div v-for="value in costs" :key="value.service" class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cost" :id="value.service"
                                        :value="value.cost[0].value + '|' + value.service" v-model="costService"
                                        @change="getCostService()" />
                                    <label class="form-check-label font-weight-normal mr-5" :for="value.service">
                                        @{{ value . service }} - Rp.
                                        @{{ value . cost[0] . value }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2>Payment Informations</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp. 0</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">Rp. 0</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title" id="courier_cost">Rp. 0</div>
                            <div class="product-subtitle">Ship to <p id="tujuan">
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success" id="totalPembayaran">Rp.
                                {{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                                Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // console.log('berhasil');
            $('.provinces_id').select2();
        });

    </script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                this.getProvincesData();
                AOS.init();
            },
            data: {
                courier: false,
                courier_cost: 0,
                courier_service: "",
                cost: false,
                costs: [],
                costService: null,
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
                courier_type: null,

            },
            methods: {
                GetCourier() {
                    var self = this;
                    self.courier = true;
                    axios.get('{{ url('api/regencies_id') }}/' + self.regencies_id)
                        .then(function(response) {
                            self.regencies = response.data.name;
                            document.getElementById("tujuan").innerHTML = response.data.name;
                        });
                    // console.log(self.regencies_id)
                },
                getOngkir() {
                    var self = this;
                    axios.post("{{ route('api-checkOngkir') }}", {
                            regencies_destination: self.regencies_id, // <-- ID kota
                            courier: self.courier_type, // jenis kurir
                        })
                        .then((response) => {

                            // set state cost menjadi true, untuk menampilkan pilihan cost pengiriman
                            self.cost = true;
                            //assign state costs dengan hasil response
                            self.costs = response.data.data[0].costs;
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                },
                getCostService() {
                    var self = this;
                    let shipping = self.costService.split("|");
                    self.checkout = true;

                    self.courier_cost = shipping[0];
                    self.courier_service = shipping[1];
                    let total = document.getElementById('totalPay').value;
                    // console.log(total)
                    console.log(self.courier_cost)
                    let formatCost = new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 5
                    }).format(self.courier_cost);
                    document.getElementById('courier_cost').innerHTML = `Rp ${formatCost}`;
                    let totalPayment = parseInt(total) + parseInt(self.courier_cost);
                    let formatPayment = new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 6
                    }).format(totalPayment);
                    console.log("total " + totalPayment);
                    document.getElementById('totalPembayaran').innerHTML = `Rp ${formatPayment}`;

                    document.getElementById('totalPrice').value = totalPayment;
                },
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        });
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            console.log(response.data)
                            self.regencies = response.data;
                        });
                },
                // getDistrictsData() {
                //     var self = this;
                //     axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                //         .then(function(response) {
                //             self.districts = response.data;
                //         })
                // },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
                // regencies_id: function(val, oldVal) {
                //     this.districts_id = null;
                //     this.getDistrictsData();
                // }
            }
        });

    </script>
@endpush

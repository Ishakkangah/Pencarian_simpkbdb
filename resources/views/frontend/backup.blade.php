<div class="col-md-6 col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Social Media Traffic</h3>
        </div>
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th>Network</th>
                    <th colspan="2">Visitors</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Instagram</td>
                    <td>3,550</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Twitter</td>
                    <td>1,798</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Facebook</td>
                    <td>1,245</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>TikTok</td>
                    <td>986</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 19.72%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Pinterest</td>
                    <td>854</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 17.08%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>VK</td>
                    <td>650</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 13.0%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Pinterest</td>
                    <td>420</td>
                    <td class="w-50">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 8.4%"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-lg-12 mx-auto">
    <h2 class="page-title text-white mb-2 text-uppercase">
        Info Kendaraan <br>
        Nopol : ${nopol}
    </h2>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-bordered card-table">
                <thead>
                    <tr>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Nomor Polisi
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Nama
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 20rem">
                                Alamat
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Merek
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Type
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Jbb
                            </div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Tarif uji baru / pertama uji berkala / perpanjang, numpang uji</div>
                        </th>
                        <th>
                            <div class="text-wrap text-center fw-bold" style="width: 12rem">
                                Tarif teknisi termasuk bukt lulus
                        </th>
        </div>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-secondary text-nowrap text-center">${data.nouji}</td>
                <td class="text-secondary text-nowrap text-center">
                    ${data.nama}
                </td>
                <td class="text-secondary">
                    ${data.alamat}
                </td>
                <td class="text-secondary text-nowrap text-center">
                    ${data.merek}
                </td>
                <td class="text-secondary text-nowrap text-center">
                    ${data.tipe}
                </td>
                <td class="text-secondary text-nowrap text-center">
                    ${data.jbb}
                </td>
                <td class="text-secondary text-wrap text-center">
                    Rp.25000
                </td>
                <td class="text-secondary text-wrap text-center">
                    Rp. ${tarif_uji_baru}
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
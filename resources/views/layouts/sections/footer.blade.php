  <footer class="bg-dark text-light text-center py-4">
      <div class="container">
          <div class="row">
              <div class="col-lg-6">
                  <h3>Hubungi Kami</h3>
                  <p>Jika Anda memiliki pertanyaan atau komentar, jangan ragu untuk menghubungi kami.</p>
              </div>
              <div class="col-lg-6">
                  <h3>Support by</h3>
                  <a href="#" class="btn btn-outline-light mx-1">
                      <img src="{{ asset('img/polres.png') }}" alt="poto-polres" style="height: 20px;">
                  </a>
                  <a href="#" class="btn btn-outline-light mx-1" style="width: 63px;">
                      <img src="{{ asset('img/kominfo.png') }}" alt="poto-kominfo">
                      </i>
                  </a>
                  <a href="#" class="btn btn-outline-light mx-1">
                      <img src="{{ asset('img/bppd.png') }}" alt="poto-bppd" style="height: 20px;">
                  </a>
                  <ul class="text-start mt-4">
                      <h5></h5>
                      <li>Polres Ogan Komering Ilir</li>
                      <li>Badan pendapatan Daerah Ogan Komering Ilir</li>
                      <li>Dinas Komunikasi & Informatika Ogan Komering Ilir</li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>

  <!-- Libs JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('tabler.io/dist/libs/apexcharts/dist/apexcharts.min.js?1674944402') }}" defer></script>
  <script src="{{ asset('tabler.io/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1674944402') }}" defer></script>
  <!-- Tabler Core -->
  <script src="{{ asset('tabler.io/dist/js/tabler.min.js?1674944402') }}" defer></script>
  <script src="{{ asset('tabler.io/dist/js/demo.min.js?1674944402') }}" defer></script>
  @stack('my_script')
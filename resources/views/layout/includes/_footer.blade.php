    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area bg-img" style="background-image: url(./assets/user/img/bg-img/3.jpg);">

        <!-- Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <!-- Copywrite Text -->
                    <div class="col-12 col-md-6">
                        <div class="copywrite-text">
                            <p>&copy;
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                    <!-- Footer Nav -->
                    <div class="col-12 col-md-6">
                        <div class="footer-nav">
                            <nav>
                                <ul>
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('konsultasi')}}">Konsultasi Hama</a></li>
                                <li><a href="{{route('riwayat',Auth::user()->id)}}">Riwayat Konsultasi</a></li>
                                <li><a href="{{route('info_hama')}}">Informasi Hama</a></li>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->
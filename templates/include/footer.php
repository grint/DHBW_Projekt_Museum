    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3><?php echo ADDRESS ?></h3>
                        <p>DHBW Stuttgart<br>Rotebühlplatz 41<br>70173 Stuttgart</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3><?php echo IN_WEB ?></h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3><?php echo FOOTER_ABOUT ?></h3>
                        <p><?php echo ABOUT_TEXT_3 ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-left">
                        Copyright &copy; Virtuelles Museum 2015
                    </div>
                    <?php if($_SESSION) {?>
                        <div class="col-lg-6 text-right">
                            <a href="./admin.php">Admin</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>





    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-datepicker/locales/bootstrap-datepicker.de.min.js"></script>
    <script src="js/autosize.min.js"></script>
    <script src="js/fancybox/jquery.fancybox.pack.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/script.js"></script>

</body>

</html>

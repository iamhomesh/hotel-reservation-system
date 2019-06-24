
    <div class="clearfix"></div>
    <footer id="footer" class="text-center bg-light fixed-bottom" style="height: 70px; bottom: 0; width: 100%;">
        <div class="container">

            <div class="row mt-3 mt-lg-4">
                <div class="col-sm-6">
                    <span class="text-dark">Copyright &copy; 2019 <a href="#" class="text-dark font-weight-bold">Hotel Resevation System</a></span>
                </div>
                <div class="col-sm-6">
                    <span class="text-dark">Designed by <a href="" class="text-dark font-weight-bold">HOMESH KUMAR VERMA</a></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- /.site-footer -->

    <!--Bootstrap-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper-1.14.7.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <!-- <script src="../assets/MDB-Free_4.7.7/js/mdb.min.js"></script> -->

    <!-- <script src="assets/script/main.js"></script> -->

    <script>
        $('#room-type').change(function() {

            var id = $(this).children("option:selected").val();

            $.get('check_room_type.php?room-type=' + id, function(data) {
                $('#room-desc').html(data);


            });

        });
    </script>

</body>

</html>
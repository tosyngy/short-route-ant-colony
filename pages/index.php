<?php
?>
<?php
include "resource.php";
?>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">

                        
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">


                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="emailadd" type="emailadd" autofocus required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="dashboard.php" class="btn btn-lg btn-success btn-block">Login</a>-->
                                <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                                    <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                                </button>
                            </fieldset>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!--<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

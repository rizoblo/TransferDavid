<!-- Footer -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/styles.css')}}">

<!--<footer class="page-footer font-small bg-info" >

    <ul>
    </ul>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
    </div>


</footer>-->
<footer class="mt-5">
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-4 col-sm-6">
                    <h4 style="font-family: 'Franklin Gothic Medium'">TransferDavid</h4>
                    <img style="width: 25%;" src={{asset("images/favicon.png")}}>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3>Contacto</h3>
                    <ul>
                        <li>transferdavid@hotmail.com</li>
                        <br/>
                        <li>-Avenida de los campos Elíseos Nº54 </li>
                        <li>-Calle Royal Mile nº104 </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3>Sobre nosotros</h3>
                    <ul>
                        <li> <h5> <a href="{{url('/legalTerms')}}">Términos legales</a></h5></li>
                        <li> <h5> <a href="{{url('/privacity')}}">Política privacidad</a></h5></li>
                    </ul>
                </div>

                <!--/.row-->
            </div>
            <!--/.container-->
        </div>
        <!--/.footer-->

        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left copyright"> Copyright © TransferDavid 2020. All right reserved. </p>

            </div>
        </div>
        <!--/.footer-bottom-->

    </div>
</footer>
<!-- Footer -->
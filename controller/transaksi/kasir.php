<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $sub = substr($k['SalesDrugsCode'],-5);
    $sub2 = $sub + 1;
    $pad = str_pad($sub2,5,"0",STR_PAD_LEFT);
    $pad2 = str_pad($sub2,6,"0",STR_PAD_LEFT);
    $kode = date('ymd').' '.$pad.$pad2;
    $kode2 = date('ymd').' '.$pad;
    ?>
<div class="wrapper wrapper-content animated fadeIn">

<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Pasien Register</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Pasien Umum</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3"> Pasien</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-4">Cek Harga</a></li>
            </ul>
            <div class="tab-content">
                <!--pasien register-->
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">

                        <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                            existence in this spot, which was created for the bliss of souls like mine.</p>

                        <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                            the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                    </div>
                </div>

                <!--pasien umum-->
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body"> 
                            
                            
                            

                            
                            
                                    
                    </div>
                </div>

                <!--pasien-->
                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <strong>Donec quam felis</strong>

                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                    </div>
                </div>

                <!--cek harga-->
                <div role="tabpanel" id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <strong>Donec quam felis</strong>

                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

</div>
<?php
}
?>
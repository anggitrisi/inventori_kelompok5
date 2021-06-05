
<br>

<div class="col-xl-3 col-md-6" >
    <div class="card user-card-full">
        <div class="row m-l-0 m-r-0">
            <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
               
                    <div class="m-b-20"> <img src="<?php echo base_url('assets/pict/profil.jpg'); ?>" class="img-radius" alt="User-Profile-Image"> </div>
                    <h6 class="f-w-600"> <?= ($user['USER_NAME']); ?></h6>
                    <p><?= ($user['GROUP_NAME']); ?></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card-block">
                <div class="row">
                    <h6 class="m-b-50 p-b-5 b-b-default f-w-600">Buat Tanda Tangan
                    <a class="btn btn-info" data-toggle="modal" id="sbnt1" href="#sign-modal">
                            <span class=" icon text-white-50">
                            <i class="fa fa-pencil"></i>
                            </span>
                        </a>
                        </h6>
                </div>
                    <div class="row">
                    <p>Tanda Tangan</p>
                        <img src="<?php echo base_url($sig['img']); ?>" alt="" class="img-radius">             
                    </div>
                   
                </div>
            </div>
        </div>
    


<div class="modal fade" id="sign-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content" id="signature-pad">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-pencil"></i> Add Signature</h4>
        </div>
        
        
        <div class="modal-body" >
        <canvas width="570" height="318" ></canvas>
        <input type="hidden" id="USER_ID" name="USER_ID" value="<?php echo 1;?>">
                    </div>
                
        <div class="m-signature-pad-footer">

<button type="button"  id="save2" data-action="save" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
            <button type="button" data-action="clear" class="btn themecl2"><i class="fa fa-trash-o"></i> Clear</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button> 
        </div>
    </div>
    <!-- /.modal-content --> 
</div>
<!-- /.modal-dialog --> 
</div>

</div>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


<script>

            var wrapper = document.getElementById("signature-pad"),
            clearButton = wrapper.querySelector("[data-action=clear]"),
            saveButton = wrapper.querySelector("[data-action=save]"),
            canvas = wrapper.querySelector("canvas"),
            signaturePad;


            function resizeCanvas($id) {

            var ratio =  window.devicePixelRatio || 1;
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            }
            signaturePad = new SignaturePad(canvas);

            clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
            });
            saveButton.addEventListener("click", function (event) {

            if (signaturePad.isEmpty()) {
            $('#myModal').modal('show');
            }

            else {
               
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Pengaturan/insert_single_signature",
            data: {'image': signaturePad.toDataURL(),'USER_ID':$('#USER_ID').val()},
            success: function(datas1)
            {            
            signaturePad.clear();
            $('.previewsign').html(datas1);
            }
            });
            }
            }); 

</script>






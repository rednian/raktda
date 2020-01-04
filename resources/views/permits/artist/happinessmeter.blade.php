@extends('layouts.app')

@section('content')


<div class="row">

    <div class="col-xl-12 order-lg-2 order-xl-1">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-transform-u">
                        {{__('Happiness Meter')}}
                    </h3>
                </div>


            </div>
            <div class="kt-portlet__body kt-padding-t-0">

                <!--begin: Form Wizard Step 5-->
                <div class="kt-wizard-v3__content py-5" data-ktwizard-type="step-content">

                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__review">
                            <form id="happiness_center" autocomplete="off" novalidate>
                                <div class="d-flex justify-content-around happiness--center">
                                    <input type="hidden" id="sel_value">
                                    <div id="sad" style="cursor:pointer" onclick="makeSelected(this.id,0)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/sad.svg" alt="" id="sad_btn"> -->
                                        <?php echo file_get_contents('./img/sad.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <div id="notbad" style="cursor:pointer" onclick="makeSelected(this.id, 50)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/notbad.svg" alt="" id="notbad_btn"> -->
                                        <?php echo file_get_contents('./img/notbad.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <div id="happy" style="cursor:pointer" onclick="makeSelected(this.id, 100)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/happiness.svg" alt="" id="happy_btn"> -->
                                        <?php echo file_get_contents('./img/happiness.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <input type="hidden" id="permit_id" value={{$id}}>
                                </div>
                                <div>
                                    <label for="" class="kt-margin-t-20 kt-font-dark">{{__('Comments')}} :</label>
                                    <textarea name="remarks" id="remarks" class="form-control form-control-sm " rows="5"
                                        placeholder="{{__('please enter your valueable comments')}}"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Step 5-->

                <div class="d-flex justify-content-end">
                    <div class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn">
                        <i class="la la-check"></i>
                        {{__('Submit')}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('script')
<script>
    var happinessValidator =   $('#happiness_center').validate({
                rules: {
                    remarks: 'required'
                },
                messages: {
                    remarks: '',
                }
            });
   
            
    $('#submit_btn').click((e) => {

                var value =  $('#sel_value').val();

                if(value)
                {
                    if(happinessValidator.form())
                    {
                        $.ajax({
                            url: "{{route('artist.submit_happiness')}}",
                            type: "POST",
                            data: {
                                permit_id:$('#permit_id').val(),
                                happiness: value,
                                remarks: $('#remarks').val()
                            },
                            beforeSend: function() {
                                KTApp.blockPage({
                                    overlayColor: '#000000',
                                    type: 'v2',
                                    state: 'success',   
                                    message: 'Please wait...'
                                });
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    window.location.replace = "{{route('artist.index')}}#valid";
                                    KTApp.unblockPage();
                                }
                            }
                        });
                    }
                    
                } else {
                    alert('Please select your experience');
                }


        });

    function makeSelected(id, value) {
			// console.log(id);
			if (id == 'happy') {
				$('#happy svg path').attr('fill', '#80262b');
				$('#notbad svg path').attr('fill', '#EA9400');
				$('#sad svg path').attr('fill', '#EA9400');
			} else if (id == 'notbad') {
				$('#notbad svg path').attr('fill', '#80262b');
				$('#happy svg path').attr('fill', '#EA9400');
				$('#sad svg path').attr('fill', '#EA9400');
			} else if (id == 'sad') {
				$('#sad svg path').attr('fill', '#80262b');
				$('#happy svg path').attr('fill', '#EA9400');
				$('#notbad svg path').attr('fill', '#EA9400');
			}
            $('#sel_value').val(value);
			/*Swal.fire({
				title: 'Great!',
				text: "Thank you for the feedback!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.value) {
					window.location.href = "{{route('artist.index')}}#valid";
				}
			})*/
		}



</script>

@endsection
@extends('layouts.app')

@section('title', 'Happiness Meter Artist Permit - Smart Government Rak')
@section('style')
<style>
    ::placeholder {
        font-style: italic;
    }
</style>
@endsection
@section('content')


<div class="row">

    <div class="col-xl-12 order-lg-2 order-xl-1">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-transform-u">
                        {{__('HAPPINESS METER')}}
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
                                    <div id="sad" style="cursor:pointer" onclick="makeSelected(this.id,0)" title="{{__('Dissatisfied')}}">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/sad.svg" alt="" id="sad_btn"> -->
                                        <?php echo file_get_contents('./img/sad.svg'); ?>
                                        <!--</a> -->
                                    </div> 
                                    <div id="notbad" style="cursor:pointer" onclick="makeSelected(this.id, 50)" title="{{__('Neutral')}}">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/notbad.svg" alt="" id="notbad_btn"> -->
                                        <?php echo file_get_contents('./img/notbad.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <div id="happy" style="cursor:pointer" onclick="makeSelected(this.id, 100)"  title="{{__('Satisfied')}}">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/happiness.svg" alt="" id="happy_btn"> -->
                                        <?php echo file_get_contents('./img/happiness.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <input type="hidden" id="permit_id" value={{$id}}>
                                </div>
                                <div
                                    class="form-group row form-group-marginless kt-margin-t-40 kt-margin-l-auto kt-margin-r-auto">
                                    <label for=""
                                        class="kt-font-dark col-md-3 col-lg-3 col-form-label text-right">{{__('Your opinion matters')}}
                                        :</label>
                                    <div class="col-md-8">
                                        <textarea name="remarks" id="remarks" class="form-control form-control-sm "
                                            rows="5"
                                            placeholder="{{__('please enter your valuable comments')}}"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Step 5-->

                <div class="d-flex justify-content-end">
                    <div class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn">
                        <i class="la la-check"></i>
                        {{__('SUBMIT')}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('script')
<script>
    $('#submit_btn').click((e) => {

                var value =  $('#sel_value').val();

                if(value)
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
                                    message: '{{__("Please wait...")}}'
                                });
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    window.location.href =result.toURL;
                                    KTApp.unblockPage();
                                }
                            }
                        });
                    
                    
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
@extends('layouts.app')

@section('content')


<div class="row">

    <div class="col-xl-12 order-lg-2 order-xl-1">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand la la-smile-o la-2x"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Happiness Meter
                    </h3>
                </div>


            </div>
            <div class="kt-portlet__body">

                <!--begin: Form Wizard Step 5-->
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__review">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="d-flex justify-content-around happiness--center">
                                    <div id="happy" style="cursor:pointer" onclick="makeSelected(this.id)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/happiness.svg" alt="" id="happy_btn"> -->
                                        <?php echo file_get_contents('./img/happiness.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <div id="notbad" style="cursor:pointer" onclick="makeSelected(this.id)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/notbad.svg" alt="" id="notbad_btn"> -->
                                        <?php echo file_get_contents('./img/notbad.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <div id="sad" style="cursor:pointer" onclick="makeSelected(this.id)">
                                        <!--<a href="/company/artist_permits"> -->
                                        <!-- <img src="./assets/img/sad.svg" alt="" id="sad_btn"> -->
                                        <?php echo file_get_contents('./img/sad.svg'); ?>
                                        <!--</a> -->
                                    </div>
                                    <input type="hidden" id="artist_permit_id" value={{$id}}>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Step 5-->
            </div>
        </div>
    </div>

</div>



@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $('#happy_btn').click(function(){
        rating = 'happy';
        sendRating();
    })
    $('#notbad_btn').click(function(){
        rating = 'notbad';
        sendRating();
    })
    $('#sad_btn').click( function(){
        rating = 'sad';
        sendRating();
    })

    function makeSelected(id) {
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
			Swal.fire({
				title: 'Great!',
				text: "Thank you for the feedback!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.value) {
					window.location.href = '../artist_permits';
				}
			})
		}



</script>

@endsection

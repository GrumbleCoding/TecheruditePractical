<div class="modal fade register-modal log_delet_modal" id="logOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content p-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <div class="modal-body">
              <span class="other_content_modal">Are you sure you want to <br /> logout?</span>
              <form method="post" action="{{ route('user_logout') }}"> 
                @csrf
                  <button type="submit" class="modal_btn_other w-100" style="border:none;">Yes</button>
              </form> 
            </div>
          </div>
    </div>
</div>
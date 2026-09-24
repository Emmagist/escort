<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Book Escort</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        <form action="" class="form-group">
          <input type="text" class="form-control mb-3">
          <input type="text" class="form-control mb-3">
          <input type="text" class="form-control mb-3">
          <input type="text" class="form-control mb-3">
          <input type="text" class="form-control mb-3">
          <input type="text" class="form-control mb-3">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Book Escort</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal view request -->
<div class="modal fade" id="view-request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Service Requested</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body-view">
      </div>
    </div>
  </div>
</div>

<!-- SUscribe -->
<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Subscribe For Premium</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view_task_modal">
        <form action="" method="post" class="form-group" id="subscribe_contents"></form>
      </div>
    </div>
  </div>
</div>

<!-- View task -->
<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view_task_modal_body"></div>
    </div>
  </div>
</div>

<!-- Edit task -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <li class="alert alert-success list-unstyled text-center text-capitalize" style="display: none;"></li>
        <form action="" method="post" id="edit_task_modal_body"></form>
      </div>
    </div>
  </div>
</div>

<!-- View order -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Order</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view_order_modal_body"></div>
    </div>
  </div>
</div>

<!-- Edit order -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Order</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <li class="alert alert-success list-unstyled text-center text-capitalize" style="display: none;"></li>
        <form action="" method="post" id="edit_order_modal_body"></form>
      </div>
    </div>
  </div>
</div>

<!-- Go Live -->
<div class="modal fade" id="golive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Stream</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <li class="alert alert-success list-unstyled text-center text-capitalize" id="alert-success"></li>
        <li class="alert alert-danger list-unstyled text-center text-capitalize" id="alert-danger"></li>
        <!-- <form action="" method="post" id="golive_modal_form"> -->
          <label for="stream_title">Stream Title <span class="text-danger">*</span></label>
          <input type="text" class="form-control mb-3" id="stream_title" placeholder="Enter Your Stream Title">
          <div class="modal-footer">
            <button type="button" class="btn" style="background: #ff315c;color:#fff;" id="golive_button">Go Live</button>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
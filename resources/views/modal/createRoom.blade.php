<!-- 모달 -->
<form action="{{ route('room.store') }}" method="post" enctype="multipart/form-data">
  @csrf
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">방 만들기2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">방 제목:</label>
              <input type="text" class="form-control" id="recipient-name" name="title">
            </div>
  
            <!-- <div class="form-group">
              <label for="recipient-name" class="col-form-label">비밀번호:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
  
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">플레이어 수:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
  
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">게임 유형:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
  
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">라운드 수:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div> -->
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit"
          >확인2</button>
        </div>
      </div>
    </div>
  </div>
</form>
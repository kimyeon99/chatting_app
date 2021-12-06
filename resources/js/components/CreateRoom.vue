<template>
<div>
    <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 
    border-b-4 border-blue-700 hover:border-blue-500 rounded"
    @click="createModal">                
        방만들기Vue
    </button>



<!-- 모달 -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">방 만들기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">방 제목:</label>
            <input v-model="title" type="text" class="form-control" id="recipient-name" name="text">
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
        <button @click="createRoom" type="button" class="btn btn-primary"
        >확인</button>
      </div>
    </div>
  </div>
</div>


</div>

</template>

<script>
import TheRoom from './Room';
export default {
  data(){
    return {
      title:""
    }
  },
  methods: {
      createModal(){
          //this.form.reset();
        $("#modal").modal("show"); // modal.("hide")
      },
      closeModal(){
        $("#modal").modal("hide"); 
      },
      goRoom(roomId) {
        this.$store.commit('get_RoomId', roomId);
      },
      createRoom() {
        //   axios.post('/room').then((res) => res.data) 룸 정보를 등록하고 
        // then에 도착하면 등록이 끝난건데 그때까지 loading해줘야함 
        // 서버에서는 등록하고 나서 response 를 번호는 줘야됨 무조건 
          axios.post('/room/store', {
            'title': this.title,          
            }).then(res => {
                        //push: 끝에 추가
                        this.closeModal();
                        this.goRoom(res.data.id);
                        this.$router.push({name:'TheRoom', params: {'roomId':res.data.id, room:res.data}});
                    }).catch(error => {
              console.log(error);
        });
      },
      

    }
}
</script>

<style>

</style>
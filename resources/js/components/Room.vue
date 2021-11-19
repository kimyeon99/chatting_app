<template>

<div>
    <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 
    border-b-4 border-blue-700 hover:border-blue-500 rounded"
    @click="createModal">                
        방만들기
    </button>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    


</div>

</template>

<script>
export default {
  methods: {
      createModal(){
          $("#create-modal").modal("show")
      },
    }
}
</script>

<style>

</style>
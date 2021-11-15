<template>
<!-- component -->
<div class="my-5 w-screen ">
  <div class=" flex justify-start items-center">
    <div class="ml-4 bg-white w-full sm:max-w-7xl md:w-2/3 h-auto shadow px-3 py-2 flex flex-col space-y-2">

      <div class="flex items-center space-x-2">

        <div class="flex items-center justify-center space-x-2">
          <div class="block">
              <div class="flex justify-center items-center space-x-2">
                <div class=" rounded-xl px-2 pb-2">
                <div class="font-medium">
                    <a href="#" class="hover:underline text-sm">
                    <small>{{ comment.user.name }}</small>
                    </a>
                </div>
                <input v-model="newComment"
                        :readonly = "!updateClicked"
                        class="shadow text-xs"
                        type="text">
                <small
                    v-show="updateClicked"
                    @click="updateComment"
                    class="px-2 hover:bg-blue-400">save</small>

                </div>
                <div class="self-stretch flex justify-center items-center transform transition-opacity duration-200 opacity-0 hover:opacity-100">
                    <a href="#" class="">
                        <div class="text-xs cursor-pointer flex h-6 w-6 transform transition-colors duration-200 hover:bg-gray-100 rounded-full items-center justify-center">
                        <svg class="w-4 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                        </div>

                    </a>
                </div>
              </div>
            <div class="flex justify-start items-center text-xs w-full">
              <div class="font-semibold text-gray-700 px-2 flex items-center justify-center space-x-1">

                <small v-if="comment.user_id==login_user_id" @click="enableComment" class="px-2 hover:bg-blue-400">Update</small>
               <small class="self-center">.</small>


                  <small v-if="comment.user_id==login_user_id" @click="deleteComment" class="px-2 hover:bg-blue-400">Delete</small>

               <small class="self-center">.</small>
                <a href="#" class="hover:underline">
                  <small>15 hour</small>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- New Comment Paste Here -->

    </div>

  </div>
</div>
</template>

<script>
export default {
    props: ['comment', 'login_user_id'],
    data(){
        return{
            newComment:'',
            updateClicked:false,
        }
    },
    created(){
        this.newComment = this.comment.comment;
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: '작성완료!',
                showConfirmButton: false,
                timer: 1500})
    },
    methods : {
        deleteComment() {
            if (confirm( 'Are you sure you want to delete?')){
                axios.delete('/comments/'+this.comment.id).then(response=>{
                    // console.log(response.data);
                    // this.$emit('deleted');
                    this.$parent.getComment();
                    alert('삭제됨!')

                }).catch(error=>{
                    alert('delete failed : ' + error);
                });
            }
        },

        enableComment(){
            this.updateClicked = true;
        },
        updateComment() {
            alert('테스트용..')
            // $('#comment'+this.comment.id).attr('readonly',false);
            axios.patch('/comments/'+this.comment.id, {'comment' : this.newComment})
            .then(response => {
                console.log(response.status)
                console.log(response.data)
                this.updateClicked = false;
                alert('수정했지')
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: '수정완료!',
                showConfirmButton: false,
                timer: 1500})
            })
            .catch(res => {
                console.log(error)
                alert('하나라도 쓰세요 제발')
            })
        }
    },
}
</script>



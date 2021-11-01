
<template>
    <!-- <div>
        <button @click="getComments" class="btn btn-default">댓글 불러오기</button>
        <comment-item v-for="(comment, index) in comments"
                    :key="index" :comment="comment"/>

    </div> -->
    <div @click="update">
                <button @click="getComments" class="btn btn-default">댓글 불러오기</button>
        <comment-item v-for="(comment, index) in comments"
                    :key="index" :comment="comment"/>

    </div>
</template>


<script>
import CommentItem from './CommentItem.vue'
export default {
    props: ['post', 'loginUserId'],
    components: {CommentItem},
    data() {
        return {
            comments : [],
        }
    },
    methods: {
        getComments() {
            // this.comments=['1st comment', '2nd comment',
            // '3rd commnet', '4th comment', '5th comment', ];
            //서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청
            //즉, axios를 이용해서 요청
            // 서버가 댓글 리스트를 주면 ㄱ?ㅒ를 어디에 할당할래?
            //this.comments에 할당한다는 것이지.
            axios.get('/comments/'+this.post.id).then(response=>{
                // console.log(response);
                this.comments = response.data;
            }).catch(error=>{
                console.log(error);
            });
        },
        update() {
            axois.patch('/comments/'+this.comment.id, {
                'comments':this.comment.comment
            }).then(response=> {
                this.comment = response.data
            }).catch();
        },
        delete() {
            axois.delete('/comments/'+this.comment.id)
                .then(response=>{
                    // comments 다시 읽어오면 되겠네 ...
                    // 부모에게 알려드려야 되겠네 ...
                });

        }
    }
}
</script>

<template>
    <div>
        <button @click="getComments" class="btn btn-primary">댓글 불러오기</button><br>
        <comment-item v-for="(comment, index) in comments" :key="index" :comment="comment" />

    </div>
</template>

<script>
import CommentItem from './CommentItem.vue';

export default {
    props: ['post', 'loginUserId'],
    components: {CommentItem},
    data() {
        return {
            commets : [],
        }
    },

    methods: {
        getComments() {
            this.comments =['1st comment', '2nd comment', '3rd comment', '4th comment', '5th comment'];
        }
    }

}
</script>

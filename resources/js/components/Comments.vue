<template>

    <div class="comments-app">
        <div class="comment-form">

            <form class="form" name="form" style="width: 100%">
                <div class="form-row">
                    <textarea style="border: 1px solid #bfbfbf;height: 150px" class="input"
                              placeholder="لطفا نظر خود را وارد کنید" required v-model="message">
                    </textarea>
                    <span class="input" v-if="allerros.body" style="color:red">{{allerros.body[0]}}</span>
                </div>

                <input style="display: block;float: left;margin-top:5px" type="button" class="btn btn-primary "
                       @click="saveComment" value="ارسال">
            </form>
        </div>
        <br><br>
        <hr>
        <div class="comments" v-for="(comment,index) in commentsData">
            <div class="comment">
                <div class="comment-box" style="border:1px solid #a0a0a0;margin-bottom:10px;padding-bottom:25px">
                    <div class="comment-text">{{comment.comment}}</div>
                    <div class="comment-footer" style="text-align: right">

                        <span class="comment-author" style="display: inline-block">
                                <em>{{ comment.name}}</em>
                            </span>
                        <span class="comment-date">{{ comment.date}}</span>
                    </div>
                    <br/>
                    <a class="btn btn-danger btn-sm" style="color: white;float:left"
                       @click="deleteComment(comment.commentid,index)">حذف
                    </a>
                    <a @click="openComment(index)" class="btn btn-success btn-sm"
                       style="color: white;float:left;margin-left: 10px">پاسخ</a>
                    <br/>
                </div>

                <div class="comment-form comment-v" v-if="commentBoxs[index]">
                    <form class="form" name="form">
                        <div class="form-row">
                            <textarea class="input" placeholder="لطفا پاسخ خود را وارد کنید" required v-model="message"
                                      style="width: 585px;border: 1px solid #c7c7c7;height: 150px;margin-right: 15px"></textarea>
                            <span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
                        </div>

                        <input type="button" class="btn btn-danger" style="display:block;float: left;margin-left:39px"
                               v-on:click="replyComment(comment.commentid,index)" value="ارسال">
                        <br/> <br/>
                    </form>
                </div>

                <div v-if="comment.replies">
                    <div class="comments" v-for="(replies,index2) in comment.replies" style="margin-right:25px">
                        <div class="comment reply">
                            <div class="comment-box" style="border:1px solid #cfcfcf;width: 599px;">
                                <div class="comment-text" style="color: #868686">{{replies.comment}}</div>
                                <div class="comment-footer" style="text-align: right">

                                    <span class="comment-author" style="display: inline-block">
                                            {{replies.name}}
                                        </span>
                                    <span class="comment-date" style="display: inline-block;direction: rtl">{{replies.date}}</span>
                                    <a class="btn btn-danger btn-sm" style="color: white;float:left"
                                       @click="deleteReply(replies.commentid,index)">حذف
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['article'],
        data() {
            return {
                commentsData: [],
                allerros: [],
                commentBoxs: [],
                message: null,

                errorReply: null,
                user: window.user
            }
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': window.csrf
            }
        },
        methods: {
            deleteReply(id, index) {
                axios.delete(`/comments/${id}`)
                    .then(() => {
                        this.commentsData[index].replies = "";
                        // console.log(this.commentsData[index].replies);
                    })
            },

            deleteComment(id, index) {
                swal.fire({
                    text: "آیا از پاک کردن اطمینان دارید ؟",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'بله',
                    cancelButtonText: 'لغو',
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`/comments/${id}`)
                            .then(() => {
                                this.commentsData.splice(index, 1);
                                swal.fire(
                                    {
                                        text: "نظر شما با موفقیت حذف شد !",
                                        type: "success",
                                        confirmButtonText: 'باشه',
                                    }
                                )
                            }).catch(() => {
                            swal.fire(
                                {
                                    text: "درخواست شما لغو شد !",
                                    type: "success",
                                    confirmButtonText: 'باشه',
                                }
                            )
                        });
                    }
                });

            },
            fetchComments() {
                this.$Progress.start();
                axios.get('/comments/' + this.article).then(res => {

                    this.commentsData = res.data;

                });
                this.$Progress.finish();
            },
            openComment(index) {
                if (this.commentBoxs[index]) {
                    Vue.set(this.commentBoxs, index, 0);
                } else {
                    Vue.set(this.commentBoxs, index, 1);
                }
            },
            saveComment() {
                this.errorComment = null;
                this.$Progress.start();
                axios.post('/comments', {
                    commentable_id: this.article,
                    body: this.message,
                    user_id: this.user.id
                }).then(res => {
                    if (res.data.status) {
                        this.commentsData.push({
                            "commentid": res.data.commentId,
                            "name": this.user.name,
                            "comment": this.message,
                            "date": res.data.date,
                            "replies": []
                        });
                        this.message = null;
                        swal.fire(
                            {
                                text: "نظر شما با موفقیت ثبت شد !",
                                type: "success",
                                confirmButtonText: 'باشه',
                            }
                        )
                    }
                }).catch((error) => {
                    this.allerros = error.response.data.errors;
                });
                this.$Progress.finish();
            },
            replyComment(commentId, index) {
                if (this.message != null) {
                    this.errorReply = null;

                    axios.post('/comments', {
                        body: this.message,
                        user_id: this.user.id,
                        parent_id: commentId
                    }).then(res => {
                        if (res.data.status) {

                            this.commentsData[index].replies.push({
                                "commentid": res.data.commentId,
                                "name": this.user.name,
                                "comment": this.message,
                            });
                            Vue.set(this.commentBoxs, index, 0);
                            this.message = null;
                        }
                    });

                } else {
                    this.errorReply = "Please enter a comment to save";
                }
            }
        },
        mounted() {
            this.$Progress.start();
            this.fetchComments();
            this.$Progress.finish();
            Echo.private('comment.' + this.article)
                .listen('NewComment', (comment) => {
                    this.commentsData.unshift(comment);
                });
        }
    }
</script>




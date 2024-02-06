import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "NewsDetails",
  data() {
    return {
      postId: 0,
      posts: {},
      viewCount: 0,
    };
  },
  computed: {
    ...mapGetters(['storageToken','storageUserData']),
  },
  methods: {
    loadPost(id) {
      let post = {
        postId: id,
      };
      axios
        .post("http://localhost:8000/api/post/details", post)
        .then((response) => {
          // console.log(response.data.posts);
          if (response.data.post.image != null) {
            response.data.post.image =
              "http://localhost:8000/postImage/" + response.data.post.image;
          } else {
            response.data.post.image =
              "http://localhost:8000/defaultImage/Screenshot (176).png";
          }

          this.posts = response.data.post;
        });
      // console.log(this.posts);
    },
    homePage() {
      // console.log('hit')
      this.$router.push({
        name: "home",
      });
    },
    back() {
      history.back();
    },
    login() {
      this.$router.push({
        name: "login",
      });
    },
  },

  mounted() {

    let data ={
      user_id: this.storageUserData.id,
      post_id: this.$route.query.newsId,
    };
    axios
    .post("http://localhost:8000/api/post/actionLog",data)
    .then((response ) => {
      // console.log(response.data);
      this.viewCount = response.data.post.length
    });
    // console.log(this.storageUserData.id);
    // console.log(this.$route.query.newsId);
    this.postId = this.$route.query.newsId;
    this.loadPost(this.postId);
  },
};

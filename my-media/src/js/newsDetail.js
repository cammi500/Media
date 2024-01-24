import axios from "axios";
export default {
  name: "NewsDetails",
  data() {
    return {
      postId: 0,
      posts: {},
    };
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
    // console.log(this.$route.query.newsId);
    this.postId = this.$route.query.newsId;
    this.loadPost(this.postId);
  },
};

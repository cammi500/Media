import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "loginPage",
  data() {
    return {
      userData: {
        email: "",
        password: "",
        
      },
      tokenStatus :false,
      userStatus :false,
    };
  },
  computed: {
    ...mapGetters(['storageToken','storageUserData']),
  },
  methods: {
    login() {
      this.$router.push({
        name: "login",
      });
    },
    homePage(){
      // console.log('hit')
      this.$router.push({
        name: "home",
      });
    },
    accLogin() {
      // console.log(this.userData)
      axios
        .post("http://localhost:8000/api/user/login", this.userData)
        .then((response) => {
          // console.log(response.data.token);
          if (response.data.token == null) {
            this.userStatus=true;
          } else {
            // console.log('login success');
            this.userStatus=false;
            this.storeUserInfo(response);
            // console.log("token successfully");
            this.homePage();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
      storeUserInfo(response) {
        this.$store.dispatch("setToken", response.data.token);
         this.$store.dispatch("setUserData", response.data.user);
            // console.log('token successfully set');
      },
    // check() {
    //   console.log(this.storageToken);
    //   console.log(this.storageUserData);
    // },
  },

  // mounted () {
  //   console.log(this.storageToken);
  //   // this.checkToken();
  //   this.getAllPost();
  //   this.getCategory();
  //   },
};

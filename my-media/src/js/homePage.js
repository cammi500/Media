import axios from "axios";
import { mapGetters } from "vuex";

    export default {
      name :'HomePage',
      data() {
        return {
        postLists : {},
        categoryLists : {},
        searchKey :"",
        tokenStatus :false
        };
      },
      computed: {
        ...mapGetters(['storageToken','storageUserData']),
      },
      methods: {
        getAllPost() {
            axios.get('http://localhost:8000/api/getAllList').then((response) =>{
            // this.postLists = response.data;
            // console.log(this.postLists);
            // console.log(response.data);
            for(let i=0 ; i < response.data.post.length; i++) {

              if(response.data.post[i].image != null){
                response.data.post[i].image = 
                'http://localhost:8000/postImage/' + response.data.post[i].image
              }else{
                response.data.post[i].image = 
                'http://localhost:8000/defaultImage/Screenshot (176).png';
              }
             }
             this.postLists=response.data.post;
        })
        .catch((error) =>{
          console.log(error);
        });
      },

      getCategory() {
        axios.get('http://localhost:8000/api/getAllCategory').then((response)=>{
          this.categoryLists = response.data.category;
          console.log(this.categoryLists);
        })
        .catch((error) =>{
          console.log(error);
        });
      },
      search() {
        // console.log(this.searchKey);
        //axios.post method searh yein object par
        let search = {
          key: this.searchKey,
        };
        axios.post('http://localhost:8000/api/post/search', search).then((response) => {
          // console.log(response.data.searchData);
            for(let i=0 ; i < response.data.searchData.length; i++) {
              if(response.data.searchData[i].image != null){
                response.data.searchData[i].image = 
                'http://localhost:8000/postImage/' + response.data.searchData[i].image;
              }else{
                response.data.searchData[i].image = 
                'http://localhost:8000/defaultImage/Screenshot (176).png';
              }
             }
             this.postLists =response.data.searchData;
          });
      },

      newsDetails(id){
        // console.log(id);
        this.$router.push({
          name: "newsDetails",
          query: {
            newsId: id,
          },       
        });
      },
      homePage(){
        // console.log('hit')
        this.$router.push({
          name: "home",
        });
      },
      login(){
        this.$router.push({
            name:'login'
        })
    },
      categorySearch(searchKey) {
        let search  = {
          key: searchKey,
        };
        axios.post('http://localhost:8000/api/category/search',search).then((response) => {
          for(let i=0 ; i < response.data.result.length; i++) {
            if(response.data.result[i].image != null){
              response.data.result[i].image = 
              'http://localhost:8000/postImage/' + response.data.result[i].image;
            }else{
              response.data.result[i].image = 
              'http://localhost:8000/defaultImage/Screenshot (176).png';
            }
           }
           this.postLists =response.data.result;
          // console.log(response.data.result);
        })
        .catch((error) => console.log(error));
      },
      logout(){
        this.$store.dispatch("setToken", null);
        this.login();
      },
      checkToken(){
        if(this.storageToken != null && 
          this.storageToken != undefined &&
          this.storageToken != "")
          {
            this.tokenStatus =true;
          }else {
            this.tokenStatus =false;
          }
      }
    },

      mounted () {
        console.log(this.storageToken);
        this.checkToken();
        this.getAllPost();
        this.getCategory();
        },
      };
    

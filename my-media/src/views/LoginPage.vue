<template>
    <div>
        <main>
            <div class="d-flex justify-content-center py-3">
                <!-- <p class="btn btn-danger text-white btn-sm mr-4" @click="homePage()" >Home</p>
                <p class="btn btn-dark text-white btn-sm mr-4" @click="login()" v-if="!tokenStatus">Login</p>
                <p class="btn btn-dark text-white btn-sm mr-4" @click="logout()" v-if="tokenStatus">Logout</p> -->
                <p class="btn btn-danger text-white btn-sm mr-4" 
                @click="homePage()">
                  Home
                </p>
                <p
                  class="btn btn-dark text-white btn-sm mr-4"
                  @click="login()"
                  v-if="!tokenStatus"
                >
                  Login
                </p>
                <p
                  class="btn btn-dark text-white btn-sm mr-4"
                  @click="logout()"
                  v-if="tokenStatus"
                >
                  Logout
                </p>
              </div>

              <div class=" container col-5 shadow-sm p-5 my-5">
                <div class="alert alert-danger" role="alert" v-if="userStatus">
                  the Crederial do not match
                </div>
                <form>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="userData.email">
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" v-model="userData.password">
                    </div>
                    
                    <button type="button" class="btn btn-primary" @click="accLogin()">Login</button>
                    <!-- <button @click="check()">Check token button</button> -->
                  </form>
              </div>
        </main>
        </div>
    </template>

    <script src="../js/loginPage.js"></script>


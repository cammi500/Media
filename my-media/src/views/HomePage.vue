<template>
  <div>
    <main>
      <div class="d-flex justify-content-center py-3">
        <p class="btn btn-danger text-white btn-sm mr-4" @click="homePage()">
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
      <!-- Whats New Start -->
      <section class="whats-news-area pt-50 pb-20">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="row d-flex justify-content-between">
                <div class="col-lg-3 col-md-3">
                  <div class="section-tittle mb-30">
                    <h3>Whats New</h3>
                  </div>
                </div>
                <div class="col-lg-9 col-md-9">
                  <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a
                          class="nav-item nav-link active"
                          id="nav-home-tab"
                          data-toggle="tab"
                          href="details.htmlnav-home"
                          role="tab"
                          aria-controls="nav-home"
                          aria-selected="true"
                          @click="categorySearch('')"
                          >All</a
                        >

                        <a
                          class="nav-item nav-link"
                          id="nav-contact-tab"
                          data-toggle="tab"
                          href="details.htmlnav-contact"
                          role="tab"
                          aria-controls="nav-contact"
                          aria-selected="false"
                          v-for="(category, index) in categoryLists"
                          :key="index"
                          @click="categorySearch(category.title)"
                          >{{ category.title }}</a
                        >
                      </div>
                    </nav>
                    <!--End Nav Button  -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="d-flex justify-content-end mb-2">
                    <input
                      type="text"
                      class="form-control col-3"
                      v-model="searchKey"
                      v-on:keyup.enter="search()"
                    />
                    <i
                      class="fa-solid fa-magnifying-glass mt-2 ml-3"
                      style="font-size: 25px"
                      @click="search()"
                    ></i>
                  </div>
                  <!-- Nav Card -->
                  <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div
                      class="tab-pane fade show active"
                      id="nav-home"
                      role="tabpanel"
                      aria-labelledby="nav-home-tab"
                    >
                      <div class="whats-news-caption">
                        <span  v-if="!tokenStatus"
                        class="text-white d-flex justify-content-center my-5 bg-danger rounded p-3 h3"
                        >no data</span>
                        <span v-else>
                          <div class="row">
                            
                              <div
                                class="mx-auto mt-5 d-flex align-items-center"
                                v-if="postLists.length == 0"
                                style="height: 300px"
                              >
                                <h1 class="text-danger">There is no data</h1>
                              </div>
                              <div
                                class="col-lg-6 col-md-6"
                                v-else-if="postLists.length != 0"
                                v-for="(post, index) in postLists"
                                :key="index"
                              >
                                <div
                                  class="single-what-news mb-100"
                                  @click="newsDetails(post.post_id)"
                                >
                                  <div class="what-img">
                                    <img v-bind:src="post.image" alt="" />
                                  </div>
                                  <div class="what-cap">
                                    <span class="color1">Night party</span>
                                    <h4>
                                      <a href="details.html">{{
                                        post.title
                                      }}</a>
                                    </h4>
                                  </div>
                                </div>
                              </div>
                            
                          </div>
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- End Nav Card -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Whats New End -->

      <!--Start pagination -->
      <div class="pagination-area pb-45 text-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="single-wrap d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-start">
                    <li class="page-item">
                      <a class="page-link" href="details.html"
                        ><span class="flaticon-arrow roted"></span
                      ></a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="details.html">01</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="details.html">02</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="details.html">03</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="details.html"
                        ><span class="flaticon-arrow right-arrow"></span
                      ></a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End pagination  -->
    </main>
  </div>
</template>
<script src="../js/homePage.js"></script>

../js/HomePage.js../js/homePage.js

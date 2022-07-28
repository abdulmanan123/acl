<x-app-layout>
    <!--<header>
        <div class="header-search-form">
            <div class="container">
                <h1>Please search your registered college(s) here</h1>
                <form>
                    <div class="row">
                        <div class="col-md col-sm-12">
                            <label  class="form-label">District</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md col-sm-12">
                            <label  class="form-label">Tehsil</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md col-sm-12">
                            <label class="form-label">Registration No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md col-sm-12">
                            <label class="form-label">Owner CNIC</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md col-sm-12">
                            <label class="form-label">Own Mobile No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-12">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-5">
                    <img src="img/graphic-img2.png">
                </div>
                <div class="graphic-img1">
                    <img src="img/graphic-img1.png">
                </div>
                <div class="graphic-img3">
                    <img src="img/graphic-img3.png">
                </div>
            </div>
        </div>
    </header>-->


    <!-- Stages -->
    <section class="stages">
        <div class="container">
            <div class="row">
                <div class="col-md col-sm-12">
                    <div class="stage-item">
                        <img src="img/stage-img1.png" class="img-fluid">
                        <h2 class="mt-3">Stage 1 - (DEAs)</h2>
                        <h3 class="mt-1">Online Data-Entry of Registered Private Colleges in Punjab</h3>
                        <i class="fa fa-check-circle"></i>
                        <p>DEAs have uploaded private colleges Registration Information available with them</p>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="stage-item">
                        <img src="img/stage-img2.png" class="img-fluid">
                        <h2 class="mt-3">Stage 2 - (College Owners)</h2>
                        <h3 class="mt-1">Access to Private Colleges Database for College Owners (Currently in Progress)</h3>
                        <i class="fa fa-check-circle"></i>
                        <p>Online submission and tracking of College Registration Applications for Private Colleges.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="stage-item">
                        <img src="img/stage-img3.png" class="img-fluid">
                        <h2 class="mt-3">Stage 3 - (Parents)</h2>
                        <h3 class="mt-1">Launching Soon <br> -     </h3>
                        <i class="fa fa-check-circle"></i>
                        <p>Online profile of Registered Private Schools for parents.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End -->

    <!-- Stats -->
    <section class="stats text-center">
        <div class="container">
            <h1>Colleges Stats</h1>
            <div class="row">
                <div class="col-md col-sm-12">
                    <div class="stat-item rounded-circle">
                        <span>{{number_format(19000)}}+</span>
                        <p>Total Colleges</p>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="stat-item rounded-circle">
                        <span>{{number_format(2521500)}}+</span>
                        <p>Students</p>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="stat-item rounded-circle">
                        <span>{{number_format(20300)}}+</span>
                        <p>Teaching Staff </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

    <!-- Usefull Links -->
    <section class="usefull-links text-center">
        <div class="container">
            <h1>Useful Resources</h1>
            <div class="row">
                <div class="col-md col-sm-12">
                    <div class="video-item">
                        <div class="video">
                            <iframe width="100%" height="215" src="https://www.youtube.com/embed/gJdbz9Ig9i4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="vid-text">Online Data-Entry of Registered</div>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="video-item">
                        <div class="video">
                            <iframe width="100%" height="215" src="https://www.youtube.com/embed/gJdbz9Ig9i4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="vid-text">Access to Private Colleges Database</div>
                    </div>
                </div>
                <div class="col-md col-sm-12">
                    <div class="video-item">
                        <div class="video">
                            <iframe width="100%" height="215" src="https://www.youtube.com/embed/gJdbz9Ig9i4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="vid-text">College Owners (Currently in Progress)</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

    <!-- Contact -->
    <section class="contact">
        <div class="container">
            <div class="text-center">
                <h1>Contact</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="email-address"><i class="fa fa-envelope"></i> support@hed.punjab.gov.pk</div>
                    <form>
                        <div class="row ">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">Your Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">Your B-Form / CNIC</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
</x-app-layout>

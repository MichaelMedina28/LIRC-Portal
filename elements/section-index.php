<div id="section-index">
        <section>
            <div id="carousel-1" class="carousel slide" data-bs-ride="carousel" style="height: 600px;">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100"><img class="w-100 d-block position-absolute h-100 fit-cover opacity-25" src="<?php echo $assetPath; ?>img/bg1.jpg" alt="Slide Image" style="z-index: -1;" />
                        <div class="container d-flex flex-column justify-content-center h-100">
                            <div class="row">
                                <div class="col text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center col-md-9">
                                    <div class="my-auto">
                                        <h1 class="text-uppercase fw-bold" style="font-size: 50px;font-family: Roboto, sans-serif;">LEARNING AND INFORMATION RESOURCE CENTER</h1>
                                        <p class="my-3 text-justify">CCC Learning and Information Resource Center is our official website. Announcement and updates regarding the Library will be posted for information dissemination. Inquiries, comments and suggestions related to our Policies and library services will also be entertained for the improvement of our Services.</p><a class="btn btn-primary btn-lg me-2" role="button" href="services-opac-books.php">Check out OPAC</a>
                                        <p class="mt-5" style="font-size: 20px;"><strong>Library Hours</strong><br>Monday - Friday |&nbsp;8:00 AM - 7:00 PM<br>Saturday | 8:00 AM - 5:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover opacity-25" src="<?php echo $assetPath; ?>img/bg2.jpg" alt="Slide Image" style="z-index: -1;" />
                        <div class="container d-flex flex-column justify-content-center h-100">
                            <div class="row">
                                <div class="col text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center col-md-9">
                                    <div class="my-auto">
                                        <h1 class="text-uppercase fw-bold" style="font-size: 50px;font-family: Roboto, sans-serif;">Exploring Creativity, The Multimedia Station and Faculty Research Commons</h1>
                                        <p class="my-3 text-justify">LIRC, the Library and Information Resource Center, is a gateway to knowledge, offering free Internet access, a curated collection of LIRC Online Electronic Resources (OER), and Open Access Resources. This dual strategy reflects a commitment to democratizing information. Within the library, the Faculty Research Commons provides a focused space for faculty members to engage in individual and collaborative academic pursuits.</p><a class="btn btn-primary btn-lg me-2" role="button" href="services-opac-books.php">Lean More</a>
                                        <p class="mt-5" style="font-size: 20px;"><strong>Multimedia & FRC Hours</strong><br>Monday - Friday |&nbsp;8:00 AM - 5:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover opacity-25" src="<?php echo $assetPath; ?>img/bg3.jpg" alt="Slide Image" style="z-index: -1;" />
                        <div class="container d-flex flex-column justify-content-center h-100">
                            <div class="row">
                                <div class="col text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center col-md-9">
                                    <div class="my-auto">
                                        <h1 class="text-uppercase fw-bold" style="font-size: 50px;font-family: Roboto, sans-serif;">Empowering Knowledge, One Click at a Time</h1>
                                        <p class="my-3 text-justify">Online Electronic Resources (OER) encompass a diverse array of digital materials, and within this expansive domain, there exists a network of online library directories sourced from distinguished platforms. Notable contributors to this wealth of resources include well-known online libraries such as Philippine E-Journals, Access Science, and Vital Source.</p><a class="btn btn-primary btn-lg me-2" role="button" href="services-opac-books.php">Check OER</a>
                                        <p class="mt-5" style="font-size: 20px;"><strong>Library Hours</strong><br>Monday - Friday |&nbsp;8:00 AM - 7:00 PM<br>Saturday | 8:00 AM - 5:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                <div class="carousel-indicators"><button class="active" type="button" data-bs-target="#carousel-1" data-bs-slide-to="0"></button><button type="button" data-bs-target="#carousel-1" data-bs-slide-to="1"></button><button type="button" data-bs-target="#carousel-1" data-bs-slide-to="2"></button></div>
            </div>
        </section>

        <!--Start of Announcements-->

        <div class="container pt-4">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Announcements</h2>
                    <p class="w-lg-50">Read the latest news and events</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
                <?php
                require_once $dbPath . "db_connection.php";

                // Assuming you have a database connection

                $latest_announcement_query = "SELECT * FROM announcement ORDER BY title_id DESC LIMIT 4";
                $result = mysqli_query($conn, $latest_announcement_query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $announcement_title = $row['title'];
                    $announcement_description = $row['title_information'];
                    $announcement_image = $row['title_pic'];
                    $announcement_id = $row['title_id']; // Assuming you have a field for the image filename in your database
                ?>


                    <div class="col mb-4">
                        <div><a href="#"><img class="rounded img-fluid shadow w-100 fit-cover" src="<?php echo $dbPath; ?>ann_pic/<?php echo $announcement_image; ?>" style="height: 250px;" /></a>
                            <div class="py-4">
                                <h4 class="fw-bold"><?php echo $announcement_title; ?></h4>
                                <p><?php echo mb_strimwidth($announcement_description, 0, 50, "..."); ?></p>
                                <a class="btn btn-primary shadow" type="button" href="announcements-view.php?id=<?php echo $announcement_id; ?>">Learn more</a>
                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>

            </div>

        </div>

        <!--End of Announcements-->
        <div class="container">
            <div class="row mb-3">
                <div class="text-center mx-auto">
                    <h2>Services</h2>
                    <p class="w-lg-50">The library offers a comprehensive range of services, including access to its extensive collection through the Online Public Access Catalogue (OPAC), a wealth of knowledge through Online Electronic Resources (OER), and multimedia exploration facilitated by the Multimedia Station.</p>
                </div>
            </div>
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <div class="card shadow-lg py-5">
                        <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                            <div class="bs-icon-xl bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                    <g>
                                        <rect fill="none" height="24" width="24"></rect>
                                    </g>
                                    <g>
                                        <g></g>
                                        <g>
                                            <path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.7,0-4.15,0.65-5.5,1.5V8c1.35-0.85,3.8-1.5,5.5-1.5c1.2,0,2.4,0.15,3.5,0.5V18.5z"></path>
                                            <g>
                                                <path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.7,0-3.24,0.29-4.5,0.83v1.66 C14.13,10.85,15.7,10.5,17.5,10.5z"></path>
                                                <path d="M13,12.49v1.66c1.13-0.64,2.7-0.99,4.5-0.99c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24 C15.8,11.66,14.26,11.96,13,12.49z"></path>
                                                <path d="M17.5,14.33c-1.7,0-3.24,0.29-4.5,0.83v1.66c1.13-0.64,2.7-0.99,4.5-0.99c0.88,0,1.73,0.09,2.5,0.26v-1.52 C19.21,14.41,18.36,14.33,17.5,14.33z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg></div>
                            <div class="px-3">
                                <h4 class="fw-bold">OPAC</h4>
                                <p>The Online Public Access Catalogue (OPAC) is a library directory for all the available books, novels, or any other resources of the library facility</p><a href="services-opac-books.php">Learn More&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg py-5">
                        <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                            <div class="bs-icon-xl bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                    <rect fill="none" height="24" width="24"></rect>
                                    <path d="M19,21l-7-3l-7,3V5c0-1.1,0.9-2,2-2l7,0c-0.63,0.84-1,1.87-1,3c0,2.76,2.24,5,5,5c0.34,0,0.68-0.03,1-0.1V21z M17.83,9 L15,6.17l1.41-1.41l1.41,1.41l3.54-3.54l1.41,1.41L17.83,9z"></path>
                                </svg></div>
                            <div class="px-3">
                                <h4 class="fw-bold">OER</h4>
                                <p>Online Electronic Resources (OER) includes multiple online library directories from other well-known online library such as Philippine E-Journals, Access Science, and Vital Source</p><a href="services-oer.php">Learn More&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg py-5">
                        <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                            <div class="bs-icon-xl bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"></path>
                                </svg></div>
                            <div class="px-3">
                                <h4 class="fw-bold">Multimedia Station</h4>
                                <p>Provides free access to the Internet, LIRC Online Electronic Resources (OER) and Open Access Resource.</p><a href="services-ms.php">Learn More&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="py-4 py-xl-5">
            <div class="container h-100">
                <div class="text-white bg-primary border rounded border-0 p-4 py-5">
                    <div class="row h-100">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold text-white mb-3">About us</h1>
                                <p class="mb-4">The CCC Learning and Information Resource Center serves as our official website, acting as a centralized platform for a plethora of information. Regular announcements and updates pertaining to the library are prominently featured, ensuring effective information dissemination to our community. In addition to keeping our users informed, we welcome inquiries, comments, and suggestions related to our policies and library services. This interactive engagement not only encourages feedback but also contributes to the continuous improvement of our services, aligning them with the evolving needs and expectations of our patrons.<br><br>Contact us on our Facebook page CCC Library (Official Page) or LIRC Concerns on Messenger</p><a class="btn btn-light fs-5 py-2 px-4" role="button" href="about-us.php">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
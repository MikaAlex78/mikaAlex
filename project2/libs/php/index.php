<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDL</title>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS (including Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/style.css">

</head>

<body>
    <section>

        <div class="appHeader">

            <div class="row">

                <div class="col">
                    <input id="searchInp" class="form-control mb-3" placeholder="search">
                </div>

                <div class="col-6 text-end me-2">

                    <div class="btn-group" role="group" aria-label="buttons">

                        <button id="refreshBtn" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-refresh fa-fw"></i>
                        </button>
                        <!-- <button id="filterBtn" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-filter fa-fw"></i>
                        </button> -->
                        <button id="addBtn" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-plus fa-fw"></i>
                        </button>

                    </div>

                </div>

            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personnelBtn" data-bs-toggle="tab" data-bs-target="#personnel-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                        <i class="fa-solid fa-person fa-lg fa-fw"></i><span class="d-none d-sm-block">Personnel</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="departmentsBtn" data-bs-toggle="tab" data-bs-target="#departments-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                        <i class="fa-solid fa-building fa-lg fa-fw"></i><span class="d-none d-sm-block">Departments</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="locationsBtn" data-bs-toggle="tab" data-bs-target="#locations-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                        <i class="fa-solid fa-map-location-dot fa-lg fa-fw"></i><span class="d-none d-sm-block">Locations</span>
                    </button>
                </li>
            </ul>

        </div>

        <div class="tab-content bg-white">

            <!-- pesonel tab and table -->
            <div class="tab-pane show active" id="personnel-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <table class="table table-hover">
                    <tbody id="personal_data">
                        <!-- loading data dynamically -->
                    </tbody>
                </table>
            </div>

            <!-- departments tab and table -->
            <div class="tab-pane" id="departments-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <table class="table table-hover">
                    <tbody id="deparments_data">
                        <!-- loading data dynamically -->
                    </tbody>
                </table>
            </div>

            <!-- locations tab and table -->
            <div class="tab-pane" id="locations-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <table class="table table-hover">
                    <tbody id="locations_data">
                        <!-- loading data dynamically -->
                    </tbody>
                </table>
            </div>

        </div>

        <footer class="border-top text-center fw-bold">
            <p class="fw-light my-3">Company Directory assignment by mika version 1.0</p>
        </footer>
    </section>

    <!-- models as component use for edit and save  -->
    <?php include('components/models.php'); ?>
    <!-- Custom JavaScript -->
    <script src="assets/app.js"></script>

</body>

</html>